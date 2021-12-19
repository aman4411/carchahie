validateCustomerRegisterForm = (e) => {
    e.preventDefault();
    let loadingButton = document.getElementById('customer-register-loading-button');
    let registerButton = document.getElementById('customer-register-button');
    let form = document.getElementById('customer-register-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('customer-register-form-error');
    validateRegistration(formData,errorMsg,"customer",loadingButton,registerButton);
}

validateAgencyRegisterForm = (e) => {
    e.preventDefault();
    let loadingButton = document.getElementById('agency-register-loading-button');
    let registerButton = document.getElementById('agency-register-button');
    let form = document.getElementById('agency-register-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('agency-register-form-error');
    return validateRegistration(formData,errorMsg,"agency",loadingButton,registerButton);
}

validateRegistration = (formData,errorMsg,userRole,loadingButton,registerButton) => {
    let name = formData.get('name');
    let email = formData.get('email');
    let password = formData.get('password');
    let confirmPassword = formData.get('confirmPassword');

    errorMsg.style.display = 'none';
    if(name == null || name == ''){
        errorMsg.innerHTML = '*Name is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(email == null || email == ''){
        errorMsg.innerHTML = '*Email is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(password == null || password == ''){
        errorMsg.innerHTML = '*Password is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(confirmPassword == null || confirmPassword == ''){
        errorMsg.innerHTML = '*Confirmation Password is required';
        errorMsg.style.display = 'block';
        return;
    }
    //validate email
    let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    if(!regex.test(email)){
        errorMsg.innerHTML = '*Kindly enter a valid email';
        errorMsg.style.display = 'block';
        return;
    }
    //validate password length
    if(password.length<6){
        errorMsg.innerHTML = '*Password should be of atleast 6 characters';
        errorMsg.style.display = 'block';
        return;
    }
    //validate password &confirmPassword are equal
    if(password !== confirmPassword){
        errorMsg.innerHTML = '*Password & Confirmation Password does not match';
        errorMsg.style.display = 'block';
        return;
    }

    toggleButtonVisibilty(registerButton,loadingButton);

    $.ajax({
        url: "../handlers/registerHandler.php",
        type: "POST",
        dataType: "json",
        data: {
            name: name,
            email:email,
            password:password,
            userRole:userRole
        },
        success: function(response){
            toggleButtonVisibilty(loadingButton,registerButton);
            if(response == 'Success'){
                document.getElementById('customer-register-form').reset();
                document.location.href = userRole == 'agency' ? '../agency/agency-dashboard.php' : '../index.php';
            }else{
                showModal(response);
            }
        },
        error: function(xhr,error){
            toggleButtonVisibilty(loadingButton,registerButton);
            if(error == 'parsererror'){
                document.getElementById('customer-register-form').reset();
                document.location.href = userRole == 'agency' ? '../agency/agency-dashboard.php' : '../index.php';
            }else{
                showModal(xhr.responseText);
            } 
        }
     })
    return true;
}

validateCustomerLoginForm = (e) => {
    e.preventDefault();
    let loadingButton = document.getElementById('customer-login-loading-button');
    let loginButton = document.getElementById('customer-login-button');
    let form = document.getElementById('customer-login-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('customer-login-form-error');
    validateLogin(formData,errorMsg,"customer",loadingButton,loginButton);
}

validateAgencyLoginForm = (e) => {
    e.preventDefault();
    let loadingButton = document.getElementById('agency-login-loading-button');
    let loginButton = document.getElementById('agency-login-button');
    let form = document.getElementById('agency-login-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('agency-login-form-error');
    return validateLogin(formData,errorMsg,"agency",loadingButton,loginButton);
}

validateLogin = (formData,errorMsg,userRole,loadingButton,loginButton) => {
    let email = formData.get('email');
    let password = formData.get('password');

    errorMsg.style.display = 'none';

    if(email == null || email == ''){
        errorMsg.innerHTML = '*Email is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(password == null || password == ''){
        errorMsg.innerHTML = '*Password is required';
        errorMsg.style.display = 'block';
        return;
    }
    //validate email
    let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    if(!regex.test(email)){
        errorMsg.innerHTML = '*Kindly enter a valid email';
        errorMsg.style.display = 'block';
        return;
    }
    //validate password length
    if(password.length<6){
        errorMsg.innerHTML = '*Password should be of atleast 6 characters';
        errorMsg.style.display = 'block';
        return;
    }

    toggleButtonVisibilty(loginButton,loadingButton);

    $.ajax({
        url: "../handlers/loginHandler.php",
        type: "POST",
        dataType: "json",
        data: {
            email:email,
            password:password,
            userRole:userRole
        },
        success: function(response){
            toggleButtonVisibilty(loadingButton,loginButton);
            if(response == 'Success'){
                window.location.href = userRole == 'customer' ? '../index.php' : '../agency/agency-dashboard.php';
            }else{
                showModal(response);
            }     
        },
        error: function(xhr,error){
           toggleButtonVisibilty(loadingButton,loginButton);
           showModal(xhr.responseText);
        }
     })
    return true;
}

showModal = (message) => {
    var myModal = new bootstrap.Modal(document.getElementById('modal'));
    var crmModal = document.getElementById('modal')
    crmModal.addEventListener('show.bs.modal', function (event) {
        var modalBody = crmModal.querySelector('.modal-body p');
        modalBody.textContent = message;
    });
    myModal.show();
}

toggleButtonVisibilty = (visibleButton,invisibleButton) =>{
    visibleButton.style.display = 'none';
    invisibleButton.style.display = 'block';
}