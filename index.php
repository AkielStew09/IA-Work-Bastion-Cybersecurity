<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
                <a href="/authorisation/profile.php"><button class="login"> See Profile</button></a>
                <a href="/authorisation/Logout.php"><button class="logout" 
                onclick="return confirm('Are you sure you want to Log Out?')"> Log out</button></a>    
            <?php else:?>
                <a href="/authorisation/Login.php"><button class="login">Login</button></a>
                <a href="/authorisation/Register.php"><button class="signup">Sign Up</button></a>
            <?php endif;?>
        </div>
    </nav>

   
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to <span>Bastion CyberSecurity</span></h1>
            <img src="/image/cyber-security-logo.avif" width="400rem" alt="">
            <p>Your trusted partner in cybersecurity. Protecting businesses with advanced security solutions.</p>
            <?php if(!isset($_SESSION['uname'])):?>
            <a href="/authorisation/Login.php" class="cta-button">Sign in to Join Us!</a>
            <?php endif;?>
        </div>
    </section>

    <section class="hero2">
        <div class="hero-content">
            <h1>Fortifying Your Digital Future</h1>
            <p style="padding: 0 6rem;">
            At Sentinel Shield, we understand that in today's interconnected world, your data is your most valuable asset. Our team of professionals combines cutting-edge technology with battle-tested expertise to create impenetrable defenses for your business. We provide <strong>Data Encryption</strong>, to keep important info off limits <strong>Endpoint Security</strong>, to offer peace of mind when dealing with API's, <strong>Cloud Protection</strong> and more. Partner with us to transform vulnerability into resilience, and uncertainty into confidence.
            </p>
            <a href="/authorisation/Login.php" class="cta-button">Create an Account With Us!</a>
        </div>
    </section>
    <section class="hero3">
        <div class="hero-content">
            <h1>Battle-Tested Experts at Your Service</h1>
            <p style="padding: 0 6rem;">
            The Sentinel Shield team brings real-world experience to your security challenges. Our specialists have protected major systems from sophisticated attacks, giving us insight that matters. We don't just understand threats theoretically—we've faced them head-on and won. This practical expertise translates directly to stronger protection for your business and peace of mind for you.
            </p>
            <img src="/image/devs.webp" width="500rem" alt="">
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