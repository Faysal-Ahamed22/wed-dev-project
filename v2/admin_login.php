<?php
// admin_login.php
session_start();
if(isset($_SESSION['admin_id'])){
    header("Location: admin_dashboard.php");
    exit;
}
include('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=? AND role='admin'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $db_password);
        $stmt->fetch();
        if($password == $db_password){ // Plain text check (for demo only)
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_username'] = $username;
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $error = "Invalid credentials.";
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background: #1e1e2f; color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh;">

    <div style="background: #29293d; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); width: 350px; text-align: center;">
        <h1 style="font-size: 24px; margin-bottom: 20px; color: #ffcc00;">Teacher Login</h1>
        
        <?php if(isset($error)) echo "<p style='color: red; font-weight: bold;'>$error</p>"; ?>
        
        <form method="POST" action="">
            <label style="display: block; text-align: left; margin-bottom: 5px;">Username:</label>
            <input type="text" name="username" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 8px; border: none; outline: none; background: #383856; color: #fff;">
            
            <label style="display: block; text-align: left; margin-bottom: 5px;">Password:</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 8px; border: none; outline: none; background: #383856; color: #fff;">
            
            <input type="submit" value="Login" style="width: 100%; padding: 10px; background: #ffcc00; border: none; border-radius: 8px; color: #1e1e2f; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s;">
            
            <p style="margin-top: 15px;">
                <a href="index.php" style="color: #66ccff; text-decoration: none; font-weight: bold;">Back to Home</a>
            </p>
        </form>
    </div>

</body>
</html>
