<?php

session_start();
if(!empty($_SESSION['name'])){

  if($_SESSION['quiz']=='accessed' && $_SESSION['result']=='not' ){
    header('location:quiz.php');
    
  }
  else if($_SESSION['result']=='accessed' && $_SESSION['quiz']=='not'){
    header('location:result.php');
  }
  
   $use=$_SESSION['quiz'];
   $use2=$_SESSION['result'];
  

   
   echo $use,$use2;
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Quiz Web Application</title>
    <link rel="stylesheet" type="text/css" href="loginStyle.css">
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a class="active">Login</a>
        <a>Quiz</a>
        <a>Result</a>
        
       
      </div>
    <div class="container">
        <h1>Welcome to the Quiz!</h1>
        <form name="frmUser" method="post" action="quiz.php">
            
            <div class="message text-center"></div>
        
            <h1 class="text-center">Login</h1>
            
            <div>
                <div class="row">
                    <label> Username </label> <input type="text" name="username"
                        class="full-width"  required placeholder="username">
                </div>
                <div class="row">
                    <label>Password</label> <input type="password"
                        name="password" class="full-width" required placeholder="password">
                </div>
                <div class="row">
                    <!-- <input type="submit" name="submit" value="Submit"
                        class="full-width "> -->
                        <button type="submit" class="btn btn-primary mt-3">Login</button>
                        
                </div>
                <h4>Don't have an account?<a href="signup.php">Signup</a></h4>
            </div>
        </form>
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
