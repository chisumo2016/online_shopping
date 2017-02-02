<?php include 'database/db.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Details Products</title>
	
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/customs.css">
	
	<script src="jquery/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<style>
		.btn{
			font-size:30px; 
/*			border-radius: 0;*/
			height: 70px;
		}
	
	</style>
</head>

<body>
	<!---- Start of Navigation Bar-->
	<?php include 'includes/header.php';?>
	<!---- End of Navigation Bar-->
	
	<div class="container">
		<div class="row">
				<ol class="breadcrumb">
					<li><a href="index.php">Home</a></li>
					<?php 
					    // FETCH DATA TO THE ITEM PAGE  -SINGLE ITEM
			              if(isset($_GET['item_id'])){
							 $sql_select_product = "SELECT * FROM items WHERE item_id = '$_GET[item_id]'";
							 $run_select_product = mysqli_query($conn, $sql_select_product);
							 while($rows  = mysqli_fetch_assoc( $run_select_product)){
								 $product_category =ucwords($rows['product_category']);   // item_category
								 $product_id       = $rows['item_id'];  // Checkout id
								 echo "
								      <li><a href='product_category.php?category=$product_category'></a>$product_category</li>
									  <li class='active'>$rows[item_title]</li>
								 
								 ";
					?>
<!--
					<li><a href="#">Watches</a></li>
					<li class="active">Beatiful Watch</li>
-->
				</ol>
		</div>  <!-- End of Category Area-->
		
		<div class="row">
		
		       <?php
						     echo "
							     <div class='col-md-8'>
		
								<h3 class='product-page-title'>$rows[item_title]</h3>
									<img src='$rows[item_image]' width='400px' class='img-responsive'alt=''>
									<h4 class='pp-desc-head'>Description </h4>
									<div class='pp-details'>$rows[item_description]</div>
								   </div> 
							 ";
					      }
					}
			?>
			<aside class="col-md-4">
			
				<a href="checkout.php?checkout_product_id=<?php echo $product_id;?>" class="btn btn-success btn-lg btn-block">Buy</a>
				<br>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-3"><i class="fa fa-truck fa-3x" aria-hidden="true"></i></div>
						<div class="col-md-9">Delivered within 5 days</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-3"><i class="fa fa-refresh fa-3x" aria-hidden="true"></i></div>
						<div class="col-md-9">Easy return in 7 days</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-3"><i class="fa fa-phone fa-2x" aria-hidden="true"></i></div>
						<div class="col-md-9">Call at  00000000000000</div>
						</div>
					</li>
				</ul>
			</aside> <!---- End of Aside Area-->
			</div>
				
			<!--Related  post Area-->
			<div class="page-header">
				<h2>Related Items /Product</h2>
			</div>
            <section class="row">
              <?php  
				  $related_sql    = "SELECT  * FROM items ORDER BY rand()  LIMIT 4 ";
				  $related_run    =  mysqli_query($conn,  $related_sql);
				  while($rel_rows =  mysqli_fetch_assoc($related_run)){
					  // Formula to calculate discounted Price
					  $discount_price = $rel_rows['item_price'] -$rel_rows['item_discount']; 
					  $item_title     =str_replace(' ', '_', $rel_rows['item_title']);
					  echo "
					        <div class='col-md-3'>
					<div class='col-md-12 single-item noPadding'>
						<div class='top'><img src='$rel_rows[item_image] ' class='img-responsive' alt=''></div>
							<div class='bottom''>
								<h3 class='item-title'><a href='product.php?item_id=$rel_rows[item_id]item_title=$item_title'>$rel_rows[item_title]</a></h3>
									<div class='pull-right cutted-price text-muted'><del>£$rel_rows[item_price]/=</del></div>
										<div class='clearfix'></div>
									<div class='pull-right discounted-price'>£ $discount_price /=</div>
							</div>
					</div>
				</div>  
					  ";
				  }
			  ?>
				
<!--
           <div class="col-md-3">
					<div class="col-md-12 single-item noPadding">
						<div class="top"><img src="images/products/watches.jpg" class="img-responsive" alt=""></div>
							<div class="bottom">
								<h3 class="item-title"><a href="product.php">Beatiful Watch</a></h3>
									<div class="pull-right cutted-price text-muted"><del>£500/=</del></div>
										<div class="clearfix"></div>
									<div class="pull-right discounted-price">£450/=
									</div>
							</div>
					</div>
				</div>
-->
            </section>
		<br><br><br><br><br>
	</div>
	<!---- Start of footer-->
	<?php include 'includes/footer.php';?>
	<!---- End of foooter-->
	
</body>
</html>