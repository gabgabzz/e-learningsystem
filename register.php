<?php  
require_once("include/initialize.php");
if (isset($_SESSION['StudentID'])) {
    redirect('index.php');
}

// Process registration if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnRegister'])) {
    // Sanitize inputs
    $fname = trim($_POST['FNAME']);
    $lname = trim($_POST['LNAME']);
    $address = trim($_POST['ADDRESS']);
    $phone = trim($_POST['PHONE']);
    $username = trim($_POST['USERNAME']);
    $password = trim($_POST['PASS']);
    
    // Validate inputs
    $errors = array();
    if (empty($fname)) $errors[] = "First name is required";
    if (empty($lname)) $errors[] = "Last name is required";
    if (empty($username)) $errors[] = "Username is required";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters";
    if ($password != $_POST['CONFIRM_PASS']) $errors[] = "Passwords do not match";
    
    if (empty($errors)) {
        // Check if username exists
        $sql = "SELECT * FROM tblstudent WHERE STUDUSERNAME = '".$mydb->escape_value($username)."'";
        $mydb->setQuery($sql);
        $result = $mydb->executeQuery();
        
        if ($mydb->num_rows($result) > 0) {
            message("Username already exists. Please choose another one.", "error");
        } else {
            // Insert new student
            $hashed_password = sha1($password);
            $sql = "INSERT INTO tblstudent (Fname, Lname, Address, MobileNo, STUDUSERNAME, STUDPASS) 
                    VALUES (
                        '".$mydb->escape_value($fname)."',
                        '".$mydb->escape_value($lname)."',
                        '".$mydb->escape_value($address)."',
                        '".$mydb->escape_value($phone)."',
                        '".$mydb->escape_value($username)."',
                        '".$hashed_password."'
                    )";
            $mydb->setQuery($sql);
            
            if ($mydb->executeQuery()) {
                message("You are now registered. You can login now!", "success");
                redirect("login.php");
            } else {
                message("Registration failed: ".$mydb->getErrorMsg(), "error");
            }
        }
    } else {
        message(implode("<br>", $errors), "error");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>E-Learning System - Registration</title>
    <link href="<?php echo web_root;?>plugins/registration/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <link href="<?php echo web_root;?>plugins/registration/css/main.css" rel="stylesheet">
    
    <style>
        .error-message {
            color: #dc3545;
            padding: 10px;
            margin-bottom: 15px;
            background: #f8d7da;
            border-radius: 4px;
        }
        .success-message {
            color: #28a745;
            padding: 10px;
            margin-bottom: 15px;
            background: #d4edda;
            border-radius: 4px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .card {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <div class="page-wrapper bg-white p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    
                    <?php 
                    if (isset($_SESSION['message'])) {
                        $messageType = $_SESSION['message_type'];
                        $messageText = $_SESSION['message'];
                        echo "<div class='$messageType-message'>$messageText</div>";
                        unset($_SESSION['message']);
                        unset($_SESSION['message_type']);
                    }
                    ?>
                    
                    <form method="POST" action="register.php">
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Firstname" name="FNAME" value="<?php echo isset($_POST['FNAME']) ? htmlspecialchars($_POST['FNAME']) : ''; ?>" required>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Lastname" name="LNAME" value="<?php echo isset($_POST['LNAME']) ? htmlspecialchars($_POST['LNAME']) : ''; ?>" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Address" name="ADDRESS" value="<?php echo isset($_POST['ADDRESS']) ? htmlspecialchars($_POST['ADDRESS']) : ''; ?>" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Phone" name="PHONE" value="<?php echo isset($_POST['PHONE']) ? htmlspecialchars($_POST['PHONE']) : ''; ?>" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Username" name="USERNAME" value="<?php echo isset($_POST['USERNAME']) ? htmlspecialchars($_POST['USERNAME']) : ''; ?>" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="password" placeholder="Password (min 6 characters)" name="PASS" id="password" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="password" placeholder="Confirm Password" name="CONFIRM_PASS" id="confirm_password" required>
                        </div>

                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="btnRegister">Submit</button>
                            <a href="login.php" style="margin-left: 20px;">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Validation JS -->
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            if (password.length < 6) {
                alert("Password must be at least 6 characters long!");
                e.preventDefault();
                return false;
            }
            
            if (password !== confirmPassword) {
                alert("Passwords do not match!");
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>