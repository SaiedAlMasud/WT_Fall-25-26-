<?php
    $date="";
    $month="";
    $year= "";

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Lab Task 1</title>
    <style>
        div {
            border: 2px solid black;
            width: 250px;
            padding: 10px;
        }
        input[type=text] {
            width: 30px;
        }
    </style>
</head>
<body>
    <form action="task3.php" method="post">
        <div>
            <h3>Date of Birth</h3>
            <input type="text" name="date">/
            <input type="text" name="month">/
            <input type="text" name="year">
            <hr>
            <input type="submit" name="submit">
        </div>
    </form>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $date= trim($_POST["date"]);
        $month= trim($_POST["month"]);
        $year= trim($_POST["year"]);

        if(empty($date) || empty($month) || empty($year)){
            echo "Date of Birth cannot be empty";
        }
        elseif($date <1 || $date >31 || $month <1 || $month >12 || $year <1998 || $year >1953){
            echo "Enter valid Date of Birth";
        }
        else{
            echo "Valid Date of Birth";
        }
    }
?>