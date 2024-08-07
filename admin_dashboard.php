<?php
session_start();
require 'Connection.php';
error_reporting(0);

$userprofile = $_SESSION['email'];

if($userprofile == true){

}
else{
    header('location:http://localhost/Snti_Project/admin_login.php');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Reset some basic elements */
        body, h1, h2, button {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Basic styles */
        body {
            background: linear-gradient(135deg, #004d40, #00796b);
            min-height: 100vh; /* Ensure the background covers the full viewport height */
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        header {
            background: linear-gradient(135deg, #004d40, #00796b);
            color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            display: flex;
            justify-content: space-between; /* Space between the items */
            align-items: center;
        }

        .header-content {
            display: flex;
            justify-content: space-between; /* Align items to opposite corners */
            width: 100%; /* Ensure it takes full width */
        }

        header h1 {
            margin: 0;
            font-size: 1.5rem; /* Adjust font size if needed */
        }

        #logoutButton {
            background-color: #f44336; /* A distinct color for the logout button */
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        #logoutButton:hover {
            background-color: #c62828; /* Darker shade on hover */
        }

        /* Main content styling */
        main {
            padding: 2rem;
        }

        .card-container {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background-color: rgb(251, 251, 251);
            color: black;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            aspect-ratio: 1 / 1; /* Ensures cards are square */
            flex: 1 1 calc(50% - 1rem);
            box-sizing: border-box;
            max-width: 400px; /* Optional: max width for larger screens */
            text-align: center; /* Center text inside the card */
            margin-top: 5px;
            padding-bottom: 1rem;
        }

        .card h2 {
            margin-bottom: 0.5rem 0;
            font-size: 1.25rem;

        }
        .card img {
        height: 50px; /* Consistent image height */
        margin: 1rem 0; /* Adjusted spacing above and below the image */
        }
        .card button {
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
        }

        .card button:hover {
            background-color: #0b79d0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center; /* Center cards horizontally */
            }

            .card {
                padding-bottom: 55px;
                flex: 1 1 auto;
                max-width: 100%; /* Ensure cards do not overflow */
            }

            header {
                flex-direction: column; /* Stack items vertically */
                align-items: flex-start; /* Align items to the start */
            }

            .header-content {
                width: 100%; /* Ensure full width for stacking */
                justify-content: space-between; /* Align items to opposite ends */
            }

            #logoutButton {
                margin-top: 0.5rem; /* Margin to separate logout button from welcome text */
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1><?php echo "Welcome, ".$_SESSION['email']; ?></h1>
            <a href="Logout.php"><button id="logoutButton">Logout</button></a>
        </div>
    </header>
    <main>
        <div class="card-container">
            <div class="card">
                <h2>Registration Details</h2>
                <img src="images/check_your_details.jpeg" style="height: 50px; margin-bottom: 20px; margin-top: 20px;">
                <br>
                <a href="admin_check_details.php"><button>View Details</button></a>
            </div>
            <div class="card">
                <h2>Feedback</h2>
                <img src="images/feedback.jpg" style="height: 50px; margin-bottom: 20px; margin-top: 20px;">
                <br>
                <a href="admin_viewfeedback.php"><button>View Feedback</button></a>
            </div>
        </div>
    </main>
</body>
</html>

