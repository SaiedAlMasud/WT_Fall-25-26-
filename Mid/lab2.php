<!DOCTYPE html>
<head>
    <title>
        Lab 2
    </title>
    <style>
        #reg {
            background-color: lightgray;
            align-items: center;
            width: 300px;
            padding: 10px;
            margin: 0 auto;
        }

        #course {
            background-color: lightgray;
            align-items: center;
            width: 300px;
            padding: 10px;
            margin: 0 auto;
        }
        #errorMessage{
            color: black;
            text-align: center;
            margin-top: 10px;
        }
        table {
            width: 100%;
        }
    </style>
</head>
<body>
    <div id="reg">
        <h2>Student Registration</h2>
        <form onsubmit="return validation()">
             <table>
            <tr>
                <td>Full Name</td>
            </tr>
            <tr>
                <td><input type="text" id="Fname"></td>
            </tr>
            <tr>
                <td>Email</td>
            </tr>
            <tr>
                <td><input type="email" id="Email"></td>
            </tr>
            <tr>
                <td>Password</td>
            </tr>
            <tr>
                <td><input type="password" id="Password"></td>
            </tr>
            <tr>
                <td>Confirm Password</td>
            </tr>
            <tr>
                <td><input type="password" id="Cpassword"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Register" id="RegisterButton"></td>
            </tr>
        </table>
        </form>
    </div>
    <div id="errorMessage">

    </div>
    <div id="outputMessage">

    </div>
    <div id="course" style="margin-top: 20px;">
        <h2>Course Registration</h2>
        <table>
            <tr>
                <td>Course Name: </td>
            </tr>
            <tr>
                <td>
                    <input type="text">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Add Course">
                </td>
            </tr>
        </table>
    </div>
    <table class="selectedCourse">

    </table>

    <script>
        function validation(){
            let name = document.getElementById("Fname").value.trim();
            let email = document.getElementById("Email").value.trim();
            let password = document.getElementById("Password").value;
            let cpassword = document.getElementById("Cpassword").value;

            let errorDiv= document.getElementById("errorMessage");
            let outputDiv = document.getElementById("outputMessage");

            errorDiv.innerHTML = "";
            outputDiv.innerHTML = "";

            if(name === "" || email === "" || password === "" || cpassword === ""){
                errorDiv.innerHTML = "Please fill in all fields with proper info.";
                return false;
            }

            if(email.indexOf("@") === -1){
                errorDiv.innerHTML = "Please enter a valid email address.";
                return false;
            }
            if(password !== cpassword){
                errorDiv.innerHTML = "Passwords do not match.";
                return false;
            }
            outputDiv.innerHTML = '<strong>Registration successful!</strong> <br>'+
            'Name: ' + name + '<br>' +
            'Email: ' + email;
            return false;
        }
    </script>
</body>
</html>