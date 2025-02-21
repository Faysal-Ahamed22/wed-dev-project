<?php
// create_quiz.php
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
    <title>Create Quiz</title>
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background: #1e1e2f; color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; text-align: center; flex-direction: column;">

    <div style="background: #29293d; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); width: 60%; max-width: 500px;">
        <h1 style="font-size: 24px; color: #ffcc00;">Create a New Quiz</h1>
        
        <form method="POST" action="process_create_quiz.php" style="display: flex; flex-direction: column; gap: 15px;">
            <label style="font-weight: bold;">Topic:</label>
            <select name="topic" required style="padding: 8px; border-radius: 6px; border: none; background: #383856; color: white;">
                <option value="c++">C++</option>
                <option value="java">Java</option>
                <option value="python">Python</option>
            </select>
            
            <label style="font-weight: bold;">Number of Questions:</label>
            <input type="number" name="num_questions" min="1" required style="padding: 8px; border-radius: 6px; border: none; background: #383856; color: white;">

            <label style="font-weight: bold;">Start Time (YYYY-MM-DD HH:MM:SS):</label>
            <input type="text" name="start_time" required style="padding: 8px; border-radius: 6px; border: none; background: #383856; color: white;">

            <label style="font-weight: bold;">Duration (in minutes):</label>
            <input type="number" name="duration" min="1" required style="padding: 8px; border-radius: 6px; border: none; background: #383856; color: white;">

            <input type="submit" value="Create Quiz" style="background: #66ccff; color: black; padding: 10px; border-radius: 8px; font-weight: bold; border: none; cursor: pointer;">
        </form>

        <p style="margin-top: 15px;">
            <a href="admin_dashboard.php" style="text-decoration: none; color: #ff6666; font-weight: bold;">Back to Dashboard</a>
        </p>
    </div>

</body>
</html>
