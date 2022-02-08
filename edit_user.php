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
    <title>Edit user</title>

    <?php require_once("view/includes.php"); ?>

</head>
<body>
<?php 


if(isset($_GET["submit"])) {
    if(isset($_GET["password"]) && isset($_GET["email"]) && !empty($_GET["password"]) && !empty($_GET["email"])) {

        $user_id = $_SESSION['id'];
        $last_name = $_GET["last_name"];
        $password = $_GET["password"];
        $repeat_password = $_GET["repeat_password"];
        $email = $_GET["email"];

        //regex validation for password( Uppercase + digit)
        $valid_password = preg_match('/^(?=.*[a-zA-Z])(?=.*\d).*$/', $password);

        //validation for email ( @ )
        $valid_email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$valid_email) {
            $message =  "Please check your email format";
            $class = "danger";
        } else if (!$valid_password) {
            $message =  "Password must contain 1 uppercase symbol and 1 digit";
            $class = "danger";
        } else if($password !== $repeat_password) {
                $message =  "Passwords do not match";
                $class = "danger";
        } else {

                $sql_update = "UPDATE `users` 
                SET `last_name`='$last_name',`password`='$password',`email`='$email' 
                WHERE `id`= $user_id";

                if(mysqli_query($conn, $sql_update)) {
                    header('location:users.php');
                } else {
                    $message =  "Something went wrong";
                    $class = "danger";
                }
            } 
    } else {
        $message =  "Please fill all fields";
        $class = "danger";
    }

}

?>

<div class="container">
        <h1>Edit user</h1>
            <form action="edit_user.php" method="GET">
            <fieldset disabled>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Please enter your name" value="<?php echo $_SESSION['name'];?>"/>
                </div>
            </fieldset>
                <div class="form-group">
                    <label for="last_name">Last name</label>
                    <input class="form-control" type="text" name="last_name" placeholder="Please enter your last name" value="<?php echo $_SESSION['last_name'];?>"/>
                </div>
 
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Please enter your E-mail" value="<?php echo $_SESSION['email'];?>"/>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password must contain 1 uppercase symbol and 1 digit" value="<?php echo $_SESSION['password'];?>"/>
                </div>

                <div class="form-group">
                    <label for="repeat_password">Repeat password</label>
                    <input class="form-control" type="password" name="repeat_password" placeholder="Please repeat password" value="<?php echo $_SESSION['password'];?>"/>
                </div>

                <a href="users.php" class="btn btn-light btn-sm">Back to users list</a><br>

                <button class="btn btn-primary" type="submit" name="submit">Update</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>