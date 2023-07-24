<?php
session_start();

if($_SESSION['result']=='not' && $_SERVER['REQUEST_METHOD'] !== 'POST'){

  
  header('location:quiz.php');
}

$_SESSION['result']='accessed';
$_SESSION['quiz']='not';
if ($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SESSION['name'])) {

  $_SESSION['result']='accessed';
  $_SESSION['quiz']='not';
  
  // foreach ($_SESSION as $key=>$val)
  // echo $key." ".$val."<br/>";

//  echo $_SESSION['$result'],$_SESSION['$quiz'];
  // Check if the user's name is stored in the session
  if (isset($_SESSION['name']) && !empty($_SESSION['name'])) {
    $name = $_SESSION['name'];
  } else {
    header("Location: login.php");
    exit;
  }
} else {
  header("Location: login.php");
  exit;
}

 //connecting to db
include "dbconnect.php";


$score = 0;
$totalQuestions = $conn->query("SELECT COUNT(question) FROM questions");
$correctAnswers = 0;
$wrongAnswers = 0;
$total = mysqli_fetch_array($totalQuestions);
// echo $total['COUNT(question)'];

// Calculate the user's score, total questions, correct answers, and wrong answers
foreach ($_POST as $questionId => $selectedOption) {
  
 if (substr($questionId, 0, 6) === 'answer') {
   
    //printing
    // echo $questionId;
    // echo $selectedOption;
   
    //
    $questionId = intval(substr($questionId, 6));
    $selectedOption = intval($selectedOption);
        
    // echo $selectedOption;
    $sql = "SELECT correct_answer FROM questions WHERE id = $questionId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if ($selectedOption === intval($row['correct_answer'])) {
        $score++;
        $correctAnswers++;
      } else {
        $wrongAnswers++;
      }
      // $totalQuestions++;
    }
    // echo ($score/intval($total['COUNT(question)']+1))*100;
  }
}
$percentage=($score/intval($total['COUNT(question)']+1))*100;
//Check if the user is already present in the leaderboard
$qry=mysqli_query($conn,"SELECT * FROM leaderboard WHERE name='$name' ");
$rowCheck=mysqli_num_rows($qry);
    if ($rowCheck>0) { // if data exist update the data
        $qry=mysqli_query($conn,"UPDATE leaderboard SET score='$score',percentage=$percentage WHERE name='$name'");  
    }
    else{ // insert the data if data is not exist
        $qry=mysqli_query($conn,"INSERT INTO leaderboard (name, score, percentage) VALUES('$name', $score, $percentage)");
    }

//

// Store the user's score in the database
// $sql = "INSERT INTO leaderboard (name, score) VALUES ('$name', $score)";
// $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quiz Web Application</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="resultStyle.css">
</head>

<body>
<div class="topnav" id="myTopnav">
     
<div class="upper">
        <a>Login</a>
        <a>Quiz</a>
        <a class="active">Result</a>
        </div>
        <div class="lower">
          <a href="profile.php"><?php echo $name; ?></a>
            <a href="logout.php">Logout</a>
        </div>
        
       
      </div>
  <div class="container">
    <h1>Quiz Results</h1>
    <h2 class="mb-4">Congratulations, <?php echo $name; ?>!</h2>
    <div class="score">
      <div class="score-item">
        <p class="score-item-label">Your score:</p>
        <h2 class="score-item-value"><?php echo $score; ?>/<?php echo $total['COUNT(question)']+1; ?></h2>
      </div>
      <div class="score-item">
        <p class="score-item-label">Correct Answers:</p>
        <h2 class="score-item-value"><?php echo $correctAnswers; ?></h2>
      </div>
      <div class="score-item">
        <p class="score-item-label">Wrong Answers:</p>
        <h2 class="score-item-value"><?php echo $wrongAnswers; ?></h2>
      </div>
    </div>

    <h2 class="mt-5">Leaderboard</h2>
    <div class="leaderboard">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Score</th>
          </tr>
        </thead>
        <tbody>
          <?php
         
          //connecting to db
          include "dbconnect.php";


          // Fetch top 10 performers from the database
          $sql = "SELECT name, score FROM leaderboard ORDER BY score DESC LIMIT 10";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<tr><td>{$row['name']}</td><td>{$row['score']}</td></tr>";
            }
          } else {
            echo "<tr><td colspan='2'>No data available</td></tr>";
          }

          $conn->close();
          ?>
        </tbody>
      </table>
      <div class="retake-button">
      <a href="quiz.php"><button>Retake test</button></a>
      <!-- <a href="index.html"><button>Go to homepage</button></a> -->
    </div>
    </div>
  </div>
  <footer>
        <div class="footer-content">
            <p>Project:Quiz web application</p>
            <br>
          <p>Authors:Saptarshi Kanjilal,Nilabhro Sinha,Arpan Das,Bishal Saha and Mayukh Halder</p>
          
        </div>
      </footer>
</body>

</html>