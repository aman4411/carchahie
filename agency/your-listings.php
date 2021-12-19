<?php $currentPage="Your Listings";
include '../includes/header.php';

if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
  header('Location: ../login.php');
}
?>

<?php echo 'Your Listed Cars will be shown here'; ?>

<?php include '../includes/footer.php'; ?>