<?php $currentPage = 'Register';
include './includes/header.php'; 

if((isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'customer')){
    header('Location: /customer/customer-dashboard.php');
}else if((isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
    header('Location: /agency/agency-dashboard.php');
}
?>

<section>
    <div class="container mt-4">
        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#customer-register-tab" type="button" role="tab" aria-controls="customer-register-tab" aria-selected="true">Register As Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#agency-register-tab" type="button" role="tab" aria-controls="agency-register-tab" aria-selected="false">Register As Car Agency</button>
            </li>
        </ul>

        <div class="row tab-content mt-3">
            <div class="tab-pane fade show active" id="customer-register-tab" role="tabpanel" aria-labelledby="tab-1">
                <form class="col-12 col-md-8 col-lg-8 col-xl-6" id="customer-register-form" onsubmit="validateCustomerRegisterForm(event)">
                    <div class="row">
                        <div class="col text-center mt-3">
                            <h3>Customer Register</h3>
                            <p class="text-h3">Register Now and book your first car instantly in 10 minutes. </p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <span class="text-danger" id="customer-register-form-error">*Error</span>
                            <button class="btn btn-primary mt-3" type="submit" id="customer-register-button">Register</button>
                            <button id="customer-register-loading-button" class="btn btn-primary mt-3" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade show" id="agency-register-tab" role="tabpanel" aria-labelledby="tab-1">
                <form class="col-12 col-md-8 col-lg-8 col-xl-6" id="agency-register-form" onsubmit="validateAgencyRegisterForm(event)">
                    <div class="row">
                        <div class="col text-center mt-3">
                            <h3>Car Agency Register</h3>
                            <p class="text-h3">Register & list your cars quickly to get the best price in the market. </p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col mt-4">
                            <input type="text" name="name" class="form-control" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                    </div>
                    <div class="row align-items-center mt-4">
                        <div class="col">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col">
                            <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <span class="text-danger" id="agency-register-form-error">*Error</span>
                            <button class="btn btn-primary mt-3" id="agency-register-button">Register</button>
                            <button id="agency-register-loading-button" class="btn btn-primary mt-3" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include './includes/footer.php'; ?>