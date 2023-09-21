<html>
<head>
<link rel='stylesheet' href='css/style.css' type='text/css' />
</head>
<?php
session_start();
//Removing
if (isset($_POST['remove'])){
foreach($_SESSION["shopping_cart"] as &$value){
       
          if($value['id'] === $_POST["id"]){
            $key=$value['name'];
            unset($_SESSION["shopping_cart"][$key]);
            echo "<script>alert('Item Removed')</script>";
            if(!isset($_SESSION["shopping_cart"]))
                unset($_SESSION["shopping_cart"]);
            break; // Stop the loop after we've found the product
        
                    }		
                }
        
}


//Plus
if (isset($_POST['add_quantity'])){
    foreach($_SESSION["shopping_cart"] as &$value){
      if($value['id'] === $_POST["id"]){
          $value['quantity'] +=1;
          break; // Stop the loop after we've found the product
      }
  }
}

//Minus
if (isset($_POST['sub_quantity'])){
 
    foreach($_SESSION["shopping_cart"] as &$value){
        if($value['quantity']>1){
            if($value['id'] === $_POST["id"]){
                $value['quantity'] -=1;
                break; // Stop the loop after we've found the product
            }
        }

        if($value['quantity']==1){
          if($value['id'] === $_POST["id"]){
            $key=$value['name'];
            unset($_SESSION["shopping_cart"][$key]);
            echo "<script>alert('Item Removed')</script>";
            if(empty($_SESSION["shopping_cart"])){
                unset($_SESSION["shopping_cart"]);
            break;} // Stop the loop after we've found the product
        }
                    }		
                }
}








      
?>

<body>
<h2>Your Cart</h2>   




<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="table">
    <tbody>
        <tr>
            <td>Picture</td>
            <td>ITEM NAME</td>
            <td>QUANTITY</td>
            <td>QUANTITY</td>
            <td>UNIT PRICE</td>
            <td>ITEMS TOTAL</td>
        </tr>	
        <?php		foreach ($_SESSION["shopping_cart"] as $product){ ?>
        <tr>
            <td><img src='<?php echo $product["image"]; ?>' width="50" height="40" /></td>
            <td><?php echo $product["name"]; ?><br />

            <!-- Removing -->
            <form method='post' action=''>
            <input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
            <button type='submit' name="remove">Remove Item</button>
            </form>
            <!-- Removing -->

            </td>
            <td>
                
            <form method='post' action=''>
            <input type='hidden' name='id' value="<?php echo $product["id"]; ?>" />
            <button type='submit' name="add_quantity">+</button>
            <button type='submit' name="sub_quantity">-</button>

            </form>
            </td>
            <td><?php echo $product["quantity"]; ?></td>
            <td><?php echo "$".$product["price"]; ?></td>
            <td><?php echo "$".$product["price"]*$product["quantity"]; ?></td>
        </tr>
        <tr>
            <td>
            <?php
            $total_price =$total_price+ ($product["price"]*$product["quantity"]);
            } //Loop Ended
            ?>
            <strong>TOTAL: <?php echo "$".$total_price; ?></strong>
            <a href="checkout.php?p=<?php echo $total_price?>">checkout</a>

            </td>
        </tr>
    </tbody>
</table>		
  <?php
} //If Ended
else{
	echo "<h3>Your cart is empty!</h3>";
	}
?>



</body>
</html>