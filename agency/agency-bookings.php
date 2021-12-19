<?php $currentPage="Bookings";
include '../includes/header.php';

if(!(isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
  header('Location: ../login.php');
}
?>

<?php echo 'Agency Bookings'; ?>

<?php include '../includes/footer.php'; ?>