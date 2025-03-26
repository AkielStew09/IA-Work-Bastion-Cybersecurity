<?php
    session_start();

    if(!isset($_SESSION['uname'])){
        header('Location: Login.php');
        exit();
    }

    $uname = $_SESSION['uname'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script> 
    <link rel="icon" href="cyber-security-logo.avif" type="image/x-icon">
    <title>Services</title>
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

    
    <header class="service-header">
        <h1>Our Cybersecurity Services</h1>
        <p>Protecting your business with cutting-edge security solutions.</p>
    </header>

    <section class="services">
        <div class="service-card">
            <i class="fas fa-shield-alt"></i>
            <h2>Network Security</h2>
            <p>We safeguard your networks with firewalls, intrusion detection, and security monitoring.</p>
            <a href="#" class="pricing-link">$189/month</a>
        </div>

        <div class="service-card">
            <i class="fas fa-user-shield"></i>
            <h2>Penetration Testing</h2>
            <p>Identify vulnerabilities before hackers do with our expert ethical hacking services.</p>
            <a href="#" class="pricing-link">$99/month</a>
        </div>

        <div class="service-card">
            <i class="fas fa-cloud"></i>
            <h3>Cloud Security</h3>
            <p>Secure your cloud infrastructure against unauthorized access and attacks.</p>
            <a href="#" class="pricing-link">$79/month</a>
        </div>
        
        <div class="service-card">
            <i class="fas fa-lock"></i>
            <h2>Data Protection</h2>
            <p>Ensure compliance and data integrity with encryption, backup, and recovery solutions.</p>
            <a href="#" class="pricing-link">$105/month</a>
        </div>

        <div class="service-card">
            <i class="fas fa-lock"></i>
            <h3>Data Encryption</h3>
            <p>Protect sensitive information with state-of-the-art encryption methods.</p>
            <a href="#" class="pricing-link">$115/month</a>
        </div>

        <div class="service-card">
            <i class="fas fa-file-shield"></i>
            <h3>Compliance & Auditing</h3>
            <p>Ensure your business meets cybersecurity regulations and standards.</p>
            <a href="#" class="pricing-link">$68/month</a>
        </div>

        <div class="service-card">
            <i class="fas fa-laptop-code"></i>
            <h2>Endpoint Security</h2>
            <p>Secure all devices from cyber threats with advanced endpoint protection solutions.</p>
            <a href="#" class="pricing-link">$89/month</a>
        </div>

        <div class="service-card">
        <i class="fas fa-user-secret"></i>
        <h3>Threat Intelligence</h3>
        <p>Stay ahead of cyber threats with real-time monitoring and analysis.</p>
        <a href="#" class="pricing-link">$129/month</a>
    </div>

    <div class="service-card">
        <i class="fas fa-exclamation-triangle"></i>
        <h3>Incident Response</h3>
        <p>In case of a breach, we provide rapid containment, forensic analysis, and recovery to minimize damage.</p>
        <a href="#" class="pricing-link">$119/month</a>
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