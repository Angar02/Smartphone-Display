<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$phone = query("SELECT * FROM smartphones");

$mpdf = new \Mpdf\Mpdf();
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <h1>Daftar Smartphone</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Smartphone</th>
            <th>Picture</th>
            <th>OS</th>
            <th>Chipset</th>
            <th>Camera</th>
            <th>Battery</th>
        </tr>';
        $i = 1;
        foreach($phone as $row) {
            $html .= '<tr>
                <td>'. $i++ .'</td>
                <td>'. $row["name"] .'</td>
                <td><img src="img/'. $row["image"] .'"></td>
                <td>'. $row["os"] .'</td>
                <td>'. $row["chip"] .'</td>
                <td>'. $row["camera"] .'</td>
                <td>'. $row["battery"] .'</td>
            </tr>';
        };
    
$html .='</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('Smartphone-list.pdf',\Mpdf\Output\Destination::INLINE);

?>