<?php
include 'dbconnect.php';


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>

    <?php
    if (isset($_GET['sizemsg'])) {
        $sizemsg = $_GET['sizemsg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $sizemsg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <?php
    if (isset($_GET['lenmsg'])) {
        $lenmsg = $_GET['lenmsg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $lenmsg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <?php
    if (isset($_GET['passmsg'])) {
        $passmsg = $_GET['passmsg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $passmsg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <?php
    if (isset($_GET['formatmsg'])) {
        $formatmsg = $_GET['formatmsg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $formatmsg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    ?>
    <?php
    if (isset($_GET['msg'])) {
        $msg = $_GET['msg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $msg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    } 

    ?>


    <div class=" d-flex flex-row justify-content-around mb-3 align-items-center">



        <div class="container">


            <div class="d-flex flex-row mx-auto justify-content-around">
                <img src="logo.png" alt="Logo image" class="image-fluid" height="25">
                <div class="d-flex flex-row">
                    <a href="login.php" style="text-decoration: none; color:red">Log In</a>
                    
                </div>
            </div>


            <div class="container-fluid">

                <form action='addrecord.php' method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name: </label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile Number:</label>
                        <input type="number" class="form-control" id="mobile" name="mobile">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Password: </label>
                        <input type="password" class="form-control" id="pass" name="pass">
                    </div>
                    <div class="mb-3">
                        <label for="cpass" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="cpass" name="cpass">
                    </div>
                    <div class="mb-3">
                        <label for="pp" class="form-label">Profile Picture:</label>
                        <input type="file" class="form-control" id="pp" name="pp">
                    </div>

                    <button type="submit" class="btn btn-danger" name="submit">Register</button>
                </form>
            </div>

        </div>

        <div class="container-fluid">
            <img src="frontimage.jpg" alt="Front Image" class="img-fluid">

        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>