<?php
//database connection
require '../db/db_connect.php';
//getting data if view details is clicked
    if(isset($_GET['appointment_id'])){
        $appoint_id = $_GET['appointment_id'];
        $sql = "SELECT * FROM appointments WHERE appointment_id = '$appoint_id'";
                
        $result = $conn->query($sql);
        if($result -> num_rows > 0){
            $appointment_details = $result ->fetch_assoc();
            
	        echo '<p>Patient Name: ' .$appointment_details['patient_name']. '</p>';
            echo '<p>Doctor Name: ' .$appointment_details['doctor_name']. '</p>';
            echo '<p>Doctor Speciality: ' .$appointment_details['doctor_specialty']. '</p>';
            echo '<p>Appointment Date: ' .$appointment_details['appointment_date']. '</p>';
            echo '<p>Appointment time: ' .$appointment_details['appointment_time']. '</p>';
            echo '<p>Symptoms: ' .$appointment_details['symptoms']. '</p>';
            
        }

        else {
            echo "<p>No appointment found</p>";
    }
}

?>
