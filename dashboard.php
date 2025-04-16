<?php
session_start();
include 'dbconnect.php';
include 'phpqrcode/qrlib.php';

if (isset($_POST['submit'])) {
    $qrname = $_POST['qrcodename'];
    $qrurl = $_POST['qrcodeurl'];
    $filename = "img/" . $qrname . ".png";
    if (isset($_SESSION['username'])) {
        $loggeduser = $_SESSION['username'];
    }
    $qr_url="https://".$_POST['qrcodeurl'];

    // $string = "QR_Code_Name: " . $qrname . ";\r\n QR_Code_URL: " . $qrurl . ";\r\n QR_Code_Path: " . $filename."\r\n Created_By_User: ".$loggeduser;
    $ecc = 'H';
    $pixel_size = 3;
    $frame_size = 3;

    // Generates QR Code and Save as PNG
    QRcode::png($qr_url, $filename, $ecc, $pixel_size, $frame_size);

    $sql = "INSERT INTO `qrtable` (`QRCodeName`, `QRCodeURL`, `QRCode`, `LoggedInUser`) VALUES ('$qrname', '$qrurl', '$filename','$loggeduser')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        header('Location: dashboard.php?smsg=QR_Code_Generated_Successfully');
    } else {
        // header('Location: dashboard.php?fmsg=Failed to Generate QR Code');
        echo mysqli_error($conn);
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <!-- <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" /> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script> -->
    <link href="DataTables/datatables.min.css" rel="stylesheet">

    <script src="DataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatableid').DataTable();
        });
    </script>


</head>

<body>

    <?php
    if (isset($_GET['smsg'])) {
        $smsg = $_GET['smsg'];
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>" . $smsg . "</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }

    ?>

    <div class="container">

        <div class="d-flex flex-row container justify-content-center" style="margin-top: 50px;">
            <h1>QR Code Dashboard</h1>
        </div>



        <div class="container">
            <form action="dashboard.php" , method="POST">
                <div class="mb-3">
                    <label for="qrcodename" class="form-label">QR Code Name</label>
                    <input type="text" class="form-control" id="qrcodename" name="qrcodename">
                </div>
                <div class="mb-3">
                    <label for="qrurl" class="form-label">QR Code URL</label>
                    <input type="text" class="form-control" id="qrurl" name="qrcodeurl">
                </div>

                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </form>
        </div>


    </div>


    <div class="container">
        <div class="container my-5 d-flex flex-row mb-3 justify-content-between">
            <h3>All the details of QR Codes: </h3>
            <div>
                <a href="exporttoxlsx.php"><button class="btn btn-success">Export to Excel</button></a>
                <!-- <a href="exporttopdf.php"><button class="btn btn-danger">Export to PDF</button></a> -->

            </div>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">QR Name</th>
                    <th scope="col">QR URL</th>
                    <th scope="col">Date & Time</th>
                    <th scope="col">QR</th>
                    <th scope="col">User Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Pagination setup
                $limit = 5;
                $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                $offset = ($page - 1) * $limit;

                // Get data for current page
                $sql = "SELECT * FROM qrtable ORDER BY `S.No.` DESC LIMIT $offset, $limit";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <th scope="row"><?php echo $row['QRCodeName']; ?></th>
                            <td><?php echo $row['QRCodeURL']; ?></td>
                            <td><?php echo $row['DateandTime']; ?></td>
                            <td><a href="<?php echo $row['QRCode']; ?>"><img src="<?php echo $row['QRCode']; ?>" alt="QR_Code" width="100px"></a></td>
                            <td><?php echo $row['LoggedInUser']; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Pagination buttons -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php
                // Count total records
                $countSql = "SELECT COUNT(*) AS total FROM qrtable";
                $countResult = mysqli_query($conn, $countSql);
                $countRow = mysqli_fetch_assoc($countResult);
                $totalRecords = $countRow['total'];
                $totalPages = ceil($totalRecords / $limit);

                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = ($i == $page) ? 'active' : '';
                    echo "<li class='page-item $active'><a class='page-link' href='?page=$i'>$i</a></li>";
                }
                ?>
            </ul>
        </nav>
    </div>














</body>

</html>