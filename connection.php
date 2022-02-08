<?php
    $database_server = 'localhost';
    $database_server_user = 'root';
    $database_server_password = '';
    $database_name = 'sonaro';

    $conn = mysqli_connect($database_server, $database_server_user, $database_server_password, $database_name);

    if ($conn == false) {
        die('failed to connect'.mysqli_connect_error());
    } 
    else {
        echo "<div hidden>".'DB '.$database_name.' connected'."</div>";
    }
?>