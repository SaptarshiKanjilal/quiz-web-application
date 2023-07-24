<?php

session_start();
session_unset();
session_destroy();
echo "<SCRIPT>
alert('Logged out successfully')
window.location.replace('login.php');
</SCRIPT>";  

?>