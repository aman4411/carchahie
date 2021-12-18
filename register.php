<?php  

    header('Content-Type : application/json');
    //Server Side Validation 

    if(!isset($_POST['name']) || empty($_POST['name'])){
        echo json_encode('Name is required');
        exit;
    } 
    if(!isset($_POST['email']) || empty($_POST['email'])){
        echo json_encode('Email is required');
        exit;
    }
    if(!isset($_POST['password']) || empty($_POST['password'])){
        echo json_encode('Password is required');
        exit;
    }
    if(!isset($_POST['userRole']) || empty($_POST['userRole'])){
        echo json_encode('User Role is required');
        exit;
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userRole = $_POST['userRole'];

    if(strlen($password) < 6){
        echo json_encode('Password should be of atleast 6 characters');
        exit;
    }
    
    echo json_encode('Account Created Successfully. You can login now.');
    exit;
   
?>
