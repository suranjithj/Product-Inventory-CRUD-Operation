<!DOCTYPE html>

<?php 

include('config.php');

session_start(); 

if(isset($_SESSION['email'])) {

}

$emailErr = $passwordErr = "";
$filterCategory = isset($_GET['category']) ? $_GET['category'] : '';

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Products Inventory</title>
</head>
<body>
    <header class="header">
        <nav class="navbar">
            <ul class="navbar-list">
                <li>
                <a href="index.php#home" class="navbar-link">Home</a>
                </li>
                <li>
                <a href="#" class="navbar-link">Products</a>
                </li>            
                <li>
                    <?php if (empty($_SESSION['email'])): ?>
                        <a href="Login/loginform.php" class="navbar-link">Login</a>
                    <?php else: ?>
                        <a href="Dashboard/dashboard.php" class="navbar-link">Dashbord</a>
                    <?php endif ?>
                </li>
            </ul> 
        </nav>
    </header>

    <section class="hero" id="home">
        <div class="container">
            <div class="searchbar">
                <form action="seach.php" class="srch-form"> 
                    <input type="text" placeholder="Search..." name="search" class="search-input" id="searchInput"> 
                    <button class="search-btn" id="search-btn" aria-label="Search" type="submit" onclick="search()"> 
                        <ion-icon name="search" style="color: black;"></ion-icon>
                    </button>
                </form>
            </div>                  
    </section>

    <section class="product-cart">
        <div class="table-responsive">
            <div class="table-wrapper">
                <?php
                    $ret=mysqli_query($conn,"select * from product");
                    
                    $cnt = 1;
                    $row_count = mysqli_num_rows($ret);
                    if($row_count > 0) {
                        echo '<div class="products-section">';
                        while ($row = mysqli_fetch_array($ret)) {
                ?>
                
                    <div class="product-item">
                        <img src="Images/<?php echo $row['image'];?>" >
                        <h3><?php echo $row['product_name'];?></h3>
                        <p><?php echo $row['price'];?> LKR</p>
                        <p><?php echo $row['quantity'];?></p>
                        <p><?php echo $row['category'];?></p>
                    </div>

                <?php 
                        $cnt++;
                        }
                        echo '</div>'; 
                        } else {
                ?>
                    <div>
                        <h3 style="text-align:center; color:red; padding-top: 50px;" colspan="6">No Records Found</h3>
                    </div>
                <?php } ?> 

            </div>
        </div>
    </section>

    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>