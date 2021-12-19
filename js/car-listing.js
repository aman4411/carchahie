validateAddCarForm = (e,userId) => {
    e.preventDefault();
    let loadingButton = document.getElementById('add-car-loading-button');
    let addCarButton = document.getElementById('add-car-button');
    let form = document.getElementById('add-car-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('add-car-form-error');
    validateAddCar(formData,errorMsg,userId,loadingButton,addCarButton);
}

validateAddCar = (formData,errorMsg,userId,loadingButton,addCarButton) => {
    let model = formData.get('model');
    let number = formData.get('number');
    let capacity = formData.get('capacity');
    let rent = formData.get('rent');

    errorMsg.style.display = 'none';

    if(model == null || model == ''){
        errorMsg.innerHTML = '*Car Model is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(number == null || number == ''){
        errorMsg.innerHTML = '*Vehicle Number is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(capacity == null || capacity == ''){
        errorMsg.innerHTML = '*Car Capacity is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(rent == null || rent == ''){
        errorMsg.innerHTML = '*Rent/Day is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(capacity<=0){
        errorMsg.innerHTML = '*Kindly enter a valid car capacity';
        errorMsg.style.display = 'block';
        return;
    }
    if(rent <= 0){
        errorMsg.innerHTML = '*Kindly enter a valid rent amount';
        errorMsg.style.display = 'block';
        return;
    }

    toggleButtonVisibilty(addCarButton,loadingButton);

    $.ajax({
        url: "../handlers/addCarHandler.php",
        type: "POST",
        dataType: "json",
        data: {
            userId : userId,
            model : model,
            number : number,
            capacity : capacity,
            rent : rent
        },
        success: function(response){
            toggleButtonVisibilty(loadingButton,addCarButton);
            if(response == 'Success'){
                document.getElementById('add-car-form').reset();
                showModal('Your car has been listed successfully');
            }else{
                showModal(response);
            }     
        },
        error: function(xhr,error){
           toggleButtonVisibilty(loadingButton,addCarButton);
           showModal(xhr.responseText);
        }
     })
    return true;
}

validateUpdateCarForm = (e,listingId) => {
    e.preventDefault();
    let loadingButton = document.getElementById('update-car-loading-button');
    let updateCarButton = document.getElementById('update-car-button');
    let form = document.getElementById('update-car-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('update-car-form-error');
    validateUpdateCar(formData,errorMsg,listingId,loadingButton,updateCarButton);
}

validateUpdateCar = (formData,errorMsg,listingId,loadingButton,updateCarButton) => {
    let model = formData.get('model');
    let number = formData.get('number');
    let capacity = formData.get('capacity');
    let rent = formData.get('rent');

    errorMsg.style.display = 'none';

    if(model == null || model == ''){
        errorMsg.innerHTML = '*Car Model is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(number == null || number == ''){
        errorMsg.innerHTML = '*Vehicle Number is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(capacity == null || capacity == ''){
        errorMsg.innerHTML = '*Car Capacity is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(rent == null || rent == ''){
        errorMsg.innerHTML = '*Rent/Day is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(capacity<=0){
        errorMsg.innerHTML = '*Kindly enter a valid car capacity';
        errorMsg.style.display = 'block';
        return;
    }
    if(rent <= 0){
        errorMsg.innerHTML = '*Kindly enter a valid rent amount';
        errorMsg.style.display = 'block';
        return;
    }

    toggleButtonVisibilty(updateCarButton,loadingButton);

    $.ajax({
        url: "../handlers/updateCarHandler.php",
        type: "POST",
        dataType: "json",
        data: {
            listingId : listingId,
            model : model,
            number : number,
            capacity : capacity,
            rent : rent
        },
        success: function(response){
            toggleButtonVisibilty(loadingButton,updateCarButton);
            if(response == 'Success'){
                document.getElementById('update-car-form').reset();
                document.location.href = '../agency/your-listings.php';
            }else{
                showModal(response);
            }     
        },
        error: function(xhr,error){
           toggleButtonVisibilty(loadingButton,updateCarButton);
           showModal(xhr.responseText);
        }
     })
    return true;
}

confirmDeleteCarListing = (listingId) => {
    let deleteCarButton = document.getElementById('delete-car-button');
    let loadingButton = document.getElementById('delete-car-loading-button');
    toggleButtonVisibilty(deleteCarButton,loadingButton);
    $.ajax({
        url: "../handlers/deleteCarHandler.php",
        type: "POST",
        dataType: "json",
        data: {
            listingId : listingId
        },
        success: function(response){
            toggleButtonVisibilty(loadingButton,deleteCarButton);
            if(response == 'Success'){
                document.location.href = '../agency/your-listings.php';
            }else{
                showModal(response);
            }     
        },
        error: function(xhr,error){
           toggleButtonVisibilty(loadingButton,deleteCarButton);
           showModal(xhr.responseText);
        }
     })
}

validateOrderCarForm = (e,userId,listingId,listedBy) =>{
    e.preventDefault();
    let loadingButton = document.getElementById('order-car-loading-button');
    let orderCarButton = document.getElementById('order-car-button');
    let form = document.getElementById('order-car-form');
    const formData = new FormData(form);
    let errorMsg = document.getElementById('order-car-form-error');
    validateCarOrder(formData,errorMsg,userId,listingId,listedBy,loadingButton,orderCarButton);
}

validateCarOrder = (formData,errorMsg,userId,listingId,listedBy,loadingButton,orderCarButton) => {

    let startDate = formData.get('startDate');
    let days = formData.get('days');

    if(startDate == null || startDate == ''){
        errorMsg.innerHTML = '*Booking Date is required';
        errorMsg.style.display = 'block';
        return;
    }
    if(days == null || days == ''){
        errorMsg.innerHTML = '*Kindly choose days for many days you need the car on rent.';
        errorMsg.style.display = 'block';
        return;
    }

    debugger;

    toggleButtonVisibilty(orderCarButton,loadingButton);
    $.ajax({
        url: "../handlers/createBookingHandler.php",
        type: "POST",
        dataType: "json",
        data: {
            customerId : userId,
            agencyId : listedBy,
            listingId : listingId,
            bookingStartDate : startDate,
            bookingDays : days
        },
        success: function(response){
            toggleButtonVisibilty(loadingButton,orderCarButton);
            if(response == 'Success'){
                document.location.href = '../customer/customer-bookings.php';
            }else{
                showModal(response);
            }     
        },
        error: function(xhr,error){
           toggleButtonVisibilty(loadingButton,orderCarButton);
           showModal(xhr.responseText);
        }
     })
}