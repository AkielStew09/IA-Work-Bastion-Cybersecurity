<?php
session_start();
require "../connection.php";
$conn = Connect();

if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}


$stmt = $conn->prepare("SELECT f_name, l_name, email, u_name FROM tbl_users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// take form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fName = $conn->real_escape_string(trim($_POST['f_name']));
    $lName = $conn->real_escape_string(trim($_POST['l_name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $username = $conn->real_escape_string(trim($_POST['u_name']));

    $stmt = $conn->prepare("UPDATE tbl_users SET f_name=?, l_name=?, email=?, u_name=? WHERE id=?");
    $stmt->bind_param("ssssi", $fName, $lName, $email, $username, $_SESSION['id']);
    
    if ($stmt->execute()) {
        header("Location: profile.php?updated=1"); //sends you back with a success flag
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="/css/styles.css">
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



    <div class="edit-form">
        <h1>Edit Profile</h1>
        
        <form method="POST">
            <div class="form-group">
                <label>First Name:</label>
                <input type="text" name="f_name" value="<?= htmlspecialchars($user['f_name']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Last Name:</label>
                <input type="text" name="l_name" value="<?= htmlspecialchars($user['l_name']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="u_name" value="<?= htmlspecialchars($user['u_name']) ?>" required>
            </div>
            
            <button type="submit" class="profbtn profbtn-edit">Save Changes</button>
            <a href="profile.php"><button class="profbtn">Cancel</button></a>
        </form>
    </div>
</body>
</html>