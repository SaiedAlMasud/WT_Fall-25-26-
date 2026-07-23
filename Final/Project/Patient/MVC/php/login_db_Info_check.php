<?php
//session created
session_start();
if(isset($_SESSION['username'])) {
    header("Location: HomePage.php");
    exit();
}

    
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if remember me is clicked
    if(isset($_POST['remember'])) {
        // Store cookie for 60 sec
        setcookie('remember_me', $username, time() + 60, '/');
    } else {
        // Clear the cookie
        setcookie('remember_me', '', time() - 3600, '/');
    }

    $stmt = $conn->prepare("SELECT user_name, password FROM users WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user_result = $stmt -> get_result();

    if($user_result -> num_rows ===1) {
        $user = $user_result -> fetch_assoc();
        if(password_verify($password, $user['password'])) {
            // Password is correct, start a session
            $_SESSION['username'] = $user['user_name'];
            header("Location: Patient\MVC\html\HomePage.php");
            exit();
        } 
        else {
            // Invalid password
            $error = "Invalid username or password.";
        }
    }
    else{
        $error = "User not found";
    }
    $stmt->close();
}

?>

