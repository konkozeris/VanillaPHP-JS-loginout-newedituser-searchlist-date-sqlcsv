<?php
require_once('connection.php');
session_start();


$poker = $_SESSION['email'];
$poked = $_POST['email'];
$poke_date =  date("Y-m-d");

$sql_poke = "INSERT INTO `pokes`(`from`, `to`, `date`) VALUES ('$poker','$poked','$poke_date')";

$result_pokes = $conn->query($sql_poke);

//-----email----
// reikalingi SMTP nustatymai php.ini

// $message = 'You got poked';
// $subject = 'You got poked by '.$poker;

// mail($poked, $subject, $message);
