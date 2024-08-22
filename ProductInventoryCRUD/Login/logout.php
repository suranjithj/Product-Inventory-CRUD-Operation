<?php
    session_start();

    $_SESSION = array(); 
    session_destroy(); 

    $_SESSION['message'] = "Logged Out Successfully";
    echo '<script>alert("Logout Successful"); window.location = "../index.php";</script>'; 
    exit(0);
?>