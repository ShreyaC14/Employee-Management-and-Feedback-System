<?php
session_start();
require 'Connection.php';

// Handle delete request
if (isset($_GET['delete'])) {
    $email = mysqli_real_escape_string($conn, $_GET['delete']);
    $deleteQuery = "DELETE FROM complete_info WHERE email='$email'";
    if (mysqli_query($conn, $deleteQuery)) {
        echo "<script>alert('Record deleted successfully'); window.location='http://localhost/Snti_Project/admin_check_details.php';</script>";
    } else {
        echo "<script>alert('Error deleting record');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Check your details</title>
    <style>
        /* Your existing styles */
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

        table {
            background-color: transparent;
            color: white;
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            padding: 2px;
            border: 1px solid white;
        }

        .admin_dashboard button {
            background-color: lightgreen;
            margin-bottom: 5px;
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

        .admin_dashboard button:hover {
            background-color: white;
        }

        .admin_dashboard {
            color: white;
        }

        @media (max-width: 768px) {
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
        <h1>Welcome, User!</h1>
        <a href="admin_dashboard.php" class="admin_dashboard"><button>Admin Dashboard</button></a>
        <button id="logoutButton">Logout</button>
    </div>
</header>
<main>
    <h3 align="center"><mark>Check Your Details</mark></h3>
    <center>
        <table>
            <tr>
                <th>Email</th>
                <th>Name</th>
                <th>College</th>
                <th>Branch</th>
                <th>Contact</th>
                <th>Date Of Birth</th>
                <th>Image</th>
                <th>Operations</th>
            </tr>
            <?php
            $rows = mysqli_query($conn, "SELECT * FROM complete_info");
            if (!$rows) {
                die("Database query failed."); // Replace with proper error handling
            }
            $rows = mysqli_fetch_all($rows, MYSQLI_ASSOC);

            foreach ($rows as $row) :
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                <td><?php echo htmlspecialchars($row["tname"]); ?></td>
                <td><?php echo htmlspecialchars($row["tcollege"]); ?></td>
                <td><?php echo htmlspecialchars($row["tbranch"]); ?></td>
                <td><?php echo htmlspecialchars($row["tcontact"]); ?></td>
                <td><?php echo htmlspecialchars($row["tdob"]); ?></td>
                <td><img src="img/<?php echo htmlspecialchars($row["tpicture"]); ?>" width="100px" height="100px" title="<?php echo htmlspecialchars($row['tpicture']); ?>"></td>
                <td>
                    <a href='Update.php?email=<?php echo urlencode($row["email"] ); ?>'><button style="padding:5px 15px;background-color:lightgreen;color:black;">Update</button></a>
                    <a href='?delete=<?php echo urlencode($row["email"]); ?>' onclick="return confirm('Are you sure you want to delete this record?');"><button style="padding:5px 15px;background-color:red;color:white;">Delete</button></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </center>
</main>
</body>
</html>
