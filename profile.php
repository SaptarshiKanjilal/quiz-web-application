<?php

 session_start();
 $_SESSION['profile']='accessed';
 $_SESSION['profile']='not';
 $_SESSION['profile']='not';

  if(!empty($_SESSION['name'])){

    $percentage=0;
    $date=null;
    $name=$_SESSION['name'];
    include "dbconnect.php";
    $sql="SELECT * FROM users where username='$name'";
    $sql2="SELECT * FROM leaderboard where name='$name'";
    $result = $conn->query($sql);
    $result2=$conn->query($sql2);

    if ($result->num_rows == 1) {
        $row = $result -> fetch_assoc();
        $date=$row['joined'];
    }
    if($result2->num_rows == 1){
        $row = $result2 -> fetch_assoc();
        
        // $percentage=intval($row['$percentage']);
        $percentage=intval($row['percentage']);
    }
    else{
        $percentage=0;
    }

  }
  else{
    header('location:login.php');
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quiz Web Application</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="profileStyle.css">
</head>

<style>
   @property --progress-value {
  syntax: "<integer>";
  initial-value: 0;
  inherits: false;
}

@keyframes progress {
 to { --progress-value: <?php echo $percentage?>; }
}

.progress-bar {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: auto;
   margin-bottom: 10px;
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: 
    radial-gradient(closest-side, white 79%, transparent 80% 100%),
    conic-gradient(#04AA6D calc(var(--progress-value) * 1%), rgba(76, 175, 80, 0.3) 0);
  animation: progress 2s 1 forwards;
  position: relative;
}

.progress-bar::before {
    position:absolute;
  counter-reset: percentage var(--progress-value);
  content: counter(percentage) '%';
  color: black;
  animation: progress 2s 1 forwards;
}

</style>


<body>
<div class="topnav" id="myTopnav">
     
<div class="upper">
        <a>Login</a>
        <a>Quiz</a>
        <a>Result</a>
        </div>
        <div class="lower">
          <a href="profile.php"><?php echo $name?></a>
            <a href="logout.php">Logout</a>
        </div>
        
       
      </div>
  <div class="container">
    <h1><?php echo $name?></h1>
    <div class="info">
       <div class="performance" style="border-bottom: 1px solid grey;margin-bottom: 30px;">
      <h2 class="mb-4">Your current performance</h2>
    <div class="progress-bar">
        <progress value="75" min="0" max="100" style="visibility:hidden;height:10;width:10;"><?php echo $percentage?>%</progress>
      </div>
         
      </div>
      
    <div class="account-created">
      <h2 class="mb-4">Account created</h2>
        <h3><?php echo $date?></h3>
      </div>
      

      </div>
          <div class="retake-button">
      <a href="quiz.php"><button>Attemp quiz</button></a>
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