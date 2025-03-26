<?php
    session_start();
    $empty_err = $email_err = "";

    //function to show the errors
    function showErrs($err1, $err2){
        echo"$err1";
        if($err2 != ""){echo"<br/>$err2";}
    }
    
    $auth = true;// a bool we set for authentication
    
    if(isset($_POST["submit"])){
        
        if(empty($_POST["name"]) || empty($_POST["email"])){
            $empty_err = "Full Name and Email are required.";
            $auth = false;
        }
        if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty($_POST["email"]) ){
            $email_err = "The Email entered is not vaild.";
            $auth = false;
        }

        if($auth){
            
            header('Location: /otherPages/validContact.php');
        }

    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css\styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script>
    <link rel="icon" href="cyber-security-logo.avif" type="image/x-icon">
</head>
<body>

    
    <nav class="navbar">
        <div class="logo">
            <a href="index.php"><img src="/image/crop-cyber-logo.jpg" alt=""></a>
            <span>CyberSecurity</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if(isset($_SESSION['uname'])):?>
                <li><a href="/Services.php">Services</a></li>
            <?php endif;?>

        </ul>
        
        <div class="auth-buttons">
            <?php if(isset($_SESSION['uname'])):?>
                <a href="/authorisation/Logout.php"><button class="logout"> Log out</button></a>    
            <?php else:?>
                <a href="/authorisation/Login.php"><button class="login">Login</button></a>
                <a href="/authorisation/Register.php"><button class="signup">Sign Up</button></a>
            <?php endif;?>
        </div>
    </nav>

    
    <section class="contact">
        <h1>Contact Us</h1>
        <p>Have questions? We're here to help! Reach out to us via the form below.</p>

        <div class="contact-container">
           
            <div class="contact-info">
                <h2>Contact Details</h2>
                <p><i class="fas fa-map-marker-alt"></i> 127 NCT Street, Dakar City, Australia</p>
                <p><i class="fas fa-envelope"></i> support@cybersecure.com</p>
                <p><i class="fas fa-phone"></i> +1 (408) 123-0946</p>
            </div>

            <form class="contact-form" method="post">
                <p style="color: red;"><?php showErrs($empty_err, $email_err); ?></p>
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" >

                <label id="newLbl" for="mail">Email</label>
                <input type="text" name="email" id="mail" placeholder="Enter your email" >

                <label for="message">Message</label>
                <textarea name="message" id="message" rows="5" placeholder="Type your message here..."></textarea>

                <button type="submit" name="submit">Send Message</button>
            </form>

            
            
        </div>
        
    </section>
    <footer class="bg-dark text-light py-4">
        <div class="container text-center">
            <p class="mt-3">&copy; 2024 CyberSecurity Company.   All rights reserved.</p>
            <p><a href="#" class="text-light me-2">Privacy Policy</a> <a href="#" class="text-light me-2">Cookie Policy</a></p>
            <p>Follow us on:</p>
            <a href="#" class="text-light me-2">Facebook</a> |  
            <a href="#" class="text-light ms-2">Instagram</a>
        </div>
    </footer>

</body>
</html>