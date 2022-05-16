<?php 
session_start();
include 'header.php';
include 'config.php';
if(!isset($_SESSION["cart"])){
	$_SESSION["cart"]=array();
	$_SESSION["count"]=0;
}
else if(isset($_GET["name"])){
	$id=$_GET["name"];
	foreach ($products as $key => $val) {
		if($val['id']==$id){
			$_SESSION["count"]+=1;
			$index=$_SESSION["count"];
			//array_push($_SESSION["cart"],$val);
			$_SESSION["cart"][$index]=$val;

		}
	}
	
	//print_r($_SESSION["cart"]);


}
if(isset($_POST["submit"])){
	$del_key=($_POST["submit"]);
	unset($_SESSION["cart"][$del_key]);
}


?>
	<div id="main">
		<div id="products">
	<?php		foreach ($products as $key => $val) {  ?>
			<div id="<?php echo($val['id']) ?>" class="product">
				<img src="<?php echo($val['image']) ?>">
				<h3 class="title"><a href="#"><?php echo($val['name']) ?></a></h3>
				<span>Price: $<?php echo($val['price']) ?>.00</span>
				<a class="add-to-cart" href="?name=<?php echo($val['id']) ?>">Add To Cart</a>
			</div>
	<?php	}                                           ?>		
			
		</div>
	</div>

	<?php if(isset($_GET["name"])||isset($_SESSION["cart"])){ ?>
	<div id="cart">
		<table>
			<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Action</th></tr>
		<?php foreach($_SESSION["cart"] as $key => $val){ ?>
			<tr><td><?php echo($val['id']); ?></td>
			<td><?php echo($val['name']); ?></td>
			<td><?php echo($val['price']); ?></td>
			<form action="products.php" method="POST">
			<td><button type="submit" name="submit" value="<?php echo($key); ?>">Delete</button></td>
			</form>
		
		    </tr>


	    <?php 		
		}
		?>
		</table>
	</div>

	
	<?php } 
	
	include 'footer.php';  ?>