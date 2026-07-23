<?php
//session created
session_start();
if(!isset($_SESSION['username'])){
    header("Location: /WT_Fall-25-26-/Final/Project/index.php");
    exit();
}

else{
    
    //apppointment cencel query
    $success = $error = "";
    if(isset($_POST['cencel-appointmet'])){
        $cencel_appointment_id = $_POST['cencel-appointmet'];

        $delete_sql = "DELETE from appointments where appointment_id ='$cencel_appointment_id'";

        if($conn -> query($delete_sql) === true){
            $success = "Appointment cencelled successfully";
        }
        else{
            $error = "Error cancelling appointment: " . $conn->error;
        }
    }



    $patient_name = $_SESSION['username'];
    //get todays date using predefined function
    $current_date = date('Y-m-d');    


//get user id
    $username= $_SESSION['username'];
    $sql= "SELECT user_id FROM patient WHERE user_name= '$username'";
    $id_result = $conn -> query($sql);
    $patient_id="";

    if($id_result -> num_rows > 0){
        $patient_row = $id_result -> fetch_assoc();
        $patient_id = $patient_row['user_id'];
    }

    // In homepageGetData.php
    $sql = "SELECT *
            FROM appointments 
            WHERE patient_id = '$patient_id' 
            AND appointment_date >= '$current_date'
            ORDER BY appointment_date ASC, appointment_time ASC";
            
    $result = $conn->query($sql);

    $upcoming_appointments = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $upcoming_appointments[] = $row;
        }
    }

    //getting data if view details is clicked
    if(isset($_GET['appointment_id'])){
        $appoint_id = $_Get['appointment_id'];
        $sql = "SELECT * FROM appointments WHERE appointment_id = '$appoint_id'";
                
        $result = $conn->query($sql);
        if($result -> num_rows > 0){
            $appointment_details = $result ->fetch_assoc();
        }

    }
}
?>