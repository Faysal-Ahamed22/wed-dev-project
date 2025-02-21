<?php
// submit_quiz.php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit;
}
include('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $quiz_id = intval($_POST['quiz_id']);
    $answers = $_POST['answer']; // array: question_id => selected option
    
    $score = 0;
    foreach($answers as $question_id => $selected_option){
        $stmt = $conn->prepare("SELECT correct_option FROM questions WHERE id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->bind_result($correct_option);
        $stmt->fetch();
        if($selected_option == $correct_option){
            $score++;
        }
        $stmt->close();
    }
    
    // Save the result in quiz_results
    $stmt = $conn->prepare("INSERT INTO quiz_results (quiz_id, user_id, score) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $quiz_id, $_SESSION['user_id'], $score);
    $stmt->execute();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Submitted</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #1e1e2f;
            color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background: #29293d;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            width: 80%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: #ffcc00;
        }
        .score-box {
            background: #383856;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px;
            color: #66ccff;
            margin: 15px 0;
        }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #66ccff;
            color: black;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }
        a:hover {
            background: #5599dd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quiz Submitted Successfully</h1>
        <div class="score-box">
            Your Score: <?php echo $score; ?>
        </div>
        <a href="user_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
