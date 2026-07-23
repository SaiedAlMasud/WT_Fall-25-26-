<?php
//session created
session_start();

if(!isset($_SESSION['username'])){
    header("Location: Login.php");
    exit();
}
//declaring variables
else{
    $sql = "SELECT * FROM medicalhistory ORDER BY appointment_date ASC";
    $result = $conn->query($sql);
    $medical_historys = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $medical_historys[] = $row;
            }
        }
}
?>