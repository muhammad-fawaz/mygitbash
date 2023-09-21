<?php
session_start();
include 'db.php';
$pr=$_GET['p'];
$q1="INSERT INTO `orders`( `username`, `price`) VALUES ('farah','$pr')";
$res1=mysqli_query($con,$q1);
$or=mysqli_insert_id($con);
    foreach($_SESSION["shopping_cart"] as $value){
        $quan=$value['quantity'];
        $idd=$value['id'];
 $q="INSERT INTO `items`(`order_id`, `pro_id`, `quanity`)
  VALUES ('$or','$idd','$quan')";
  $res=mysqli_query($con,$q);
    }
  session_destroy();
   echo "<script>alert('Your order has been placed');window.location.href='cart.php'</script>";
?>