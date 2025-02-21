<?php
// admin_dashboard.php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background: #1e1e2f; color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column; text-align: center;">

    <div style="background: #29293d; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); width: 60%; max-width: 600px;">
        <h1 style="font-size: 24px; color: #ffcc00;">Welcome, <?php echo $_SESSION['admin_username']; ?></h1>
        
        <p>
            <a href="create_quiz.php" style="text-decoration: none; color: #66ccff; font-weight: bold; margin-right: 15px;">Create New Quiz</a> | 
            <a href="admin_logout.php" style="text-decoration: none; color: #ff6666; font-weight: bold;">Logout</a>
        </p>
        
        <h2 style="color: #ffcc00; margin-top: 20px;">Your Quizzes</h2>

        <?php
        $admin_id = $_SESSION['admin_id'];
        $result = $conn->query("SELECT * FROM quizzes WHERE created_by = $admin_id ORDER BY created_at DESC");

        if($result->num_rows > 0){
            echo "<ul style='list-style: none; padding: 0;'>";
            while($row = $result->fetch_assoc()){
                echo "<li style='background: #383856; padding: 10px; margin: 5px 0; border-radius: 8px;'>
                        <strong>Topic:</strong> ".$row['topic']." | 
                        <strong>Quiz ID:</strong> ".$row['id']." | 
                        <strong>Start:</strong> ".$row['start_time']." | 
                        <strong>Duration:</strong> ".$row['duration']." minutes
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: #bbb;'>No quizzes created yet.</p>";
        }
        ?>
        <button><a href="dash.php?q=0">HOME</a></button>
    </div>

</body>
</html>
