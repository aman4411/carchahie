<?php
session_start();
$urls = array(
    'Home' => '/index'
);
if (isset($_SESSION['email'])) {
    if ($_SESSION['userRole'] == 'customer') {
        $urls['Bookings'] = '/customer/customer-bookings';
    } else if ($_SESSION['userRole'] == 'agency') {
        $urls['Add Car'] = '/agency/agency-dashboard';
        $urls['Your Listings'] = '/agency/your-listings';
        $urls['Bookings'] = '/agency/agency-bookings';
    }
    $urls['Logout'] = '/logout';
} else {
    $urls['Register'] = '/register';
    $urls['Login'] = '/login';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $currentPage ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>


    <nav class="navbar navbar-expand-custom navbar-mainbg">
        <a class="navbar-brand navbar-logo" href="/"><i class="fas fa-car-side"></i>Car Chahie</a>
        <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <div class="hori-selector">
                    <div class="left"></div>
                    <div class="right"></div>
                </div>

                <?php foreach ($urls as $name => $url): ?>
                    <li class="<?= ($currentPage === $name) ? 'nav-item active' : 'nav-item' ?>">
                        <a href="<?= $url . '.php' ?>"><?= $name ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>

    <!-- Alert Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="modal-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal  -->
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModal" aria-hidden="true" id="confirm-modal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                </div>
                <div class="modal-body">
                    <p>Confirmation Message</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" id="modal-btn-yes">Yes</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
                </div>
            </div>
        </div>
    </div>