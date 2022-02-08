
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <?php require_once("view/includes.php"); ?>
    <script src="users.js"> </script>
</head>
<body>
    <?php 
    if(isset($_COOKIE['logged-in'])) {

        require_once("view/navbar.php");
        ?>
        <div class="input-group mb-3 w-50 mx-auto mt-4">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary" type="button" name="search" id="search">Search</button>
                <button class="btn btn-outline-secondary" style="display:none" type="button" name="clear" id="clear">Clear</button>
            </div>
            <input type="text" class="form-control" aria-describedby="basic-addon1" name="search_input" id="search_input">
        </div>
        <span class="alert-danger w-75 mx-auto pl-5" style="display:none" name="search_feedback" id="search_feedback"></span>
        
        <div id="usersTable"></div>

        <?php

        } else {
            session_destroy();
            header('location:login.php');
        }; 
    ?>
    
</body>
</html>

