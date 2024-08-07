<?php
include "Connection.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
    if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
    }    
    </script>
    <title>Signup form</title>
    <style>
         * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, #004d40, #00796b);
    min-height: 100vh; /* Ensure the background covers the full viewport height */
    font-family: Arial, sans-serif;
    display: flex; /* Use flexbox to center the content */
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
}

.container {
    background-color: rgb(251, 251, 251);
    color: black;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 2rem; /* Increased padding for better spacing */
    max-width:200%; /* Make the container responsive */
    max-width: 500px; /* Set a maximum width for larger screens */
    text-align: center; /* Center text inside the card */
}

h2 {
    font-size: 2rem; /* Use rem units for better scaling */
    color: black;
    margin-bottom: 1rem; /* Add some margin below the heading */
}

.input_field {
    position: relative;
    margin: 1rem 0; /* Adjusted margin for better spacing */
    border: 2px solid lightgray;
}

.input_field input {
    width: 100%; /* Make input fields responsive */
    height: 40px;
    font-size: 1rem;
    color: black;
    padding: 0 5px;
    border: none;
    border-radius: 4px; /* Optional: add border-radius for rounded corners */
}

.signup {
    background-image: radial-gradient(100% 100% at 100% 0, #00796b 0, #03a16f 100%);
    color: black;
    font-weight: bold;
    cursor: pointer;
    padding: 15px;
    font-size: 1rem;
    transition: background-color 0.3s, transform 0.3s;
    border: 0;
    border-radius: 6px;
    box-shadow: rgba(45, 35, 66, .4) 0 2px 4px, rgba(45, 35, 66, .3) 0 7px 13px -3px, rgba(58, 65, 111, .5) 0 -3px 0 inset;
    width: 100%; /* Make the button responsive */
    max-width:200px;
}

.signup:hover {
    background:lightgreen;
    color: black;
}
@media (max-width: 600px) {
    .container {
        padding: 1rem; /* Reduce padding for smaller screens */
    }

    h2 {
        font-size: 1.5rem; /* Adjust font size for smaller screens */
    }
}
         
    </style>
</head>
<body>
    <div class="container">
        <form action="Signup.php" method="POST" autocomplete="off">
            <h2>Sign-up</h2>
            <div class="input_field">
                <input type="email" placeholder="Email" name="mail" id="email-field" required>
            </div>
            <div class="input_field">
                <input type="password"  placeholder="Password" name="pass" required>
            </div>
            <input type="submit" value="Sign-up" class="signup">
           
        </form>
    </div>
</body>
</html>
    
<?php

error_reporting(0);
 if($_SERVER['REQUEST_METHOD'] == 'POST')   {
    $email= $_POST["mail"];
    $password= $_POST["pass"];
     // Check if email already exists
     $check_query = "SELECT * FROM login WHERE email = '$email'";
     $check_result = mysqli_query($conn, $check_query);
 
     if(mysqli_num_rows($check_result) > 0) {
         // Email already exists
        echo "<script>alert('Email already registered');</script>";
     } else {

        $sql = "insert into login (email,pass) values ('$email','$password')";
        $insert=mysqli_query($conn,$sql);
        if($insert){
            echo " <script> 
            alert('Records has been submitted');
            window.location.assign('Home.html')
            </script>" ;

        }
        else{
    
            echo " <script> 
            alert('Records failed to submit');
            </script>" ;
      
        }
    } 
}
?>
 
