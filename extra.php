<?php
                            $sql = "select * from qrtable order by `S.No.` desc";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {

                            ?>
<tr>
    <th scope="row"><?php echo $row['QRCodeName']; ?></th>
    <td><?php echo $row['QRCodeURL']; ?></td>
    <td><?php echo $row['DateandTime']; ?></td>
    <td> <a href="<?php echo $row['QRCode']; ?>"> <img src="<?php echo $row['QRCode']; ?>" alt="QR_Code" width="100px"> </a> </td>
    <td><?php echo $row['LoggedInUser']; ?></td>
</tr>















<div class="container">
            <table class="table" id="datatableid">
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
                    $sql = "select * from qrtable order by `S.No.` desc";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['QRCodeName']; ?></th>
                            <td><?php echo $row['QRCodeURL']; ?></td>
                            <td><?php echo $row['DateandTime']; ?></td>
                            <td> <a href="<?php echo $row['QRCode']; ?>"> <img src="<?php echo $row['QRCode']; ?>" alt="QR_Code" width="100px"> </a> </td>
                            <td><?php echo $row['LoggedInUser']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

    </div>




















<!-- Pagination of the qrtable data -->
<?php
                    $record_per_page = 5;
                    $page = '';
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }

                    $start_from = ($page - 1) * $record_per_page;

                    $query = "SELECT * FROM `qrtable` order by `S.No.` DESC LIMIT ".$start_from.", ".$record_per_page;
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $row['QRCodeName']; ?></th>
                            <td><?php echo $row['QRCodeURL']; ?></td>
                            <td><?php echo $row['DateandTime']; ?></td>
                            <td> <a href="<?php echo $row['QRCode']; ?>"> <img src="<?php echo $row['QRCode']; ?>" alt="QR_Code" width="100px"> </a> </td>
                            <td><?php echo $row['LoggedInUser']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <br />
                <?php
                $page_query = "SELECT * FROM qrtable ORDER BY  `S.No.` DESC";
                $page_result = mysqli_query($conn, $page_query);
                $total_records = mysqli_num_rows($page_result);
                $total_pages = ceil($total_records / $record_per_page);
                $start_loop = $page;
                $difference = $total_pages - $page;
                if ($difference <= 5) {
                    $start_loop = $total_pages - 5;
                }
                $end_loop = $start_loop + 4;
                if ($page > 1) {
                    echo "<button class='btn btn-primary' href='dashboard.php?page=1'>First</button>";
                    echo "<a href='dashboard.php?page=" . ($page - 1) . "'><button class='btn btn-primary'></button></a>";
                }
                for ($i = $start_loop; $i <= $end_loop; $i++) {
                    echo "<button class='btn btn-primary' href='dashboard.php?page=" . $i . "'>" . $i . "</button>";
                }
                if ($page <= $end_loop) {
                    echo "<button class='btn btn-primary' href='dashboard.php?page=" . ($page + 1) . "'>>></button>";
                    echo "<button class='btn btn-primary' href='dashboard.php?page=" . $total_pages . "'>Last</button>";
                }
                ?>
            </div>