<?php
session_start();
require 'Connection.php';

// Redirect if user is not logged in
if (!isset($_SESSION['email'])) {
    header('Location:http://localhost/Snti_Project/admin_login.php ');
    exit();
}

$email = '';
$user = [];

// Fetch user data if email is set in GET request
if (isset($_GET['email'])) {
    $email = $conn->real_escape_string($_GET['email']);
    $query = "SELECT * FROM complete_info WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $row = $stmt->get_result();
    $user = $row->fetch_assoc();

    if (!$user) {
        echo "User not found.";
        exit();
    }
    $stmt->close();
}

// Update user data if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $temail = $conn->real_escape_string($_POST['email']);
    $tname = $conn->real_escape_string($_POST['tname']);
    $tcollege = $conn->real_escape_string($_POST['tcollege']);
    $tbranch = $conn->real_escape_string($_POST['tbranch']);
    $contact = $conn->real_escape_string($_POST['tcontact']);
    $dob = $conn->real_escape_string($_POST['tdob']);

    if (isset($_FILES['tpicture']) && $_FILES['tpicture']['error'] == UPLOAD_ERR_OK) {
        $tphoto = $conn->real_escape_string($_FILES['tpicture']['tname']);
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["tpicture"]["tname"]);

        if (move_uploaded_file($_FILES["tpicture"]["tmp_name"], $target_file)) {
            $update_query = "UPDATE complete_info SET tname=?, tcollege=?, tbranch=?, tcontact=?, dob=?, tpicture=? WHERE email=?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("sssssss", $tname, $tcollege, $tbranch, $contact, $dob, $tphoto, $temail);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        $update_query = "UPDATE complete_info SET tname=?, tcollege=?, tbranch=?, tcontact=?, tdob=? WHERE email=?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("ssssss", $tname, $tcollege, $tbranch, $contact, $dob, $temail);
    }

    if ($stmt->execute()) {
        header('Location: http://localhost/Snti_Project/admin_check_details.php');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', Times, serif;
        }
        body {
            background: linear-gradient(135deg, #004d40, #00796b);
            min-height: 100vh;
            line-height: 1.6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            background-color: rgb(251, 251, 251);
            color: black;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 500px;
            text-align: center;
        }
        h2 {
            font-size: 30px;
            color: black;
            padding: 20px 0;
        }
        .input_field {
            position: relative;
            margin: 20px 0;
            border-bottom: 2px solid white;
        }
        .input_field label {
            font-size: 16px;
            color: #073727;
            pointer-events: none;
        }
        .input_field input {
            width: 100%;
            height: 40px;
            font-size: 16px;
            color: #073727;
            padding: 0 5px;
            background: transparent;
        }
        #btn {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            font-size: 1rem;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        #btn:hover {
            background-color: #c62828;
        }
        .profile-img {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update User</h2>
        <form action="Update.php" method="post" enctype="multipart/form-data">
            <div class="input_field">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required>
            </div>
            <div class="input_field">
                <label for="name">Name:</label>
                <input type="text" id="name" name="tname" value="<?php echo htmlspecialchars($user['tname'] ?? ''); ?>" required>
            </div>
            <div class="input_field">
                <label for="college">College:</label>
                <input type="text" id="college" name="tcollege" value="<?php echo htmlspecialchars($user['tcollege'] ?? ''); ?>" required>
            </div>
            <div class="input_field">
                <label for="branch">Branch:</label>
                <input type="text" id="branch" name="tbranch" value="<?php echo htmlspecialchars($user['tbranch'] ?? ''); ?>" required>
            </div>
            <div class="input_field">
                <label for="contact">Contact:</label>
                <input type="text" id="contact" name="tcontact" value="<?php echo htmlspecialchars($user['tcontact'] ?? ''); ?>" required>
            </div>
            <div class="input_field">
                <label for="dob">Date of Birth:</label>
                <input type="date" id="dob" name="tdob" value="<?php echo htmlspecialchars($user['tdob'] ?? ''); ?>" required>
            </div>
            <div class="input_field">
                <label for="pic">Profile Image:</label>
                <input type="file" id="pic" name="tpicture">
                <?php if (!empty($user['tpicture'])): ?>
                <div class="profile-img">
                    <img src="img/<?php echo htmlspecialchars($user['tpicture']); ?>" width="100px" height="100px" alt="Profile Image">
                </div>
                <?php endif; ?>
            </div>
            <input type="submit" value="Update" id="btn">
        </form>
    </div>
</body>
</html>
