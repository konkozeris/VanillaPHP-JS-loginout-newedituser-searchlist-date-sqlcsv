<?php

require_once("../connection.php");

$file = "C:\Users/vienu\Desktop\pokes.json";

$data = file_get_contents($file);

$array = json_decode($data, true);

foreach($array as $row) {
 
    $sql_pokes = "INSERT INTO `pokes`(`from`, `to`, `date`) VALUES ('".$row["from"]."', '".$row["to"]."', '".$row["date"]."')";
    $result = mysqli_multi_query($conn, $sql_pokes);
};

if($result) {
    echo "pokes from JSON seeded";
} else {
    echo "smth wrong";
}