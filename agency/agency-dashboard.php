<?php  $currentPage="Dashboard";
include '../includes/header.php'; 

if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
  header('Location: ../login.php');
}

?>

<?php 


?>

<?php include '../includes/footer.php'; ?>