<?php  $currentPage="Dashboard";
include '../includes/header.php'; 

session_start();
if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
  header('Location: ../login.php');
}

?>

<?php echo 'Agency Dashboard'; ?>

<?php include '../includes/footer.php'; ?>