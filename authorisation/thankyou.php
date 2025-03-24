<?php 



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
        //keeping the file output from last assignment, 
        //this time we're inserting the data to our db too
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO tbl_users(f_name, l_name, email, u_name, pw) VALUES(?, ?, ?, ?, ?)";

        if($stmt = $conn->prepare($insertQuery)){//prepare statement
            $stmt->bind_param("sssss", $fName, $lName, $email, $uname, $hash);   //set the params

            if($stmt->execute()){
                $displayMsg = "Thank You for resgistering with us, <span>$fName</span>, welcome to the Bastion Squadron!";
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



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="..\css\styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://kit.fontawesome.com/YOUR_KIT_CODE.js" crossorigin="anonymous"></script> 
    <link rel="icon" href="cyber-security-logo.avif" type="image/x-icon">
</head>
<body>


    <nav class="navbar">
        <div class="logo">
            <img src="/image/crop-cyber-logo.jpg" alt="">
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

   
    <section class="hero">
        <div class="hero-content">
            <h1><?php echo $displayMsg; ?></h1>
            <img src="/image/cybersecurity_audit.jpg" width="400px" alt="">
            
            <a href="/Services.php" class="cta-button">Click to see our services!</a>
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