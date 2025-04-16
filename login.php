<?php
session_start();
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "select Password, Email, Name from `userdetails` where `Email` = '$email'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    // echo var_dump($row);
    $hash = $row['Password'];
    $_SESSION['username'] = $row['Name'];
    

    if (password_verify($_POST['pass'], $hash)) {
        // echo "Login successful";
        header('Location: dashboard.php?msg=Login_Successfull!');
        return true;
    } else {
        // echo "Your Login Name or Password is invalid";
        header('Location: login.php?msg= Login_Failed,_Invalid_email_or_password');
        return false;
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $msg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    ?>

    <div class="d-flex flex-row container justify-content-center" style="margin-top: 50px;">
        <h1>Login Here</h1>
    </div>

    <div class="container w-50" style="margin-top: 50px;">

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>