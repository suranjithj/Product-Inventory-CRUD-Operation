<?php

include('config.php');

?>

<?php $search = $_GET['search'] ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <title>Products</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>

            *, *::before, *::after {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            * {
                font-family: "Poppins", sans-serif;
                scroll-behavior: smooth;
                margin-top: 25px;
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
                margin-top: 50px;
                border-radius: 3px grey;
                text-align: center;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .product-item img {
                max-width: 250px;
                height: auto;
                border-radius: 8px;
                margin-bottom: 10px;
            }

            .product-item h3 {
                margin: 10px 0;
                font-size: 18px;
            }

            .product-item p {
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
        </style>

    </head>
    <body>
        <div class="container">

            <h2>Products</h2>
            <a href="index.php"><button class="btn btn-secondary">Back to Home</button></a>
                    
            <?php
                    $ret=mysqli_query($conn,"select * from product WHERE product_name LIKE '%$search%' OR price LIKE '%$search%' OR category LIKE '%$search%' OR sku LIKE '%$search%'");
                    $cnt=1;
                    $row=mysqli_num_rows($ret);
                    if($row>0){
                    while ($row=mysqli_fetch_array($ret)) {
            ?>
            <ul class="popular-list">
                <li>
                    <div class="popular-card">            
                        <div class="product-item">
                            <img src="Images/<?php echo $row['image'];?>" >
                            <h3><?php echo $row['product_name'];?></h3>
                            <p><?php echo $row['price'];?></p>
                            <p><?php echo $row['quantity'];?></p>
                            <p><?php echo $row['category'];?></p>
                        </div>
                    </div>
                </li>
            </ul>

            <?php 
                $cnt=$cnt+1;
            } } else {?>
                <tr>
                    <th style="text-align:center; color:red;" colspan="6">No Record Found</th>
                </tr>
            <?php } ?>

        </div>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>