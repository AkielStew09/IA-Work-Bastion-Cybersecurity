<?php 
    session_start();
    require "../connection.php";
    $conn = Connect();

    if (!isset($_SESSION['uname'])) {
        header("Location: login.php");
        exit();
    }

    
    // select the user info
    $stmt = $conn->prepare("SELECT f_name, l_name, email, u_name FROM tbl_users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
    // delete button
    if (isset($_POST['delete'])) {
        $delStmt = $conn->prepare("DELETE FROM tbl_users WHERE id = ?");
        $delStmt->bind_param("i", $_SESSION['id']);
        if ($delStmt->execute()) {
            session_destroy();
            header("Location: Login.php");
            exit();
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
    
    

    <div class="profile-container">
        <h1>Your Profile</h1>
        
        <div class="profile-field">
            <strong>First Name:</strong> <?= htmlspecialchars($user['f_name']) ?>
        </div>
        
        <div class="profile-field">
            <strong>Last Name:</strong> <?= htmlspecialchars($user['l_name']) ?>
        </div>
        
        <div class="profile-field">
            <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
        </div>
        
        <div class="profile-field">
            <strong>Username:</strong> <?= htmlspecialchars($user['u_name']) ?>
        </div>

        <div class="profile-actions">
            <a href="edit.php"> <button class="profbtn profbtn-edit">Edit Profile</button></a>
            
            <form method="POST" style="display: inline;">
                <button type="submit" name="delete" class="profbtn profbtn-delete" 
                        onclick="return confirm('Are you sure? Deletion cannot be undone!')">
                    Delete Account
                </button>
            </form>
        </div>
    </div>




</body>
</html>