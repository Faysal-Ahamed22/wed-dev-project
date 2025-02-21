<?php
// quiz.php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit;
}
include('config.php');

if(!isset($_GET['quiz_id'])){
    die("Invalid quiz.");
}
$quiz_id = intval($_GET['quiz_id']);

// Retrieve quiz details
$sql = "SELECT * FROM quizzes WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$quiz = $stmt->get_result()->fetch_assoc();
if(!$quiz){
    die("Quiz not found.");
}

// Check if the quiz has started and is within the allowed time
$current_time = date("Y-m-d H:i:s");
if($current_time < $quiz['start_time']){
    die("Quiz has not started yet.");
}
$end_time = date("Y-m-d H:i:s", strtotime($quiz['start_time'] . " + ".$quiz['duration']." minutes"));
if($current_time > $end_time){
    die("Quiz time is over.");
}

// Fetch questions linked to this quiz
$sql = "SELECT qq.id as qq_id, q.* FROM quiz_questions qq JOIN questions q ON qq.question_id = q.id WHERE qq.quiz_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$questions = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz: <?php echo $quiz['topic']; ?></title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #1e1e2f;
            color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
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
            max-width: 600px;
            text-align: center;
        }
        h1 {
            color: #ffcc00;
        }
        #timer {
            font-size: 18px;
            font-weight: bold;
            background: #ff4444;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            display: inline-block;
            margin-bottom: 15px;
        }
        .question {
            text-align: left;
            margin: 15px 0;
            padding: 15px;
            background: #383856;
            border-radius: 6px;
        }
        .question p {
            font-weight: bold;
        }
        input[type="radio"] {
            margin-right: 8px;
        }
        input[type="submit"] {
            background: #66ccff;
            color: black;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            width: 100%;
        }
    </style>
    <script>
        var totalTime = <?php echo $quiz['duration'] * 60; ?>; // duration in seconds
        function startTimer(){
            var timer = setInterval(function(){
                totalTime--;
                var minutes = Math.floor(totalTime / 60);
                var seconds = totalTime % 60;
                document.getElementById("timer").innerHTML = "Time Left: " + minutes + "m " + (seconds < 10 ? "0" : "") + seconds + "s";
                if(totalTime <= 0){
                    clearInterval(timer);
                    document.getElementById("quizForm").submit();
                }
            }, 1000);
        }
        window.onload = startTimer;
    </script>
</head>
<body>
    <div class="container">
        <h1>Quiz: <?php echo $quiz['topic']; ?></h1>
        <div id="timer"></div>
        <form id="quizForm" method="POST" action="submit_quiz.php">
            <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
            <?php
            $q_no = 1;
            while($row = $questions->fetch_assoc()){
                echo "<div class='question'>";
                echo "<p>".$q_no.". ".$row['question']."</p>";
                echo "<label><input type='radio' name='answer[".$row['id']."]' value='1' required> ".$row['option1']."</label><br>";
                echo "<label><input type='radio' name='answer[".$row['id']."]' value='2'> ".$row['option2']."</label><br>";
                echo "<label><input type='radio' name='answer[".$row['id']."]' value='3'> ".$row['option3']."</label><br>";
                echo "<label><input type='radio' name='answer[".$row['id']."]' value='4'> ".$row['option4']."</label><br>";
                echo "</div>";
                $q_no++;
            }
            ?>
            <input type="submit" value="Submit Quiz">
        </form>
    </div>
</body>
</html>
