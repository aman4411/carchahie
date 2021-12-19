<?php  

    include '../models/user.php';
    require_once '../includes/dbconfig.php';
    session_start();

    if((isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'customer')){
        header('Location: /index.php');
    }else if((isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
        header('Location: /agency/agency-dashboard.php');
    }
    
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

    $user = new User();

    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->userRole = $_POST['userRole'];

    if(strlen($user->password) < 6){
        echo json_encode('Password should be of atleast 6 characters');
        exit;
    }

    $conn = getDBConnection();

    if($conn->connect_error){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo json_encode('Some Error Occured. Please try again later.');
    }else{
        $dbUser = getExistingUser($conn,$user->email,$user->userRole);
        if($dbUser){
            echo json_encode('An account already exists with this email id');
            exit;
        }
        $insertQuery = "INSERT INTO users (name, email, password,userRole) VALUES (?,?,?,?)";
        $stmt= $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $user->name, $user->email, $user->password, $user->userRole);
        if($result = $stmt->execute()){
            $dbUser = getExistingUser($conn,$user->email,$user->userRole);
            $_SESSION['userId'] = $dbUser['userId'];
            $_SESSION['email'] = $dbUser['email'];
            $_SESSION['userRole'] = $dbUser['userRole'];
            echo json_encode('Success');
        }else{
            echo json_encode($stmt->error);
        }
    }
    
    closeDbConnection($conn);
    exit;
   
    function getExistingUser($conn,$email,$userRole){
        $selectQuery = "SELECT * from users where email=? and userRole=?";
        $stmt = $conn->prepare($selectQuery); 
        $stmt->bind_param("ss", $email,$userRole);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $dbUser = $result->fetch_assoc();
        return $dbUser;
    }
?>
