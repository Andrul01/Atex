<?php
    require_once('includes/config.php');

    // Redirect if already logged in
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        header('Location: dashboard.php');
        exit();
    }
    
    // login 
    $showError = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get input values from form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // SQL query to find the user by username
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);

        if($numRows == 1) {
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION['admin'] = true;              // Set admin session
            $_SESSION['username'] = $username;      // Store username
            $_SESSION['sno'] = $row['id'];          // Store user ID (primary key)
            
            // Redirect to the dashboard
            header("Location: dashboard.php");
            exit();
        } 
    }

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="icon" href="assets/images/favicon.png"/>
    <title>Atex - Admin login panel</title>
</head>
<body>
     <div class="container my-5 ">
        <div class="container-fluid">
            <div class="row-12 bg-primary text-white p-2">
                <div class="col-12">
                    <h1>Admin login</h1>
    
                </div>
            </div>
            <div class="row-12 p-3">
                <form method="POST" action="">
                    <label>Username:</label>
                    <input type="text" class="form-control" name="username" required>
                    <br>
                    <label>Password:</label>
                    <input type="password" class="form-control" name="password" required>
                    <br>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>