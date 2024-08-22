<?php 

include('../config.php');

if(isset($_POST['submit'])){

    $product_name=$_POST['product_name'];
    $description=$_POST['description'];
	$price=$_POST['price'];
    $quantity=$_POST['quantity'];
	$category = $_POST['category'];
    $sku=$_POST['sku'];
    $image=$_FILES["image"]["name"];

	$extension = substr($image,strlen($image)-4,strlen($image));

	$allowed_extensions = array(".jpg","jpeg",".png",".gif");

	if(!in_array($extension,$allowed_extensions)){
		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	}
	else{
		$imgnewfile=md5($image).time().$extension;

		move_uploaded_file($_FILES["image"]["tmp_name"],"../Images/".$imgnewfile);

		$query=mysqli_query($conn, "insert into product(product_name, description, price, quantity, category, sku, image) value('$product_name','$description', '$price', '$quantity', '$category', '$sku','$imgnewfile')");
	
		if ($query) {
			echo "<script>alert('Successfully Product Added!');</script>";
			echo "<script type='text/javascript'> document.location ='products.php'; </script>";
		} else{
			echo "<script>alert('Something Went Wrong. Please try again');</script>";
		}
	}

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

		<title>Add Product</title>

		<style>
			body {
				color: #fff;
				background: white;
				font-family: "Montserrat", sans-serif;
			}
			.form-control {
				height: 40px;
				box-shadow: none;
				color: #969fa4;
			}
			.form-control:focus {
				border-color: #5cb85c;
			}
			.form-control, .btn {        
				border-radius: 3px;
			}
			.l-form {
				width: 550px;
				margin: 0 auto;
				padding: 30px 0;
				font-size: 15px;
			}
			.l-form h2 {
				color: #636363;
				margin: 0 0 15px;
				position: relative;
				text-align: center;
			}
			.l-form h2:before, .l-form h2:after {
				content: "";
				height: 2px;
				width: 30%;
				background: #d4d4d4;
				position: absolute;
				top: 50%;
				z-index: 2;
			}	
			.l-form h2:before {
				left: 0;
			}
			.l-form h2:after {
				right: 0;
			}
			.l-form .hint-text {
				color: #999;
				margin-bottom: 30px;
				text-align: center;
			}
			.l-form form {
				color: #999;
				border-radius: 25px;
				margin-bottom: 15px;
				background: hsla(214, 57%, 51%, 0.179);
				border: 2px solid hsla(214, 57%, 51%, 0.214);
				box-shadow: #3b79c9;
				padding: 30px;
			}
			.l-form .form-group {
				margin-bottom: 20px;
			}
			.l-form input[type="checkbox"] {
				margin-top: 3px;
			}
			.l-form .btn {        
				font-size: 16px;
				background: #3b79c9;
				border-radius: 25px;
				font-weight: bold;		
				min-width: 140px;
				border: none;
				box-shadow: #3b79c9;
				outline: none !important;
			}
			.l-form .btn:hover{
				background-color: hsla(214, 57%, 51%, 0.214);
				color: black;
			}
			.l-form .row div:first-child {
				padding-right: 10px;
			}
			.l-form .row div:last-child {
				padding-left: 10px;
			}    	
			.l-form a {
				color: #fff;
				text-decoration: underline;
			}
			.l-form a:hover {
				text-decoration: none;
			}
			.l-form form a {
				color: black;
				font-weight: bold;
				text-decoration: none;
			}	
			.l-form form a:hover {
				text-decoration: underline;
			}  
			
		</style>
	</head>
	<body>
		<div class="l-form">
			<form  method="POST" enctype="multipart/form-data">
				<h2>Fill Data</h2>
				
				<div class="form-group">
					<label for="product_name">Product Name</label>
					<input type="text" class="form-control" name="product_name" required="true">     	
				</div>
				<div class="form-group">
					<label for="description">Description</label>
					<textarea id="myTextarea" name="description" rows="10" ></textarea>
					<br>
				</div>
				<div class="form-group">
					<label for="price">Price</label>
					<input type="text" class="form-control" name="price" placeholder="LKR" required="true">
				</div>
				<div class="form-group">
					<label for="quantity">Quantity</label>
					<input type="number" name="quantity" min="0" max="1000" class="form-control" name="quantity" required="true">
				</div>
				<div class="form-group">
					<label for="category">Choose the Category</label>
					<select class="form-control" name="category" id="category">
						<option value="category1">Category 1</option>
						<option value="category2">Category 2</option>
						<option value="category3">Category 3</option>
						<option value="category4">Category 4</option>
						<option value="category5">Category 5</option>
					</select>
				</div>
				<div class="form-group">
					<label for="sku">SKU</label>
					<input class="form-control" name="sku" required="true"></input>
				</div>  

				<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
				<script>
					ClassicEditor
						.create(document.querySelector("#myTextarea"))
						.catch(error => {
							console.error( error );
						} );
				</script>


				<div class="form-group">
					<input type="file" class="form-control" name="image"  required="true">
					<span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
				</div>      
			
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Submit</button>
				</div>

				<div class="text-center"><a href="products.php">Back</a></div>
			</form>
			
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

	</body>
</html>