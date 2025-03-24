<?php 
global $errors;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = trim($_POST["fName"]);
    $lName = trim($_POST["lName"]);
    $email = trim($_POST["email"]);
    $uname = trim($_POST["uname"]);
    $password = $_POST["pass"];
    $confirm_password = $_POST["confirm_pass"];
    
    
    // Validate all fields are filled
    if (empty($fName)  || empty($lName) || empty($uname) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "All fields are mandatory.";
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address.";
    }
    
    // Validate password length
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    
    // Validate password match
    if ($password !== $confirm_password) {
        $errors[] = "Password and confirmation password must match.";
    }
    
    if (empty($errors)) {
        // Save to file
        $data = "$fName, $lName, $email, $uname, $password\n";
        file_put_contents("register.txt", $data, FILE_APPEND);

    } 
    // else {
    //     // Show errors
    //     foreach ($errors as $error) {
    //         echo "<p style='color: red;'>$error</p>";
    //     }
    // }
}

function showErrs($errors){
    if(!empty($errors)){
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en" style="background-color: #1a1a1a;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberSecurity Registration</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="cyber-security-logo.avif" type="image/x-icon">

</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <a href="index.php"><img src="/image/crop-cyber-logo.jpg" alt=""></a>
            <span>CyberSecurity</span>
        </div>
        <ul class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/contact.php">Contact</a></li>
            <?php if(isset($_SESSION['uname'])):?>
                <li><a href="/Services.php">Services</a></li>
            <?php endif;?>

        </ul>
        
        <div class="auth-buttons">
            <?php if(isset($_SESSION['uname'])):?>
                <a href="/authorisation/Logout.php"><button class="login"> Log out</button></a>    
            <?php else:?>
                <a href="/authorisation/Login.php"><button class="login">Login</button></a>
                <a href="/authorisation/Register.php"><button class="signup">Sign Up</button></a>
            <?php endif;?>
        </div>
    </nav>

    <div class="form-box">
        <h1>Register</h1>
        <?php showErrs($errors);?>

        <form method="POST" action = "/authorisation/thankyou.php" >
            <div class="input-field">
                <input type="text" placeholder="First Name" name="fName">
            </div>
            <div class="input-field">
                <input type="text" placeholder="Last Name" name="lName">
            </div>
            <div class="input-field">
                <input type="text" placeholder="Email" name="email" >
            </div>
            <div class="input-field">
                <input type="text" placeholder="Username" name="uname">
            </div>
            <div class="input-field">
                <input type="password" placeholder="Password" name="pass">
            </div>
            <div class="input-field">
                <input type="password" placeholder="Confirm Password" name="confirm_pass">
            </div>
            <div class="btn-field">
                <button type="submit">Register</button>
                <!-- <button type="button"><a href="Login.php">Login</a></button> -->
            </div>
        </form>
    </div>
</body>
</html>
