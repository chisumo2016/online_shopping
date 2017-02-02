
<?php include 'database/db.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Online Shopping</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/customs.css">
	<script src="js/bootstrap.js"></script>
</head>
<body>
<!---- Start of Navigation Bar-->
<?php include'includes/header.php';?>
<!---- End of Navigation Bar-->
	
	<div class="container">
		<div class="row">
		
		<?php
			if(isset($_GET['category'])){
				$sql_select = "SELECT * FROM items WHERE product_category='$_GET[category]'";
				$run_select = mysqli_query($conn, $sql_select);
				while($rows  = mysqli_fetch_assoc($run_select)){
				$discounted_priced = $rows['item_price'] - $rows['item_discount'];
				$item_title  =str_replace(" " , "-", $rows['item_title']);  // Removing space of url
				echo "
						<div class=col-md-3>
						<div class='col-md-12 single-item noPadding'>
							<div class='top'><img src='$rows[item_image]'  alt=''></div>
								<div class='bottom'>
									<h3 class='item-title'><a href='product.php?item_title=	$item_title&item_id=$rows[item_id]'>$rows[item_title];</a></h3>
										<div class='pull-right cutted-price text-muted'><del>£ $rows[item_price];/=</del></div>
											<div class='clearfix'></div>
										<div class='pull-right discounted-price''>£ $discounted_priced /=</div>
								</div>
						</div>
					</div>
				
				";
			  }
			}
			
		?>

		</div><!---- End of row-->
		<div class="clearfix"></div>
		<!---- Start of footer-->
		 <?php include'includes/footer.php';?>
		<!---- End of footer-->
	</div><!---- End of Container-->
</body>
<!--
<div class="col-md-3"><div class="col-md-12 single-item">Hello</div></div>
<div class="col-md-3"><div class="col-md-12 single-item">Hello</div></div>
<div class="col-md-3"><div class="col-md-12 single-item">Hello</div></div>
-->
</html>