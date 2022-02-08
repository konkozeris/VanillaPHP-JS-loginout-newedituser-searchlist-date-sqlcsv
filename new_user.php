<?php require_once("connection.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New user</title>

    <?php require_once("view/includes.php"); ?>

</head>
<body>
<?php 


if(isset($_GET["submit"])) {
    if(isset($_GET["name"]) && isset($_GET["password"]) && isset($_GET["email"]) && !empty($_GET["name"]) && !empty($_GET["password"]) && !empty($_GET["email"])) {

        $name = $_GET["name"];
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
        } else {

            $sql_name = "SELECT * FROM `users` WHERE `name` = '$name'";
            $sql_email = "SELECT * FROM `users` WHERE `email` = '$email'";

            $res_name = $conn->query($sql_name);
            $res_email = $conn->query($sql_email);

            if(mysqli_num_rows($res_name) >= 1) {
                $message =  "Name is already taken";
                $class = "danger";
            } else if(mysqli_num_rows($res_email) > 0) {
                $message =  "Email is already taken";
                $class = "danger";
            } else if($password !== $repeat_password) {
                $message =  "Passwords do not match";
                $class = "danger";
            } else {

                $sql_insert = "INSERT INTO `users`( `name`, `last_name`, `password`, `email`) 
                VALUES ('$name','$last_name','$password','$email')";

                if(mysqli_query($conn, $sql_insert)) {
                    // $message =  "User added";
                    // $class = "success";
                    header("Location: login.php");
                } else {
                    $message =  "Something went wrong";
                    $class = "danger";
                }
            } 
        }     
    } else {
        $message =  "Please fill all fields";
        $class = "danger";
    }

}

?>

<div class="container">
        <h1>Create new user</h1>
            <form action="new_user.php" method="GET">

                <div class="form-group">
                    <label for="username">Name</label>
                    <input class="form-control" type="text" name="name" placeholder="Please enter your name" />
                </div>
                <div class="form-group">
                    <label for="username">Last name</label>
                    <input class="form-control" type="text" name="last_name" placeholder="Please enter your last name" />
                </div>
 
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" placeholder="Please enter your E-mail" />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" type="password" name="password" placeholder="Password must contain 1 uppercase symbol and 1 digit"/>
                </div>

                <div class="form-group">
                    <label for="repeat_password">Repeat password</label>
                    <input class="form-control" type="password" name="repeat_password" placeholder="Please repeat password"/>
                </div>

                <a href="users.php" class="btn btn-light btn-sm">Back to users list</a><br>

                <button class="btn btn-primary" type="submit" name="submit">Create user</button>
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              
    </div>
</body>
</html>