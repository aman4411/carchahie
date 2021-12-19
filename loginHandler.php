<?php  

    require_once './includes/dbconfig.php';
    include './models/user.php';
    session_start();

    if(isset($_SESSION['userRole'])){
        header('Location: ./index.php');
    }

    //Server Side Validation 

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
        $selectQuery = "SELECT * from users where email=? and userRole=?";
        $stmt = $conn->prepare($selectQuery); 
        $stmt->bind_param("ss", $user->email,$user->userRole);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $dbUser = $result->fetch_assoc();
        if($dbUser){
            $dbPassword = $dbUser['password'];
            $dbRole = $dbUser['userRole'];   
            if($dbPassword === $user->password && $dbRole === $user->userRole){
                $_SESSION['email'] = $user->email;
                $_SESSION['userRole'] = $user->userRole;
                echo json_encode('Success');
            }else{
                echo json_encode('You have entered wrong password');
            }
        }else{
            echo json_encode('No Account exists with this email id. Kindly create a new account.');
        }
    }
    
    closeDbConnection($conn);
    exit;
   
?>
