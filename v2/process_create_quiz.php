<?php
// process_create_quiz.php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}
include('config.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $topic = $_POST['topic'];
    $num_questions = intval($_POST['num_questions']);
    $start_time = $_POST['start_time'];
    $duration = intval($_POST['duration']);
    $admin_id = $_SESSION['admin_id'];

    // Insert new quiz record
    $stmt = $conn->prepare("INSERT INTO quizzes (topic, total_questions, start_time, duration, created_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sissi", $topic, $num_questions, $start_time, $duration, $admin_id);
    if($stmt->execute()){
        $quiz_id = $stmt->insert_id;
        // Randomly select questions for the quiz based on the topic
        $sql = "SELECT id FROM questions WHERE topic=? ORDER BY RAND() LIMIT ?";
        $stmt2 = $conn->prepare($sql);
        $stmt2->bind_param("si", $topic, $num_questions);
        $stmt2->execute();
        $result = $stmt2->get_result();
        while($row = $result->fetch_assoc()){
            $question_id = $row['id'];
            $stmt3 = $conn->prepare("INSERT INTO quiz_questions (quiz_id, question_id) VALUES (?, ?)");
            $stmt3->bind_param("ii", $quiz_id, $question_id);
            $stmt3->execute();
        }
        $message = "Quiz created successfully.";
        $success = true;
    } else {
        $message = "Error creating quiz: " . $conn->error;
        $success = false;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Creation Status</title>
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
            color: <?php echo $success ? "#00cc66" : "#ff3333"; ?>;
        }
        .message-box {
            background: #383856;
            padding: 15px;
            font-size: 18px;
            border-radius: 8px;
            color: <?php echo $success ? "#00cc66" : "#ff6666"; ?>;
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
        <h1><?php echo $success ? "Success!" : "Error!"; ?></h1>
        <div class="message-box">
            <?php echo $message; ?>
        </div>
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
