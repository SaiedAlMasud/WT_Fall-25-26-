function validation(event) {
            event.preventDefault();
                let fname = document.getElementById('fname').value;
                let lname = document.getElementById('lname').value;
                let email = document.getElementById('email').value;
                let dob = document.getElementById('dob').value;
                let bloodgroup = document.getElementById('bloodgroup').value;
                let weight = document.getElementById('weight').value;
                let address = document.getElementById('address').value;
                let password = document.getElementById('password').value;
                let male = document.getElementById('male').checked;
                let female = document.getElementById('female').checked;
                let photo = document.getElementById('photo').value;
                let terms = document.getElementById('terms').checked;

            if(fname=="" || lname=="" || email=="" || dob=="" ||bloodgroup=="" || weight=="" || address=="" || password=="" || (!male && !female) || !photo || !terms) {
                alert("Please fill all the fields and accept the terms.");
                return false;
            }
            if(password.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }
            if(!email.includes("@")|| !email.includes(".")) {
                alert("Please enter a valid email address.");
                return false;
        }
        alert("Registration successful!"); 
    }