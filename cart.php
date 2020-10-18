<?php
session_start();
$database_name="Product_details";
$con=mysqli_connect('localhost','root','',$database_name);

if(isset($_POST["add"])){
    if(isset($_SESSION["cart"])){
        $item_array_id = array_column($_SESSION["cart"],"id");
        if(!in_array($_GET["id"],$item_array_id)){
            $count = count($_SESSION["cart"]);
            $item_array = array (
                  'product_id' => $_GET["id"],
                  'item_name' => $_POST["hidden_name"],
                  'product_price' => $_POST["hidden_price"],
                  'item_quantity' => $_POST['quantity'],

            );
            $_SESSION["cart"][$count] = $item_array;
            echo '<script>window.location="cart.php"</script>';
        }else{
            echo '<script>alert("Product is already Added to Cart")</script>';
            echo '<script>window.location="cart.php"</script>';

        }



    }else{
        $item_array = array (
            'product_id' => $_GET["id"],
            'item_name' => $_POST["hidden_name"],
            'product_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST['quantity'],


        );
        $_SESSION["cart"][0] = $item_array;

    }
}


if(isset($_GET["action"])){
    if($_GET["action"] == "delete"){
        foreach ($_SESSION["cart"] as $key => $value ){
            if($value["id"] == $_GET["id"]){
                unset($_SESSION["cart"][$key]);
                echo '<script>alert("Product has been removed...!")</script>';
                echo '<script> window.location="cart.php"</script>';
            }
        }
    }
}



?>


<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<meta charset="UTF-8" >
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Titillium+Web&display=swap');
    *{
        font-family: 'Titillium Web', sans-serif;
    }
.product{

    border:1px solid #eaea;
    margin:-1px 19px 3px -1px;
    padding:10px;
    text-align:center;
    background-color:#efefef;
}
table,th,tr{
    text-align:center;
    
}
.title2{
    color:#66afe9;
    background-color:#efefef;
    padding:2%;
}
.h2{
    text-align:center;
    color:#66afe9;
    background-color:#efefef;
    padding:2%;


}
table th{
    background-color:#efefef;

}
</style>


</head>
<body>
    <div class="container" style="width: 65%;" >
<a href="giris.php">Giriş Yap</a>
<h2>Shopping Cart</h2>
<?php
$query="SELECT * FROM product ORDER BY id ASC";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_array($result)){
        
       ?>

        <div class="col-md3" >

<form action="cart.php?action=add&id=<?php echo $row['id'];   ?>" method="post">
<div class="product">
<img style="width:300px;height:300px;" src="<?php echo $row['image'];  ?>" class="img-responsive">
<h3 class="text-info" ><?php echo $row['pname'];  ?>  </h3>
<p3 class="text-info" ><?php echo $row['pinfo'];  ?>  </p3>
<h3 class="text-danger"><?php echo $row['price'];  ?></h3>
<input type="text" name="quantity" class="form-control" value="1" style="margin:0 auto;" >
<input type="hidden" name="hidden_name" class="form-control" value="<?php echo $row['pname'] ?>" >
<input type="hidden" name="hidden_price" class="form-control" value="<?php echo $row['price']  ?>" >
<input type="submit" name="add" class="btn btn-success" value="Add To Cart" style="margin-top:5px"; >
</div>
</form>
 </div>
        <?php

    }
}

?>

<div style="clear: both" ></div>
<h3 class="title2" >Shopping Cart Details</h3>
<form action="" method="post">
<div class="table-responsive" >
    <table class="table table-bordered" >
    <tr>
        <th width:30% >Product Name</th>
        <th width:10% >Quantity</th>
        <th width:13% >Price Details</th>
        <th width:10% >Total Price</th>

    </tr>
    <?php
if(!empty($_SESSION["cart"])){
    $total=0;
    foreach($_SESSION["cart"] as $key => $value ){
?>
<tr>
    <td><?php echo $value["item_name"];  ?></td>
    <td>  <?php echo $value["item_quantity"];  ?></td>
    <td> TL <?php echo $value["product_price"] ; ?></td>
    <td> TL <?php echo number_format($value["item_quantity"] * $value["product_price"],2);  ?> </td>
</tr>

<?php
$total = $total + $value["item_quantity"] * $value["product_price"];

}
?>
<tr>

    <td colspan="3" align="right">Total</td>
    <th align="right"><?php echo number_format($total,2);?> TL</th>
    <td></td>
</tr>

<table>
<tr>

<td><input type="text"></td>


</tr>

</table>
<?php
    
}



    ?>
    </table>
    <a href="cart.php?action=delete&id=<?php $value["id"];?>"><span class="text-daner">Sepeti Temizle</span></a>

</div>
</form>

    </div>
</body>


</html>