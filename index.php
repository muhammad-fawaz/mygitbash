<html>
<head>
<link rel='stylesheet' href='css/style.css' type='text/css' />
</head>

<body>
<div style="width:700px; margin:50 auto;">
<div class="cart_div">
    
<!-- if(isset($_POST['submit'])) -->
<?php
session_start(); 
include("db.php");
if (isset($_POST['submit'])){	
	$id = $_POST['id'];
	$q="SELECT * FROM `products` WHERE `id`='$id'";
	$result = mysqli_query($con,$q);
	$data = mysqli_fetch_assoc($result);
	$id = $data['id'];
	$name = $data['name'];
	$price = $data['price'];
	$image = $data['image'];


	$cartArray = array(
		$name=>array(
		'name'=>$name,
		'id'=>$id,
		'price'=>$price,
		'quantity'=>1,
		'image'=>$image)
	);


	if(!isset($_SESSION["shopping_cart"])) {
		$_SESSION["shopping_cart"] = $cartArray;
		echo "<script>alert('Product is added to your cart!')</script>";
	}
	// array_keys()
	else{
		$array_keys = array_keys($_SESSION["shopping_cart"]);
		if(in_array($name,$array_keys)) {
			foreach($_SESSION["shopping_cart"] as &$value){
				if($value['id'] === $_POST["id"]){
					$value['quantity']=$value['quantity']+1;
					echo "<script>alert('Quanity of this product in your cart is".$value['quantity']."')</script>";
					break; // Stop the loop after we've found the product
				}
			}
		} else {
			$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
			echo "<script>alert('another Product is added to your cart!')</script>";
		}

	}
}
?>

<!-- Count of cart -->
<?php
	if(isset($_SESSION["shopping_cart"])) {
		$cart_count = count(array_keys($_SESSION["shopping_cart"]));
	} else {
		$cart_count=0 ;
	}
?>

<a href="cart.php"><img src="cart-icon.png" /> <span><?php echo $cart_count; ?></span></a>
</div>

<h2> Shopping Cart</h2>   
<?php 
$sql="SELECT * FROM `products`";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_assoc($result)){ ?>
	<div class="product_wrapper">
			<form method="post" action="">
			<input type="hidden" name="id" value="<?php echo $row['id']?>" />
			<div class="card" style="width: 18rem;">
			<img src="<?php echo $row['image']?>" class="card-img-top"  alt="...">
			<div class="card-body">
				<h5 class="card-title"><?php echo $row['name']?></h5>
				<p class="card-text"><?php echo $row['code']?> </p>
				<p class="card-text"><?php echo $row['price']?> </p>
			</div>
			</div>
			<button type="submit" name="submit">Add To Cart</button>
		</form>
	</div>
<?php  } ?>





