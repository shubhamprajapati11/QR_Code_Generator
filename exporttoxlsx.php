<?php
include 'dbconnect.php';
$sql = "select * from qrtable";
$result = mysqli_query($conn, $sql);

$table =  "<table>
            <thead>
                <tr>
                    <th>QR Name</th>
                    <th>QR URL</th>
                    <th>Date & Time</th>
                    <th>QR Code</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        @$dp=$row['QRCode'];
        $table.= "
        <tr>
            <th>".$row['QRCodeName']."</th>
            <td>".$row['QRCodeURL']."</td>
            <td>".$row['DateandTime']."</td>
            <td><img src='https://localhost/task/".$dp."'></td>
        </tr>";
    }
    $table.="</tbody></table>";
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header("Content-Type:application/force-download");
    header("Content-Disposition:attachment;filename=data.xls");
    header("Content-Transfer-Encoding: BINARY");
    echo $table;    


?>