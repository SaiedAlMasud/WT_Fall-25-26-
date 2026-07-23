<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <form method="POST">
         <table>
        <tr>
            <td>First Number:</td>
            <td><input type="number" name="number1"></td>
        </tr>
        <tr>
            <td>Second Number:</td>
            <td><input type="number" name="number2"></td>
        </tr>
        <tr>
            <td>Operation:</td>
            <td>
                <button type="submit" name="operation" value="add">Add</button>
                <button type="submit" name="operation" value="subtract">Subtract</button>
                <button type="submit" name="operation" value="multiply">Multiply</button>
                <button type="submit" name="operation" value="divide">Divide</button>
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Calculate"></td>
        </tr>
    </table>
    </form>
</body>
</html>

<?php
echo "<br>Basic Calculator using Switch Case in PHP<br><br>";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $x = $_POST['number1'];
    $y = $_POST['number2'];
    $operation = $_POST['operation'];

    if(!empty($x) && !empty($y)){
        switch($operation){
            case "add":
                $result = $x + $y;
                echo "Addition of $x and $y is: $result";
                break;
            case "subtract":
                $result = $x - $y;
                echo "Subtraction of $x and $y is: $result";
                break;
            case "multiply":
                $result = $x * $y;
                echo "Multiplication of $x and $y is: $result";
                break;
            case "divide":
                if($y == 0){
                    echo "Error: Division by zero is not allowed.";
                } else {
                    $result = $x / $y;
                    echo "Division of $x by $y is: $result";
                }
                break;
            default:
                echo "Invalid operation selected.";
        }
    } 
    
    else {
        echo "Please enter both numbers.";
}


}

?>