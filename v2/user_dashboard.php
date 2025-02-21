<?php
// user_dashboard.php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit;
}
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background: #1e1e2f; color: #f4f4f4; text-align: center;">

    <div style="max-width: 800px; margin: 50px auto; background: #29293d; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
        <h1 style="font-size: 28px; margin-bottom: 15px; color: #ffcc00;">Welcome, <?php echo $_SESSION['user_username']; ?></h1>
        <p><a href="user_logout.php" style="color: #ff6666; text-decoration: none; font-weight: bold;">Logout</a></p>

        <h2 style="font-size: 24px; margin-top: 20px; border-bottom: 2px solid #ffcc00; display: inline-block; padding-bottom: 5px;">Available Quizzes</h2>
        
        <?php
        $current_time = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM quizzes WHERE start_time <= ? ORDER BY start_time DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $current_time);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo "<ul style='list-style: none; padding: 0;'>";
            while($quiz = $result->fetch_assoc()){
                echo "<li style='background: #383856; margin: 10px 0; padding: 15px; border-radius: 10px;'>
                        <span style='font-weight: bold; color: #ffcc00;'>Topic:</span> ".$quiz['topic']." | 
                        <span style='font-weight: bold; color: #ffcc00;'>Quiz ID:</span> ".$quiz['id']."<br>
                        <span style='font-weight: bold;'>Start Time:</span> ".$quiz['start_time']." | 
                        <span style='font-weight: bold;'>Duration:</span> ".$quiz['duration']." minutes<br>
                        <a href='quiz.php?quiz_id=".$quiz['id']."' style='color: #66ff99; text-decoration: none; font-weight: bold;'>Attempt Quiz</a> | 
                        <a href='ranking.php?quiz_id=".$quiz['id']."' style='color: #66ccff; text-decoration: none; font-weight: bold;'>View Ranking</a>
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No quizzes available at this time.</p>";
        }
        ?>

        <h2 style="font-size: 24px; margin-top: 30px; border-bottom: 2px solid #ffcc00; display: inline-block; padding-bottom: 5px;">Your Past Results</h2>
        
        <?php
        $sql = "SELECT q.topic, r.score, r.submitted_at FROM quiz_results r JOIN quizzes q ON r.quiz_id = q.id WHERE r.user_id = ? ORDER BY r.submitted_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            echo "<ul style='list-style: none; padding: 0;'>";
            while($row = $result->fetch_assoc()){
                echo "<li style='background: #383856; margin: 10px 0; padding: 15px; border-radius: 10px;'>
                        <span style='font-weight: bold; color: #ffcc00;'>Topic:</span> ".$row['topic']." | 
                        <span style='font-weight: bold;'>Score:</span> ".$row['score']." | 
                        <span style='font-weight: bold;'>Submitted:</span> ".$row['submitted_at']."
                      </li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No past quiz results.</p>";
        }
        ?>
        <button><a href="account.php?q=1">HOME</a></button>
    </div>

</body>
</html>
