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
                $displayMsg = "Thank You for resgistering with us, welcome to the Bastion Squadron!";
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