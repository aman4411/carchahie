<?php $currentPage="login";
include './includes/header.php'; ?>

<section>
    <div class="container mt-4">
        <ul class="nav nav-pills nav-fill" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tab-1" data-bs-toggle="tab" data-bs-target="#customer-login-tab" type="button" role="tab" aria-controls="customer-login-tab" aria-selected="true">Login As Customer</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab-2" data-bs-toggle="tab" data-bs-target="#agency-login-tab" type="button" role="tab" aria-controls="agency-login-tab" aria-selected="false">Login As Car Agency</button>
            </li>
        </ul>

        <div class="row tab-content mt-3">
            <div class="tab-pane fade show active" id="customer-login-tab" role="tabpanel" aria-labelledby="tab-1">
                <form class="col-12 col-md-8 col-lg-8 col-xl-6" id="customer-register-form" onsubmit="validateCustomerRegisterForm(event)">
                    <div class="row">
                        <div class="col text-center mt-3">
                            <h3>Customer Login</h3>
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
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <span class="text-danger" id="customer-register-form-error">*Error</span>
                            <button class="btn btn-primary mt-3" type="submit" id="customer-register-button">Login</button>
                            <button id="customer-register-loading-button" class="btn btn-primary mt-3" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade show" id="agency-login-tab" role="tabpanel" aria-labelledby="tab-1">
                <form class="col-12 col-md-8 col-lg-8 col-xl-6" id="agency-register-form" onsubmit="validateAgencyRegisterForm(event)">
                    <div class="row">
                        <div class="col text-center mt-3">
                            <h3>Agency Login</h3>
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
                    </div>
                    <div class="row justify-content-start mt-4">
                        <div class="col">
                            <span class="text-danger" id="agency-register-form-error">*Error</span>
                            <button class="btn btn-primary mt-3" id="agency-register-button">Login</button>
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