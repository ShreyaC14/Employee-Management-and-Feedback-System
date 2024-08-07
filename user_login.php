<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
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

.login {
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
}

.login:hover {
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
        <form action="http://localhost/Snti_Project/user_login.php" method="POST" autocomplete="off">
            <h2>User Login</h2>
            <div class="input_field">
                <input type="email" placeholder="Email" name="email" id="mail" required>
            </div>
            <div class="input_field">
                <input type="password" placeholder="Password" name="pass" id="password" required>
            </div>
            <input type="submit" value="Login" class="login" name="login">
          <!--  <div class="reg"><a href="Complete_reg.html">Complete your registration</a></div> -->
            
            
        </form>
    </div>
</body>
</html>
<h1><p align="center">
<?php
include 'Connection.php';
 
if(isset($_POST['login'])){
$email= $_POST["email"];
$password= $_POST["pass"];

$query = "select * from login where email='$email' && pass ='$password' ";
$result = mysqli_query($conn,$query);

$total = mysqli_num_rows($result);

if($total == 1){  
       $_SESSION['email'] = $email;
       header('location:http://localhost/Snti_Project/user_dashboard.php');
  }
  else{
    echo " <script> 
    alert('Login failed');
    </script>" ;
  }
   
}

?>
