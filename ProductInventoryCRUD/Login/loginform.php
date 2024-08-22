<?php 

error_reporting(0);
session_start(); 

// Check if the user is already logged in
if(isset($_SESSION['email'])) {
    // Redirect to respective dashboard based on user type
    if ($_SESSION['email'] == 'admin@resfeber.com') {
        header("Location: ../Dashboard/dashboard.php");
        exit();
    } else {
        // header("Location: ../Tr-Menu/dashboard.php");
        exit();
    }
}

$emailErr = $passwordErr = "";

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgb(255, 255, 255);
            background-size: cover;
            background-position: center;
        }

        .div1{
            position: relative;
            width: 500px;
            height: 590px;
            background: hsla(214, 57%, 51%, 0.179);
            border: 2px solid hsla(214, 57%, 51%, 0.214);
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: #3b79c9;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            transition: transform .4s ease ,height .2s ease;
        }

        .div1.active-window{
            transform: scale(1);
        }

        .div1.active{
            height: 870px;
        }

        .div1 .form{
            width: 100%;
            padding: 40px;
            
        }

        .div1 .close-icon{
            position: absolute;
            top: 3px;
            right: 3px;
            width: 35px;
            height: 35px;
            font-size: 35px;
            color: #3b79c9;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom-left-radius: 20px;
        }

        .form h2{
            font-size: 35px;
            color: #3b79c9;
            text-align: center;
            
        }

        .input-1 {
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #3b79c9;
            margin: 60px 0;
        }

        .input-2{
            position: relative;
            width: 100%;
            height: 50px;
            border-bottom: 2px solid #3b79c9;
            margin: 30px 0;
        }

        .input-1 label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #3b79c9;
            font-weight: 500;
            pointer-events: none;
            transition: .4s;
        }

        .input-2 label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #3b79c9;
            font-weight: 500;
            pointer-events: none;
            transition: .4s;
        }

        .input-1 input:focus~label, .input-1 input:valid~label{
            top: -5px;
        }

        .input-2 input:focus~label, .input-2 input:valid~label{
            top: -5px;
        }

        .input-1 input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 18px;
            color: #000000;
            font-weight: 500;
            padding: 0 35px 0 5px;
        }

        .input-2 input{
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 18px;
            color: #000000;
            font-weight: 500;
            padding: 0 35px 0 5px;
        }

        .input-1 .icon{
            position: absolute;
            right: 8px;
            font-size: 18px;
            color: #3b79c9;
            line-height: 57px;

        }

        .div2{
            font-size: 15px;
            color: black;
            font-weight: 500;
            margin: -15px 0 15px;
            display: flex;
            justify-content: space-between;
        }

        .div2 label input{
            accent-color: #3b79c9;
            margin-right: 3px;
        }

        .div2 a{
            color: black;
            text-decoration: none;
            font-weight: 550;
        }

        .div2 a:hover{
            text-decoration: underline;
            color: #3b79c9;
        }

        .btn-login{
            width: 100%;
            height: 35px;
            background: #3b79c9;
            border: none;
            outline: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 22px;
            font-weight: 500;
            color: white;
            
        }

        .btn-login:hover{
            background-color: #01213c;
        }

        .div1 .login select{
            font-size: 18px;
            background: hsla(214, 57%, 51%, 0.4);
            float: right;
            color: rgb(0, 0, 0);
            align-items: end;
            justify-content: center;
            padding-right: 0;
            border-radius: 15px;
            padding-left: 5px;
            padding-right: 5px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <!-- login -->
    <div class="div1">
        <a href="../index.php" class="close-icon"><span class="close-icon"><ion-icon name="close" class="close-icon"></ion-icon></span></a>
        <div class="form login">
            <h2>Login</h2>
            <center><p style="color: red; margin-top: 25px;"><?php echo  $_GET['error'] ?></p></center>
            <form action="login.php" method="post">
                <div class="input-1">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" id="email" name="email" required>
                    <label for="email">Email</label> 
                </div>
                <div class="input-1">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" id="password" name="password" required>
                    <label for="password">Password</label> 
                </div>
                <div class="div2">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="passwordreset.php">Forgot Password?</a>
                </div>
                <button type="submit" name="lgnsubmit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

