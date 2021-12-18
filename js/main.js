validateCustomerRegisterForm = () => {
    let form = document.getElementById('customerRegisterForm');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('customer-register-form-error');
    return validateRegistration(formData,errorMsg);
}

validateAgencyRegisterForm = () => {
    let form = document.getElementById('agencyRegisterForm');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('agency-register-form-error');
    return validateRegistration(formData,errorMsg);
}

validateRegistration = (formData,errorMsg) => {
    let name = formData.get('name');
    let email = formData.get('email');
    let password = formData.get('password');
    let confirmPassword = formData.get('confirmPassword');

    errorMsg.style.display = 'none';

    if(name == null || name == ''){
        errorMsg.innerHTML = '*Name is required';
        errorMsg.style.display = 'block';
        return false;
    }
    if(email == null || email == ''){
        errorMsg.innerHTML = '*Email is required';
        errorMsg.style.display = 'block';
        return false;
    }
    if(password == null || password == ''){
        errorMsg.innerHTML = '*Password is required';
        errorMsg.style.display = 'block';
        return false;
    }
    if(confirmPassword == null || confirmPassword == ''){
        errorMsg.innerHTML = '*Confirmation Password is required';
        errorMsg.style.display = 'block';
        return false;
    }
    //validate email
    let regex = new RegExp('[a-z0-9]+@[a-z]+\.[a-z]{2,3}');
    if(!regex.test(email)){
        errorMsg.innerHTML = '*Kindly enter a valid email';
        errorMsg.style.display = 'block';
        return false;
    }
    //validate password length
    if(password.length<6){
        errorMsg.innerHTML = '*Password should be of atleast 6 characters';
        errorMsg.style.display = 'block';
        return false;
    }
    //validate password &confirmPassword are equal
    if(password !== confirmPassword){
        errorMsg.innerHTML = '*Password & Confirmation Password does not match';
        errorMsg.style.display = 'block';
        return false;
    }
    return true;
}