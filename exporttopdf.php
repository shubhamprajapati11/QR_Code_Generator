<?php
include 'dbconnect.php';
require 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$sql = "SELECT * FROM qrtable";
$result = mysqli_query($conn, $sql);

$table = "
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        img {
            width: 100px;
            height: auto;
        }
    </style>
    <h2 style='text-align:center;'>QR Code Export</h2>
    <table>
        <tr>
            <th>QR Name</th>
            <th>QR URL</th>
            <th>Date & Time</th>
            <th>QR Image</th>
        </tr>";

while ($row = mysqli_fetch_assoc($result)) {
    $dp = $row['QRCode'];

    $table .= 
        "<tr>
            <th>" . $row['QRCodeName'] . "</th>
            <td>" . $row['QRCodeURL'] . "</td>
            <td>" . $row['DateandTime'] . "</td>
            <td><img src='https://localhost/task/" . $dp . "' alt='qrcode'></td>
        </tr>";
}

$table .= "</table>";

$dompdf = new Dompdf();
$dompdf->loadHtml($table);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream("qr_export.pdf", array("Attachment" => true));
