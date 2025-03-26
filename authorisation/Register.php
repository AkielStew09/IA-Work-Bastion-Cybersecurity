<?php 
session_start();

require "../connection.php";
$conn = Connect();



global $errors;
$errors = [];
$displayMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fName = $conn->real_escape_string(trim($_POST["fName"]));
    $lName = $conn->real_escape_string(trim($_POST["lName"]));
    $email = $conn->real_escape_string(trim($_POST["email"]));
    $uname = $conn->real_escape_string(trim($_POST["uname"]));
    $password = trim($_POST["pass"]);
    $confirm_password = trim($_POST["confirm_pass"]);


    $uniqueName = $conn->prepare("SELECT * FROM tbl_users WHERE u_name = ?");
    $uniqueName->bind_param("s", $uname);
    $uniqueName->execute();
    $nameResult = $uniqueName->get_result();
    if($nameResult->num_rows > 0){
        $errors[] = "Username is already taken.";
    }
    
    
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

        //keeping the file output from last assignment, 
        //but this time we're inserting the data to our db too
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO tbl_users(f_name, l_name, email, u_name, pw) VALUES(?, ?, ?, ?, ?)";

        if($stmt = $conn->prepare($insertQuery)){//prepare statement
            $stmt->bind_param("sssss", $fName, $lName, $email, $uname, $hash);   //set the params

            if($stmt->execute()){
                //make session
                $_SESSION['uname'] = htmlentities($uname);


                $displayMsg = "Thank You for registering with us, <span>$uname</span>, welcome to the Bastion Squadron!<br/>";
                
                $_SESSION["msg"] = $displayMsg;
                $result = $conn->query("SELECT id FROM tbl_users WHERE u_name = ");
                $user = $result->fetch_assoc();
                $_SESSION["id"] = $user["id"];
                header('Location: thankyou.php');
            }
            else{
                $displayMsg = "Error while executing: ".$stmt->error;
            }

        }
        else{
            echo "Error preparing statement: ".$conn->error;
        }



    } 
    
}
function showErrs($errors){
    if(!empty($errors)){
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}

$stmt->close(); $conn->close();


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
                <a href="/authorisation/profile.php"><button class="login"> See Profile</button></a>
                <a href="/authorisation/Logout.php"><button class="logout" 
                onclick="return confirm('Are you sure you want to log out?')"> Log out</button></a>    
            <?php else:?>
                <a href="/authorisation/Login.php"><button class="login">Login</button></a>
                <a href="/authorisation/Register.php"><button class="signup">Sign Up</button></a>
            <?php endif;?>
        </div>
    </nav>

    <div class="form-box">
        <h1>Register</h1>
        <?php showErrs($errors);?>

        <form method="POST" action = "" >
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
