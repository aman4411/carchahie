<?php $currentPage="Dashboard";
include '../includes/header.php';

if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'customer')){
  header('Location: ../login.php');
}
?>

<?php echo 'Customer Dashboard'; ?>

<?php include '../includes/footer.php'; ?>