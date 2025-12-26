<?php
    require '../functions.php';
    
    $data = query("SELECT * FROM smartphones");

    header('Content-Type: application/json');
    echo json_encode($data);

?>