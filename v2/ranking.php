<?php
// ranking.php
include('config.php');

if(!isset($_GET['quiz_id'])){
    die("Quiz ID required.");
}
$quiz_id = intval($_GET['quiz_id']);

$sql = "SELECT u.username, r.score FROM quiz_results r JOIN users u ON r.user_id = u.id WHERE r.quiz_id = ? ORDER BY r.score DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $quiz_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ranking for Quiz <?php echo $quiz_id; ?></title>
</head>
<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background: #1e1e2f; color: #f4f4f4; text-align: center;">

    <div style="max-width: 600px; margin: 50px auto; background: #29293d; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);">
        <h1 style="font-size: 28px; margin-bottom: 15px; color: #ffcc00;">Ranking for Quiz <?php echo $quiz_id; ?></h1>

        <table style="width: 100%; border-collapse: collapse; background: #383856; color: #f4f4f4; border-radius: 10px; overflow: hidden;">
            <tr style="background: #ffcc00; color: #1e1e2f;">
                <th style="padding: 12px;">Rank</th>
                <th style="padding: 12px;">Username</th>
                <th style="padding: 12px;">Score</th>
            </tr>
            <?php
            $rank = 1;
            while($row = $result->fetch_assoc()){
                echo "<tr style='border-bottom: 1px solid #666;'>
                        <td style='padding: 12px;'>".$rank."</td>
                        <td style='padding: 12px;'>".$row['username']."</td>
                        <td style='padding: 12px;'>".$row['score']."</td>
                      </tr>";
                $rank++;
            }
            ?>
        </table>

        <p style="margin-top: 20px;">
            <a href="user_dashboard.php" style="color: #66ccff; text-decoration: none; font-weight: bold;">Back to Dashboard</a>
        </p>
    </div>

</body>
</html>
