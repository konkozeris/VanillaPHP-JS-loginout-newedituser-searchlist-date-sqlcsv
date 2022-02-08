<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your pokes</title>

    <?php require_once("view/includes.php"); ?>

</head>
<body>
    <?php 
    if(isset($_COOKIE['logged-in'])) {

        require_once("view/navbar.php");
    ?>

    <!-- search -->

        <a class="btn btn-light btn-sm" href="users.php" name="search" id="search">Back to users</a>
        <div class="input-group mb-3 w-50 mx-auto mt-4">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" name="search" id="search">Search</button>
                <button class="btn btn-outline-secondary" style="display:none" type="button" name="clear" id="clear">Clear</button>
            </div>
            <input type="text" class="form-control" aria-describedby="basic-addon1" name="search_input" id="search_input">
        </div>
        <span class="alert-danger w-75 mx-auto pl-5" style="display:none" name="search_feedback" id="search_feedback"></span>
     
    <!-- date -->

<div class="input-group w-50 mx-auto mb-5">
  <div class="input-group-prepend">
    <span class="input-group-text" id="">Select date</span>
  </div>
  <input type="text" class="form-control" id="from" name="from" placeholder="from">
  <input type="text" class="form-control" id="to" name="to" placeholder="to">
</div>

    <!-- content table -->

        <div id="pokesTable"></div>

    <?php

        } else {
            session_destroy();
            header('location:login.php');
        }; 
    ?>
    
</body>
</html>
<script src="pokes.js"> </script>