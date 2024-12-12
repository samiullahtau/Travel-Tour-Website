<?php
session_start();
if(isset($_SESSION['id'])){
    header('location:welcome.php');
    exit;
}

include "config.php";
$error = "";
$email_error = "";
$password_error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Basic validation
    if(!empty(trim($email))){
        $email = trim($email);
    }else{
        $email_error = "Please enter your email";
    }

    if(!empty(trim($password))){
        $password = trim($password);
    }else{
        $password_error = "Please enter your password";
    }

    // Make user login if correct details entered
    if(empty($email_error) && empty($password_error) && empty($error)){

        // Updated query with backticks for table name
        $select = "SELECT * FROM `sign-up` WHERE email = '$email'";
        $query = mysqli_query($con , $select);

        if(mysqli_num_rows($query) == 1){
            $result = mysqli_fetch_assoc($query);
            
            // Use password_verify to check if the entered password matches the hashed password
            if(password_verify($password, $result['password'])){
                // Correct password, start session and store user details
                $_SESSION['id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['loggedin'] = true;

                // Redirect to the welcome page
                header('location:home page.php');
                exit;
            } else {
                $error = "Incorrect password";
            }
        } else {
            $error = "No user found with that email";
        }

    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    
<div class="box">
    <h2>Login</h2>
    <form action="#" method="post">

        <?php if(!empty($error)){ ?>
            <p class="error" style="text-align: center;"><?php echo $error; ?></p>
        <?php } ?>

        <div class="input_box">
            <input type="text" name="email" placeholder="Email Id" required>
        </div>
        <?php if(!empty($email_error)){ ?>
            <p class="error"><?php echo $email_error; ?></p>
        <?php } ?>

        <div class="input_box">
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <?php if(!empty($password_error)){ ?>
            <p class="error"><?php echo $password_error; ?></p>
        <?php } ?>

        <div class="links" style="text-align: right;"><a href="#">Forgot Password?</a></div>

        <button type="submit">Login</button>

        <div class="links">Don't have an account? <a href="sign-up.php">Sign Up</a></div>
        <div class="links">Need help? <a href="#">Contact Us</a></div>
            
    </form>
</div>
</body>
</html>
