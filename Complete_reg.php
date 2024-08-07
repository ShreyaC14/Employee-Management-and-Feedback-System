<?php
session_start();
include "Connection.php";
error_reporting(E_ALL);

$userprofile = $_SESSION['email'];
if($userprofile == true){

}
else{
    header('location:http://localhost/Snti_Project/user_login.php');

}
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $temail = $_POST['email'];
    $tname =$_POST['tname'];
    $tcollegename = $_POST['tcollege'];
    $tbranch =$_POST['tbranch'];
    $tphnno = $_POST['tcontact'];
    $tdate = $_POST['tdob'];
    $errors= [];

    function emailExists($temail)
    {
        global $conn;

     // Check if email already exists in the database
        $check_email_query = "SELECT * FROM complete_info WHERE email = '$temail'";
        $check_email_result = mysqli_query($conn, $check_email_query);
        $total = mysqli_num_rows($check_email_result) ;
        if($total==1){
            return true;
        }
        else{
            return false;
   
        }
    }

    // Validate phone number (assuming 10 digits)
    if (!preg_match("/^[0-9]{10}$/", $tphnno)) {
        $errors[] = "Please enter a valid 10-digit Mobile Number";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('".$error."');</script>";
        }
    } else {
    // check if file was uploaded    
    if($_FILES["tpicture"]["error"] == 4){
        echo
        "<script> alert('Image Does Not Exist'); </script>";
        
    }
    else{
        $fileName = $_FILES["tpicture"]["name"];
        $fileSize = $_FILES["tpicture"]["size"];
        $tmpName = $_FILES["tpicture"]["tmp_name"];

        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));
        if ( !in_array($imageExtension, $validImageExtension) ){
        echo
        "
        <script>
           alert('Invalid Image Extension');
        </script>
        ";
        }
        else if($fileSize > 1000000){
        echo
        "
        <script>
           alert('Image Size Is Too Large');
        </script>
        ";
        }
        else{
            $tphoto = uniqid();
            $tphoto .= '.' . $imageExtension;
   
            move_uploaded_file($tmpName, 'img/' . $tphoto);
            // insert data into database
            if(!emailExists($temail)){
              $sql = "insert into complete_info (email,tname,tcollege,tbranch,tcontact,tdob,tpicture)values ('$temail','$tname','$tcollegename','$tbranch','$tphnno','$tdate','$tphoto')";
              $insert=mysqli_query($conn,$sql);
              if($insert){
                echo " <script> 
                alert('Registration Completed');
                window.location.assign('user_dashboard.php')
                </script>" ;
                }
               else {
                echo " <script> 
                alert('Records failed to submit');
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
    }
   
}
    
}    


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
    <title>Document</title>
    <link rel="stylesheet" href="Complete_registration.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
        <div class="header-content">
            <a href="user_dashboard.php"><button id="userbutton">User Dashboard</button></a>
            <a href="Logout.php"><button id="logoutButton">Logout</button></a>
        </div>
</header>    
<div class="main">
        <div class="container">
            <form class="form" action="http://localhost/Snti_Project/Complete_reg.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <h2>Complete Your Registration</h2>
                <div class="input_field">
                    <label id="email" for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userprofile);?>" <?php if (!empty($userprofile)) echo 'readonly'; ?>  required>
                 
                </div>
                <div class="input_field">
                    <label for="tname">Trainee Name</label>
                    <input type="text" name="tname" id="name" required pattern="[A-Za-z\s]+" title="Please enter only alphabetic characters and spaces">
                  
                </div>
                <div class="input_field">
                    <label for="tcollegename">College Name</label>
                    <input type="text" name="tcollege" id="cname" required>
                  
                </div>
                <div class="input_field">
                    <label for="tbranch">Branch</label>
                    <select name="tbranch" id="tbranch" style="
            border-radius: 3px;width: 100%;padding:15px; outline: none; margin-bottom:5px;font-size:16px;
            margin-right: 25px; " required>
                        <option value="select">Select</option>
                        <option value="Computer Science">Computer Science</option>
                        <option value="Mechanical">Mechanical</option>
                        <option value="Electrical">Electrical</option>
                        <option value="ECE">ECE</option>
                    </select>
                   
                </div>
                <div class="input_field">
                    <label for="tcontact">Contact Number</label>
                    <input type="number" name="tcontact" id="tno" required >
                
                </div>
                <div class="input_field">
                    <label for="dob">Date Of Birth</label>
                    <input type="date" name="tdob" id="dateofbirth" required>
                </div>
                <div class="input_field">
                    <label for="tphoto">Photo</label>
                    <input class="photo" type="file" name="tpicture" value="null" id="pic" accept=".jpg, .jpeg, .png"   required>
                </div>
                <div class="input_field">
                    <input class="btn" type="submit" value="SUBMIT" name="submit">
                    </div> 
            </form>
        </div>
    </div>
</main>
</body>
</html>