<?php
    //session created
session_start();
//check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: Login.php");
    exit();
}
else{
    //data fetching in an array key-value from database
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT * FROM patient WHERE user_name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user_result = $stmt -> get_result();

    if($user_result ->num_rows ===1){
        $user = $user_result -> fetch_assoc();
        $patient_name = $user['user_name'];
        $patient_id = $user['user_id'];
        $patient_email = $user['user_email'];
        $patient_dob = $user['dob'];
        $patient_gender = $user['gender'];
        $patient_address = $user['address'];
        $patient_bloodgroup = $user['blood_group'];
        $patient_weight = $user['weight'];
        $patient_img = $user['photo'];
    }
    $stmt->close();
}
?>