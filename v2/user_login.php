<?php
// user_login.php
session_start();
if(isset($_SESSION['user_id'])){
    header("Location: user_dashboard.php");
    exit;
}
include('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=? AND role='student'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows > 0){
        $stmt->bind_result($id, $db_password);
        $stmt->fetch();
        if($password == $db_password){ // Plain text check (for demo only)
            $_SESSION['user_id'] = $id;
            $_SESSION['user_username'] = $username;
            header("Location: user_dashboard.php");
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
    <title>Student Login</title>
</head>
<body style="background: linear-gradient(135deg, #667eea, #764ba2); font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">

    <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); text-align: center; width: 100%; max-width: 400px;">
        <h1 style="color: #333; margin-bottom: 20px;">Student Login</h1>
        
        <?php if(isset($error)) echo "<p style='color: red; font-size: 14px;'>$error</p>"; ?>
        
        <form method="POST" action="">
            <label style="display: block; text-align: left; font-weight: bold; margin-bottom: 5px;">Username:</label>
            <input type="text" name="username" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;">

            <label style="display: block; text-align: left; font-weight: bold; margin-bottom: 5px;">Password:</label>
            <input type="password" name="password" required style="width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 5px;">
<!-- <input type="submit" value="Login" style="width: 100%; background: #667eea; border: none; padding: 12px; font-size: 16px; color: white; border-radius: 5px; cursor: pointer; transition: background 0.3s;"> -->
            
            <input type="submit" value="Login" style="width: 100%; background: #667eea; border: none; padding: 12px; font-size: 16px; color: white; border-radius: 5px; cursor: pointer; transition: background 0.3s;">
        </form>
    </div>

</body>
</html>
