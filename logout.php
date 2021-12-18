<?php 
  session_start();
  unset($_SESSION['email']);
  unset($_SESSION['userRole']);
  header('location: /login.php');
?>