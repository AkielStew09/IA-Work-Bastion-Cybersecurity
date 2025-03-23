
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script> 
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

    
    <section class="contact">
        <h1>Contact Us</h1>
        <p></p>

        <div class="contact-container">
            <div class="contact-info">
                <h2>Contact Details</h2>
                <p><i class="fas fa-map-marker-alt"></i> 127 NCT Street, Dakar City, Australia</p>
                <p><i class="fas fa-envelope"></i> support@cybersecure.com</p>
                <p><i class="fas fa-phone"></i> +1 (408) 123-0946</p>
            </div>
            <div class="contact-form">
                <h2 style="color:chartreuse;">Message sent successfully</h2>
            </div>
            
            <form style="display: none;" class="contact-form" method="post">
                <h2 style="color: green;">Message sent successfully, <?php echo"$name";?></h2>

                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>

                <label for="message">Message</label>
                <textarea name="message" id="message" rows="5" placeholder="Type your message here..." required></textarea>

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