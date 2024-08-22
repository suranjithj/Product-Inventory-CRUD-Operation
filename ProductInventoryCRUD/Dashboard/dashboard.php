<?php

include('../config.php');

$totalProducts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM product"))['total'];
$totalStockValue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(price * quantity) as total_value FROM product"))['total_value'];
$outOfStockProducts = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as out_of_stock FROM product WHERE quantity = 0"))['out_of_stock'];

$totalStockValue = $totalStockValue !== null ? $totalStockValue : 0;

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="dashboard-style.css" rel="stylesheet">
</head>

<body>
    <div id="main" class="main" >

        <header class="topbar" id="topbar">
            <div class="navbar-header">
            <a class="name" href="../index.php"><span>Product Inventory</span></a></div>
        </header>
        
        <div class="menu">
            <div class="sidebar" data-navbar>
                <ul id="sidebarnav" class="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link" href="../Products/products.php" sidebar-link>
                        <span class="hide-menu">Manage Products</span></a></li>    
                    <li class="sidebar-item"> <a class="sidebar-link" href="../index.php" sidebar-link>
                        <span class="hide-menu">Go to Home</span></a></li>  
                    <li class="sidebar-item"><a href="../Login/logout.php" class="logout">
                        <span class="hide-menu">Logout</span></a></li>             
                </ul>
            </div>
            <div class="dashboard-content"> 
                <div class="content-view" style="height:120px">
                    <h2>Welcome to Admin Dashboard!</h2>
                    <h4 class="page-title">Overview</h4>
                </div>
                <div class="container-xl">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Products</h5>
                                    <p class="card-text"><?php echo $totalProducts; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-success mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Total Stock Value</h5>
                                    <p class="card-text"><?php echo number_format($totalStockValue, 2); ?> LKR</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">Out of Stock Products</h5>
                                    <p class="card-text"><?php echo $outOfStockProducts; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>

</html>
