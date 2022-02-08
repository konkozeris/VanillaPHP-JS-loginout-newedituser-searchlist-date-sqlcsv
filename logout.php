<?php
    if(isset($_GET['logout'])) {
        session_destroy();
        setcookie('logged-in', $user_info['id'], time()-3600, '/');
        header('location:login.php');
    }