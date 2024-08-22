<?php 

include('../config.php');

if(isset($_POST['submit'])){
	
	$uid=$_GET['userid'];
	$image=$_FILES["image"]["name"];
	$oldimage=$_POST['oldpic'];
	$oldimage="../Images"."/".$oldimage;

	$extension = substr($image, strrpos($image, '.'));

	$allowed_extensions = array(".jpg",".jpeg",".png",".gif");

	if(!in_array($extension,$allowed_extensions)){
		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
	}else{
		$imgfile = $_FILES["image"]["tmp_name"];
		$imgnewfile = md5_file($imgfile) . time() . $extension;

		move_uploaded_file($_FILES["image"]["tmp_name"],"../Images/".$imgnewfile);
  		
     	$query=mysqli_query($conn, "update product set image='$imgnewfile' where product_id='$uid' ");
    	if ($query) {
 
    		unlink($oldimage);
    		echo "<script>alert('Image Update successfully');</script>";
    		echo "<script type='text/javascript'> document.location ='products.php'; </script>";
  		}else{
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
		<title>Update Image</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
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
			.img-changeform {
				width: 450px;
				margin: 0 auto;
				padding: 30px 0;
				font-size: 15px;
			}
			.img-changeform h2 {
				color: #636363;
				margin: 0 0 15px;
				position: relative;
				text-align: center;
			}
			.img-changeform h2:before, .img-changeform h2:after {
				content: "";
				height: 2px;
				width: 30%;
				background: #d4d4d4;
				position: absolute;
				top: 50%;
				z-index: 2;
			}	
			.img-changeform h2:before {
				left: 0;
			}
			.img-changeform h2:after {
				right: 0;
			}
			.img-changeform .hint-text {
				color: #999;
				margin-bottom: 30px;
				text-align: center;
			}
			.img-changeform form {
				color: #999;
				border-radius: 25px;
				margin-bottom: 15px;
				background: hsla(214, 57%, 51%, 0.179);
				border: 2px solid hsla(214, 57%, 51%, 0.214);
				box-shadow: #3b79c9;
				padding: 30px;
			}
			.img-changeform .form-group {
				margin-bottom: 20px;
			}
			.img-changeform input[type="checkbox"] {
				margin-top: 3px;
			}
			.img-changeform .btn {        
				font-size: 16px;
				font-weight: bold;		
				min-width: 140px;
				outline: none !important;
			}

			.btn {        
				font-size: 16px;
				background: #3b79c9;
				border-radius: 25px;
				font-weight: bold;		
				min-width: 140px;
				border: none;
				box-shadow: #3b79c9;
				outline: none !important;
			}

			.btn:hover{
				background-color: hsla(214, 57%, 51%, 0.214);
				color: black;
			}

			.img-changeform .row div:first-child {
				padding-right: 10px;
			}
			.img-changeform .row div:last-child {
				padding-left: 10px;
			}    	
			.img-changeform a {
				color: #fff;
				text-decoration: underline;
			}
			.img-changeform a:hover {
				text-decoration: none;
			}
			.img-changeform form a {
				color: #5cb85c;
				text-decoration: none;
			}	
			.img-changeform form a:hover {
				text-decoration: underline;
			}  
			.text-center .back {
				color: black;
				font-weight: bold;
				text-decoration: none;
			}
		</style>
	</head>
	<body>
		<div class="img-changeform">
			<form  method="POST" enctype="multipart/form-data">
			<?php
				$eid=$_GET['userid'];
				$ret=mysqli_query($conn,"select * from product where product_id='$eid'");
				while ($row=mysqli_fetch_array($ret)) {
			?>
				<h2>Change</h2>
				<p class="hint-text">Display Pic</p>
				<input type="hidden" name="oldpic" value="<?php  echo $row['image'];?>">
				<div class="form-group">
				<img src="../Images/<?php  echo $row['image'];?>" width="120" height="120">
				</div>
				<div class="form-group">
					<input type="file" class="form-control" name="image"  required="true">
					<span style="color:red; font-size:12px;">Only jpg / jpeg/ png /gif format allowed.</span>
				</div> 
				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
				</div>
				<div class="text-center"><a href="products.php" class="back">Cancel</a></div>
			<?php 
			}?>
			</form>

			<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

		</div>
</body>
</html>