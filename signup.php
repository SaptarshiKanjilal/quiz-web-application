<?php

session_start();
if(!empty($_SESSION['name'])){

  if($_SESSION['quiz']=='accessed' && $_SESSION['result']=='not'){
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
    <link rel="stylesheet" type="text/css" href="signupStyle.css">
</head>
<body>
    <div class="topnav" id="myTopnav">
  
        <a class="active">Signup</a>
        <a>Quiz</a>
        <a>Result</a>
        
         
    </div>
    <div class="container">
        <!-- <h1>Welcome to the Quiz!</h1> -->
        <form class="signUpform" name="frmUser" method="post" action="quiz.php">
            
            <div class="message text-center"></div>
        
            <h1 class="text-center">Signup</h1>
            
            <div>
                <div class="row">
                    <label> Username </label> <input type="text" name="username"
                        class="full-width username"  required placeholder="username">
                    <label class="errUser" style="color: red;">Username should be more than 6 characters</label>    
                </div>
                <div class="row">
                    <label>Password</label> <input type="password"
                        name="password" class="full-width password" required placeholder="password">
                    <label class="errPassword" style="color: red;">Password should be more than 6 characters and have atleast 1 special character</label>    
    
                </div>
                <div class="row">
                    <label>Confirm Password</label> <input type="password"
                        name="cpassword" class="full-width cpassword" required placeholder="password">
                        <label class="errCpassword" style="color: red;">Does not match the given password</label>    
    
                </div>
                <div class="row">
                    <!-- <input type="submit" name="submit" value="Submit"
                        class="full-width "> -->
                        <button type="submit" class="btn btn-primary mt-3">Create account</button>
                        
                </div>
               
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

      <script>
        let button=document.querySelector('.btn-primary');
        let username=document.querySelector('.username');
        let label1=document.querySelector('.errUser');
        let label2=document.querySelector('.errPassword');
        let label3=document.querySelector('.errCpassword');
        let password=document.querySelector('.password');
        let cPassword=document.querySelector('.cpassword');
        let form=document.querySelector('.signUpform');
        // let format = /^[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]*$/;

        function containsSpecialChars(str) {
    const specialChars =
        /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return specialChars.test(str);
}

        //Form validation 
        button.addEventListener('click',(e)=>{
              e.preventDefault();

              //For username
              if(username.value.length<6){
                label1.style.visibility='visible';
                
              }
              else{
                label1.style.visibility='hidden';
              }

              //FOr password
                if(containsSpecialChars(password.value)===true && password.value.length>6){
                    label2.style.visibility='hidden';

                }else{
                    label2.style.visibility='visible';


               //For confirm password 
                }
               if(cPassword.value!==password.value){
                label3.style.visibility='visible';

               } 
               else{
                                    label3.style.visibility='hidden';

               }
              if(label1.style.visibility==='hidden' && label2.style.visibility==='hidden' && label3.style.visibility==='hidden'){
                form.submit();
              }
        })
      </script>
</body>
</html>
