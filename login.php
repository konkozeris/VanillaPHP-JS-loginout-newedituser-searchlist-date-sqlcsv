<?php
require_once("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <?php require_once("view/includes.php");?>

</head>
<body>
 
<?php
require_once("view/navbar.php");

if (isset($_GET['login'])) {
 
    if (!empty($_GET['name']) && !empty($_GET['password']) && isset($_GET['name']) && isset($_GET['password'])) {

    $name = $_GET['name'];
    $password = $_GET['password'];

    $sql = "SELECT * FROM `users` WHERE `name` = '$name' AND `password`= '$password'";

    $result = $conn->query($sql);

    if($result->num_rows == 1) {

            //is gauto rezultato pasiimti ID

            $user_info = mysqli_fetch_array($result);

            $cookie_array = array(
                $user_info['id'],
                $user_info['name'],
                $user_info['last_name'],
                $user_info['password'],
                $user_info['email'],
            );
            setcookie('logged-in', $user_info['id'], time()+3600, '/');

            $_SESSION['id'] = $user_info['id'];
            $_SESSION['name'] = $user_info['name'];
            $_SESSION['last_name'] = $user_info['last_name'];
            $_SESSION['password'] = $user_info['password'];
            $_SESSION['email'] = $user_info['email'];

            header('Location:users.php');
        
        } else {
            $message = 'Please check username or password';
            $class = 'danger';
        }
    } else {
        $message = 'Please fill all fields';
        $class = 'danger';
    }
}

?>
<?php if(!isset($_COOKIE['logged-in'])) {?>

    <div class='container'>
    <h1> User login </h1>
    
    <form action='login.php' method='GET'>
        <div class='form-group'>
            <label for='name'>Username</label>
            <input class='form-control' type='text' name='name'>
        </div>

        <div class='form-group'>
            <label for='password'>Password</label>
            <input class='form-control' type='password' name='password'>
        </div>

        <a href='new_user.php'>Register here </a>

        <button class='btn btn-primary' type='submit' name='login'>LOGIN</button>
    </form>
       
        <!-- ALERT MESSAGE -->
        <?php if(isset($message)) { ?>

            <div class='alert alert-danger' role='alert'>
                <?php echo $message; ?>
            </div>

        <?php } ?>
    </div>
        <?php } else {
            header('Location: users.php');
            };
        ?>
</body>
</html>