<?php
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $pp = $_FILES['pp']['name'];
    $ppsize = $_FILES['pp']['size'];


    $extension = ['png', 'jpg', 'avif', 'webp'];
    $imagearray = explode('.', $pp);
    $getextension = end($imagearray);



    // Condition Checking
    if ($ppsize > 2 * 1024 * 1024) {
        header('Location: index.php?sizemsg=Upload Image Size less than 2MB');
    }
    if (strlen($mobile) != 10) {
        header('Location: index.php?lenmsg=Mobile number must be of 10 digits');
    }
    if ($cpass != $pass) {
        header('Location: index.php?passmsg=Confirm Password not same');
    }
    if (!in_array($getextension, $extension)) {
        header('Location: index.php?formatmsg=Invalid Image Format');
    }



    $hashpass = password_hash($cpass, PASSWORD_BCRYPT);

    if (in_array($getextension, $extension) && ($pass == $cpass) && (strlen($mobile) == 10) && ($ppsize <= 2 * 1024 * 1024)) {
        $sql = "INSERT INTO `userdetails` (`Name`, `Email`, `Mobile Number`, `Password`, `Profile Picture`) VALUES ('$name', '$email', '$mobile', '$hashpass', '$pp')";
        $result = mysqli_query($conn, $sql);
        $info = pathinfo($_FILES['pp']['name']);
        // $ext = $info['extension'];
        $newname = "newname." . $getextension;
        $target = 'img/' . $newname;
        move_uploaded_file($_FILES['pp']['tmp_name'], $target);


        if ($result) {
            header('Location: index.php?msg=success');
        } else {
            echo "Query Fail" . mysqli_error($conn);
        }
    }
}
