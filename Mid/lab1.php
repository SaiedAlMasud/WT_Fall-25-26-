<!DOCTYPE html>
<html>
<head>
    <title>Form page</title>
    <style>
        td{
            font-size: 20px;
        }
        .text{
            width: 80%;
            font-size: 20px;
        }
        table{
            margin:0 auto;
            width: 60%;
        }
    </style>
</head>
<body style="background-color:rgb(167, 176, 170)">
    <table style="background-color:rgba(246, 230, 241, 1);padding-left: 20px">
        <tr>
            <td style="border-bottom: 2.5px solid red;"><h3 id="heading" style="color:red">Student Registration Information</h3></td>
        </tr>
        <tr><td>First Name </td></tr>
        <tr><td><input type="text" class="text"></td></tr>
        <tr><td>Last Name </td></tr>
        <tr><td><input type="text" class="text"></td></tr>
        <tr><td>Student ID </td></tr>
        <tr><td><input type="number" class="text"></td></tr>
        <tr><td>Program/Major </td></tr>
        <tr><td><input type="text" class="text"></td></tr>
        <tr><td>Department </td></tr>
        <tr><td><input type="text" class="text"></td></tr>
        <tr><td>Phone </td></tr>
        <tr><td><input type="number" class="text"></td></tr>
        <tr><td>University Email </td></tr>
        <tr><td><input type="email" class="text"></td></tr>
        <tr><td>Create Password (min 8 character) </td></tr>
        <tr><td><input type="password" class="text"></td></tr>
        <tr><td>Confirm password </td></tr>
        <tr><td><input type="password" class="text"></td></tr>
        <tr><td>Semester selection </td></tr>
        <tr><td>
            <input type="radio">Summer 2024  
            <input type="radio" >Fall 2024  
            <input type="radio">Spring 2025 <br> 
            <input type="radio">Other/Special term  
        </td></tr>
        <tr><td>Required Credit Load(max 15) </td></tr>
        <tr><td>
            <input type="text" class="text">
        </td></tr>
        <tr><td>
            <input type="checkbox">I require academic advising before final Registration
        </td></tr>

        <tr><td><h3 style="color:red;border-bottom: 2.5px solid red;">Course Selection</h3></td></tr>
        <tr><td>
            <input type="checkbox">MATH 1201 (Calculus) 
            <input type="checkbox">CS 2105 (Data Structures) 
            <input type="checkbox">ECON 1001 (Microeconomics) <br>
            <input type="checkbox">PHY 1102 (Physics Lab)
        </td></tr>
        <tr><td>Comments/Special Requests</td></tr>
        <tr><td>
            <input type="text" style="height:90px;width:85%">
        </td></tr>
        <tr><td>
            <button style="background-color:green; color:white; margin: 5px 8px 10px 5px ; font-size:18px"> Submit </button>
        </td></tr>


    
    </table>
</body>
</html>
