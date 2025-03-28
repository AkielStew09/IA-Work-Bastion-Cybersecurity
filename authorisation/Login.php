
<?php    

session_start();

$uname_err = "" ;
$pass_err = "";


if(isset($_POST["login"])){
    
    
    $valid = true;

    if(empty ($_POST["uname"])){
        $uname_err = "Please Enter a username ";
        $valid = false;
    }
    if(empty ($_POST["pass"])){
        $pass_err = "Please Enter a password";

        $valid = false;
    }else if(strlen($_POST["pass"]) < 8){
        
        $pass_err = "Password must be at least 8 characters long";

        $valid = false;
    }

    if($valid){
        require "../connection.php";
        $conn = Connect();

        $uname = trim($_POST["uname"]);
        $pass = trim($_POST["pass"]);
        
        

        $selectStmt = $conn->prepare("SELECT * FROM tbl_users WHERE u_name = ?"); 
        $selectStmt->bind_param("s", $uname);
        $selectStmt->execute();
        $result = $selectStmt->get_result();
        $user = $result->fetch_assoc();

        

        if($result->num_rows == 1){
            $checkPass = password_verify($pass, $user["pw"]); //compares entered pw to the hash

            if($checkPass){
                $_SESSION['uname'] = htmlentities($uname);
                $_SESSION['id'] = $user["id"];
            
                if(isset($_POST["remember"])){
                    $cookieName = "rememberMe";
                    $cookieValue = $_SESSION['uname'];
                    $expiry = time() + (86400 * 7); //our cookie lasts a week

                    setcookie($cookieName, $cookieValue, $expiry, "/");
                }
            
                header('Location: welcome.php');
            }
            
        }else{
            $uname_err = "Incorrect Credentials";
        }

      
        $selectStmt->close(); $conn->close();
    }

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../image/crop-cyber-logo.jpg" type="image/x-icon">
    
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
                onclick="return confirm('Are you sure you want to Log Out?')"> Log out</button></a>    
            <?php else:?>
                <a href="/authorisation/Login.php"><button class="login">Login</button></a>
                <a href="/authorisation/Register.php"><button class="signup">Sign Up</button></a>
            <?php endif;?>
        </div>
    </nav>


    <div class="contact-container" >
        
        
        <form method="POST" class="contact-form" >

            <h2>Login</h2>
            <?php
                if (isset($_COOKIE["rememberMe"])){
                    $savedName = $_COOKIE["rememberMe"];
                }else{
                    $savedName = "";
                }
            ?>
            
            <span style="color: red;">
                <?php  echo $uname_err; ?>
                <?php  echo "<br/>$pass_err" ; ?>
            </span>
            <input type="text" placeholder="Username" name="uname" value="<?php echo $savedName;?>" style="margin-top: 8px;" />
                
            <input type="password" placeholder="Password" name="pass">
            
            <div style="margin-bottom: 1.2rem;">
                <label id="newLbl">Remember Me</label>
                <input type="checkbox" name="remember" id="remember"> 
            </div>
            
            
            
            <div class="newBtns">
                <button type="submit" name="login">Login</button>
                <!-- <a href="Register.php"><button type="button">Register</button></a> -->
            </div>
        </form>
    </div>
    




</body>
</html>

