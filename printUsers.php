<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'functions.php';
$users = query("SELECT * FROM users");

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
    <h1>Daftar users</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Name</th>
        </tr>';
        $i = 1;
        foreach($users as $row) {
            $html .= '<tr>
                <td>'. $i++ .'</td>
                <td>'. $row["username"] .'</td>
            </tr>';
        };
    
$html .='</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output('Users-list.pdf',\Mpdf\Output\Destination::INLINE);

?>