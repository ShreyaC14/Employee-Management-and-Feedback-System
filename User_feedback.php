<?php
session_start();
include "Connection.php";
error_reporting(0);

$userprofile = $_SESSION['email'];
if($userprofile == true){

}
else{
    header('location:http://localhost/Snti_Project/user_login.php');

}
if($_SERVER['REQUEST_METHOD'] == 'POST')   {
    $email= $_POST["email"];
    $feedback1= $_POST["feedback1"];
    $feedback2= $_POST["feedback2"];
    $feedback3= $_POST["feedback3"];
    $remarks = $_POST["remarks"];

    $errors= [];
    function emailExists($email)
    {
        global $conn;
     
        // Check if email already exists in the database
        $check_email_query = "SELECT * FROM feedback WHERE email = '$email'";
        $check_email_result = mysqli_query($conn, $check_email_query);
        $total = mysqli_num_rows($check_email_result) ;
        if($total==1){
            return true;
        }
        else{
            return false;

        }

    }
    if(!emailExists($email)){
        $sql = "insert into feedback (email,feedback1,feedback2,feedback3,remarks) values ('$email','$feedback1','$feedback2','$feedback3','$remarks')";
        $insert=mysqli_query($conn,$sql);
        if($insert){
            echo " <script> 
            alert('Feedback Submitted');
            window.location.assign('user_dashboard.php')
            </script>" ;
        }
        else{
            echo " <script> 
                alert('Feedback failed to submit');
            </script>" ;
        }    
    }
    else{
        echo "<script>
            alert('User Already Exist');
            window.location.assign('user_dashboard.php');
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }    
    </script>
    <title>Feedback</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background: linear-gradient(135deg, #004d40, #00796b);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header {
            background: linear-gradient(135deg, #004d40, #00796b);
            color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            /* Align items to opposite corners */
            /* Ensure it takes full width */
            width: 100%;
        }



        #logoutButton {
            background-color: #f44336;
            /* A distinct color for the logout button */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #logoutButton:hover {
            background-color: #c62828;
            /* Darker shade on hover */
        }

        #userbutton {
            background-color: lightgreen;
            color: black;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #userbutton:hover {
            background-color: white;
            /* Darker shade on hover */

        }

        .container {
            position: relative;
            border-radius: 20px;
            background-color: white;
            color: black;
            width: 100%;
            max-width: 460px;
            box-shadow: 0 0 5px rgba(0, 0, 0, .1);
            margin-top: 10vh;
            margin-bottom: 15vh;
            padding-left: 50px;
            padding-top: 30px;
            padding-right: 50px;
        }

        h2 {
            font-size: 35px;
            color: black;
            text-align: center;
        }

        .input_field {
            margin: 30px 0;
        }

        .input_field label {
            width: 100%;
            max-width: 200px;
            font-size: 18px;
            color: black;
        }

        .input_field input {
            border-radius: 3px;
            width: 100%;
            outline: none;
            font-size: 18px;
            padding: 10px;
            margin-right: 25px;
            margin-top: 5px;
            margin-bottom: 4px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .submit {
            background-image: radial-gradient(100% 100% at 100% 0, #00796b 0, #03a16f 100%);
            color: black;
            font-weight: bold;
            cursor: pointer;
            padding: 15px;
            font-size: 1rem;
            transition: background-color 0.3s, transform 0.3s;
            border: 0;
            border-radius: 6px;
            padding: 15px 65px;
            margin-bottom:30px;
            margin-left: 80px ;
            box-shadow: rgba(45, 35, 66, .4) 0 2px 4px, rgba(45, 35, 66, .3) 0 7px 13px -3px, rgba(58, 65, 111, .5) 0 -3px 0 inset;
        }

        .submit:hover {
            background-color: #0b79d0;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-content">
            <a href="user_dashboard.php"><button id="userbutton">User Dashboard</button></a>
            <a href="Logout.php"><button id="logoutButton">Logout</button></a>
        </div>
    </header>
    <div class="container">
        <form action="http://localhost/Snti_Project/User_feedback.php" method="POST" autocomplete="off">
            <h2>Feedback</h2>
            <div class="input_field">
                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($userprofile);?>" <?php if
                    (!empty($userprofile)) echo 'readonly' ; ?> required>
            </div>
            <div class="input_field">
                <label for="feedback1">Feedback 1</label>
                <input type="text" name="feedback1" required>
            </div>
            <div class="input_field">
                <label for="feedback2">Feedback 2</label>
                <input type="text" name="feedback2">
            </div>
            <div class="input_field">
                <label for="feedback3">Feedback 3</label>
                <input type="text" name="feedback3">
            </div>
            <div class="input_field">
                <label for="remark">Remarks</label>
                <input type="text" name="remarks">
            </div>
            <input type="submit" value="Submit" class="submit">
        </form>
    </div>
</body>

</html>