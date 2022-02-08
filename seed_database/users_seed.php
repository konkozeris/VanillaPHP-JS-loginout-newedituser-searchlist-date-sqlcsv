<?php 
require_once("../connection.php");

$users_file = "C:\Users/vienu\Desktop\users.csv";

$file = fopen($users_file, 'r');


while(($column = fgetcsv($file, 1000, ",")) !== FALSE) {

    $password = 'Pass'.rand(1,1500);

    $sql_seed = "INSERT INTO users (`id`, `name`, `last_name`, `password`, `email`) VALUES (" . $column[0] . ", '".$column[1]."', '" . $column[2] . "', '".$password."', '" . $column[3]. "')";
    
    $result = mysqli_query($conn, $sql_seed);

};

if(!empty($result)) {
    echo "Users from CSV seeded succesfully";
} else {
    echo "somethings wrong";
}