<?php

include('../config.php');

$filterCategory = isset($_GET['category']) ? $_GET['category'] : '';

if(isset($_GET['delid'])){
    $rid = intval($_GET['delid']);
    
    if(isset($_GET['image'])) {
        $image = $_GET['image'];
        $ppicpath = "../Images/{$image}";
        
        if(file_exists($ppicpath) && is_file($ppicpath)) {
            unlink($ppicpath);
        } else {
            echo "<script>alert('File not found');</script>";
        }
    }

    $sql = mysqli_query($conn,"DELETE FROM product WHERE product_id =$rid");
    if($sql) {
        echo "<script>alert('Successfully Data deleted');</script>"; 
    } else {
        echo "<script>alert('Failed to delete data');</script>";
    }
    
    echo "<script>window.location.href = 'products.php'</script>";     
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Manage Products</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
            padding-top: 50px;
        }

        .products-section {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px; 
            padding: 20px;
        }

        .product-item {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #808080;
            border-radius: 3px grey;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-item img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-item h3 {
            margin: 10px 0;
            font-size: 18px;
        }

        .product-item .price, .product-item .category {
            font-size: 16px;
            color: #333;
        }

        .filter-form, .table-responsive{
            margin-top: 50px;
        }

        .product-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .low-stock {
            color: red;
            font-weight: bold;
        }

        .low-stock::after {
            content: " - Low Stock!";
            font-size: 15px;
            color: red;
            margin-left: 5px;
        }

        @media (max-width: 1024px) {
            .products-section {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .products-section {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .products-section {
                grid-template-columns: 1fr;
            }
        }

        /* search */

        .srch-form{
            display: flex;
            margin-top: 50px;
        }

        .hero .searchbar{
            display: flex;
            margin-bottom: 50px;
            justify-content: center;
            margin-top: 0;
        }

        .srch-form .search-input{
            width: 100px;
            background-color: transparent;
            height: 50px;
            border: 1px solid black;
            box-shadow: #333;
            border-radius: 50px;
            padding-left: 15px;
            outline: none;
            transition: all 1s;
        }

        .srch-form .search-input:hover{
            cursor: pointer;
            width: 300px;
        }

        .srch-form .search-btn{
            background-color: transparent;
            height: 50px;
            border: 1px solid black;
            box-shadow: #333;
            border-radius: 70px;
            margin-left: 15px;
            width: 50px;
        }

        @media screen and (max-width: 620px) {
            .searchbar{
                left: 50%;
                
            }
        }
        /* search */

    </style>
</head>

<body>
    <div class="container-xl">
        <div class="row">
            <div class="col-sm-5">
                <h2>Manage Products</h2>
            </div>
            <div class="col-sm-7" align="right">
                <a href="addproduct.php" class="btn btn-secondary"><i class="material-icons">&#xE147;</i> <span>Add New Product</span></a>
                <a href="../Dashboard/dashboard.php" class="btn btn-secondary"><span>Back to Dashboard</span></a>
            </div>
        </div>

        <section class="hero" id="home">
            <div class="container">
                <div class="searchbar">
                    <form action="../seach.php" class="srch-form"> 
                        <input type="text" placeholder="Search..." name="search" class="search-input" id="searchInput"> 
                        <button class="search-btn" id="search-btn" aria-label="Search" type="submit" onclick="search()"> 
                            <ion-icon name="search" style="color: black;"></ion-icon>
                        </button>
                    </form>
                </div>                  
        </section>
        
        <div class="filter-form">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <form method="GET" action="products.php">
                        <div class="form-group">
                            <label for="category">Filter Products:</label>
                            <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                <option value="category1" <?php if($filterCategory == 'category1') echo 'selected'; ?>>Category 1</option>
                                <option value="category2" <?php if($filterCategory == 'category2') echo 'selected'; ?>>Category 2</option>
                                <option value="category3" <?php if($filterCategory == 'category3') echo 'selected'; ?>>Category 3</option>
                                <option value="category4" <?php if($filterCategory == 'category4') echo 'selected'; ?>>Category 4</option>
                                <option value="category5" <?php if($filterCategory == 'category5') echo 'selected'; ?>>Category 5</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <div class="table-wrapper">
                <?php
                    $query = "SELECT * FROM product";
                    if ($filterCategory) {
                        $query .= " WHERE category='$filterCategory'";
                    }
                    $ret = mysqli_query($conn, $query);
                    $cnt = 1;
                    $row_count = mysqli_num_rows($ret);
                    if($row_count > 0) {
                        echo '<div class="products-section">';
                        while ($row = mysqli_fetch_array($ret)) {
                            $lowStock = $row['quantity'] < 10 ? 'low-stock' : '';
                ?>
                
                    <div class="product-item">
                        <img src="../Images/<?php echo $row['image'];?>" width="120" height="120">
                        <h3><?php echo $row['product_name'];?></h3>
                        <p class="price"><?php echo $row['price'];?> LKR</p>
                        <p class="<?php echo $lowStock; ?>"><?php echo $row['quantity'];?></p>
                        <p class="category"><?php echo $row['category'];?></p>
                        <div>
                            <a href="edit.php?editid=<?php echo htmlentities($row['product_id'] ?? ''); ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                            <a href="products.php?delid=<?php echo htmlentities($row['product_id'] ?? ''); ?>&&ppic=<?php echo htmlentities($row['image'] ?? ''); ?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to Delete ?');"><i class="material-icons">&#xE872;</i></a>
                        </div>
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
    </div>   

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
