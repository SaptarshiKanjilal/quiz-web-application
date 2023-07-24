<?php
session_start();

$_SESSION['quiz']='accessed';
$_SESSION['result']='not';
               

if ($_SERVER['REQUEST_METHOD'] === 'POST'|| !empty($_SESSION['name'])) {

    //connecting to db
   include "dbconnect.php";

    error_reporting(E_ERROR | E_PARSE);
    if(str_contains($_SERVER['HTTP_REFERER'],'login')){
          
                // echo $_SERVER['HTTP_REFERER'];
            $username=$_POST['username'];    
            $password=$_POST['password'];
            // echo $username,$password;
            $query="SELECT * FROM users where username='$username' and password=PASSWORD('$password') ";
            $res=mysqli_query($conn,$query);
            $conn->close();
    
            if(mysqli_num_rows($res)==1){
                $_SESSION['name'] = $_POST['username'];
                $_SESSION['quiz']='accessed';
                $_SESSION['result']='not';
                echo '<script type="text/javascript">
    
                window.onload = function () { alert("Logged in successfully"); }
    
                 </script>';
            }else{
                echo "<SCRIPT> 
                   alert('User not resigtered')
                window.location.replace('login.php');
               </SCRIPT>";  
            }
        }
        if(str_contains($_SERVER['HTTP_REFERER'],'signup')){
    
                $username=$_POST['username'];    
                $password=$_POST['password'];
                $sql="SELECT * FROM users where username='$username'";
                $result=mysqli_query($conn,$sql);
                if(mysqli_num_rows($result)==1){
                    echo "<SCRIPT> 
                    alert('The username is already in use')
                 window.location.replace('signup.php');
                </SCRIPT>";
                }
                else{
                    $query="INSERT INTO users (username, password) VALUES
                    ('$username',PASSWORD('$password'))";
                    $res=mysqli_query($conn,$query);
                    $conn->close();
                      $_SESSION['name'] = $_POST['username'];
                      $_SESSION['quiz']='accessed';
                      $_SESSION['result']='not';
                      echo '<script type="text/javascript">
           
                      window.onload = function () { alert("Account created successfully"); }
           
                       </script>';
                }
            
                
        }
    
    
    // if (isset($_POST['name']) && !empty($_POST['name'])) {
    //     $_SESSION['name'] = $_POST['name'];
    // } 
    // else {
    //     header("Location:login.php");
    //     exit;
    // }
    
    

} else {
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Quiz Web Application</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="quizStyle.css">
</head>

<body>
<div class="topnav" id="myTopnav">
     
     <div class="upper">
             <a>Login</a>
             <a class="active">Quiz</a>
             <a>Result</a>
             </div>
             <div class="lower">
               <a href="profile.php"><?php echo $_SESSION['name']; ?></a>
                 <a href="logout.php">Logout</a>
             </div>
             
            
           </div>
    <div class="container">
        <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
        <div id="timer" style="text-align: right; font-weight: bold;"></div>

        <form id="quizForm" action="result.php" method="POST">
            <h2>Quiz Questions</h2>

            <?php
            //connecting to db
            include "dbconnect.php";

            $sql = "SELECT * FROM questions";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $options = json_decode($row['options'], true);
                    echo "<p><strong>{$row['id']}.{$row['question']}</strong></p>";
                    echo "<ul class='list-group'>";
                    foreach ($options as $optionKey => $optionValue) {
                        echo "<li class='list-group-item'><input class='form-check-input me-1' type='radio' name='answer{$row['id']}' value='{$optionKey}' id='option{$row['id']}-{$optionKey}'>
                        <label id='op' for='option{$row['id']}-{$optionKey}'>{$optionValue}</label></li>";
                    }
                    echo "</ul>";
                }
            }

            $conn->close();
            ?>

            <button type="submit" class="btn btn-primary mt-3" >Submit</button>
        </form>
    </div>
    
    <script>
        let qCount=0;
        // JavaScript code to add selected option class
        const radioButtons = document.querySelectorAll('input[type="radio"]');
        radioButtons.forEach(radio => {
            radio.addEventListener('click', function() {
               
                const parent = this.parentNode;
                const listItems = parent.parentNode.children;
                for (let i = 0; i < listItems.length; i++) {
                    listItems[i].classList.remove('selected-option');
                }
                parent.classList.add('selected-option');
                qCount++;
            });

            
        });
       
        // JavaScript code for timer and form submission

        // Set the timer duration in seconds (15 minutes = 900 seconds)
        const timerDuration = 900;

        // Get the timer element
        const timerElement = document.getElementById('timer');

        // Get the form element
        const quizForm = document.getElementById('quizForm');

        // Initialize the timer
        let count = timerDuration;
        let minutes = Math.floor(count / 60);
        let seconds = count % 60;
        timerElement.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

        let timer = setInterval(() => {
            count--;
            minutes = Math.floor(count / 60);
            seconds = count % 60;
            if (count <= 0) {
                clearInterval(timer);
                timerElement.textContent = 'Time up!';
                quizForm.submit();
            } else {
                timerElement.textContent = `Time remaining: ${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }
        }, 1000);

     //  To check if user has attempted atleast one question
        let sub=document.querySelector('button[type="submit"]');
        sub.addEventListener('click',(e)=>{
            e.preventDefault();
         if(qCount<1)
           alert('Attempt atleast one question');
          else
          quizForm.submit();
        })
    </script>
</body>

</html>
