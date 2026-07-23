<?php
    //declaring variables
    $patient_name = $_SESSION['username'];
    $doctors = [];
    $search_name = '';
    $search_specialty = '';

    $sql = "SELECT user_id FROM patient WHERE user_name = '$patient_name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patient_id = $row['user_id'];
    }

    //check if bookappointment button is clicked
     if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_booking'])) {
        $doctor_name = $_POST['doctor_name'];
        $doctor_id = $_POST['doctor_id'];
        $doctor_specialty = $_POST['doctor_specialty'];
        $appointment_date = $_POST['appointment_date'];
        $appointment_time = $_POST['appointment_time'];
        $symptoms = $_POST['symptoms'];
        $booking_success = '';
        $booking_error = '';


        //check if input is properly set
        if(!empty($doctor_name) && !empty($appointment_date) && !empty($appointment_time) && !empty($symptoms)) {
        // Insert into appointments table
        $sql = "INSERT INTO appointments (patient_name, patient_id, doctor_name, doctor_id, doctor_specialty, appointment_date, appointment_time, symptoms) VALUES ('$patient_name', '$patient_id', '$doctor_name', '$doctor_id', '$doctor_specialty', '$appointment_date', '$appointment_time', '$symptoms')";
        $booking_result = $conn->query($sql);
        if ($booking_result === TRUE) {
           $booking_success = "Appointment booked successfully!";
           echo "<script>alert('$booking_success');</script>";
        } 
        else {
            $booking_error = "Error booking appointment: " . $conn->error;
            echo "<script>alert('$booking_error');</script>";
        }
    }
}
    // Check if search form was submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
        $search_name = $_POST['search_name'];
        $search_specialty = $_POST['search_specialty'];
        
        // Build SQL query based on search criteria
        $sql = "SELECT * FROM doctor WHERE 1=1";
        
        if(!empty($search_name)) {
            $sql .= " AND user_name LIKE '%$search_name%'";
        }
        
        if(!empty($search_specialty)) {
            $sql .= " AND specilization = '$search_specialty'";
        }
        //sql command is ready, Now execute it
        $sql .= " ORDER BY user_name ASC";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row;
            }
        }
    } 
    else {
        // If not searching, get all doctors
        $sql = "SELECT * FROM doctor ORDER BY user_name ASC";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $doctors[] = $row;
            }
        }
    }
?>