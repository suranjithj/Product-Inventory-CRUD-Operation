<?php
session_start();

if(isset($_SESSION['email'])) {
    if ($_SESSION['email'] == 'admin@resfeber.com') {
        header("Location: ../Dashboard/dashboard.php");
        exit();
    } else {
        // header("Location: ../Tr-Menu/dashboard.php");
        exit();
    }
}

include ('../config.php');

$error_message = '';

if(isset($_POST['lgnsubmit'])){
    
    $email = $_POST['email'];

    if($email == $_POST['email']){
        $password = $_POST['password']; 
        
        $query = "SELECT * FROM user WHERE email='$email' and password='$password' LIMIT 5";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_array($result);
            $_SESSION['email'] = $email;
            echo '<script>alert("Login Successful"); window.location = "../Dashboard/dashboard.php";</script>'; 
            
            exit();

        }
        else{
            header('Location: loginform.php?error=Incorrect Password. Try again!');
            exit();
        }
    }else{
        
    }
}

?>