<?php  

    if((isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'customer')){
        header('Location: /customer/customer-dashboard.php');
    }else if((isset($_SESSION['userRole']) && $_SESSION['userRole'] == 'agency')){
        header('Location: /agency/agency-dashboard.php');
    }

    require_once './includes/dbconfig.php';
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

    $conn = getDBConnection();

    if($conn->connect_error){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo json_encode('Some Error Occured. Please try again later.');
    }else{
        if(checkIfUserExists($conn,$email)){
            echo json_encode('An account already exists with this email id');
            exit;
        }
        $insertQuery = "INSERT INTO users (name, email, password,userRole) VALUES (?,?,?,?)";
        $stmt= $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $name, $email, $password, $userRole);
        if($result = $stmt->execute()){
            echo json_encode('Account Created Successfully. You can login now.');
        }else{
            echo json_encode($stmt->error);
        }
    }
    
    closeDbConnection($conn);
    exit;
   
    function checkIfUserExists($conn,$email){
        $selectQuery = "SELECT * from users where email=?";
        $stmt = $conn->prepare($selectQuery); 
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $user = $result->fetch_assoc();
        if($user){
            return true;
        }else{
            return false;
        }
    }
?>
