<?php session_start(); ?>
<?php include 'database/db.php';?>
<?php
// Getting an Id for checkout 
   if(isset($_GET['checkout_product_id'])){
	   $date = date('Y-m-d h:i:s');
	   $rand_num =mt_rand();
	   
	   // Set some limitation 
	   if(isset($_SESSION['ref'])){
		   
	   }else{
		     $_SESSION['ref'] = $date .' '.$rand_num;  // Created by user
	   }
	 
	   //Insert into the database
	   $check_sql = "INSERT INTO checkout (checkout_product, checkout_reference, checkout_timing, checkout_quantity) VALUES ('$_GET[checkout_product_id]', '$_SESSION[ref]', '$date', 1)";
	  $checkout_run = mysqli_query($conn, $check_sql );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shopping Cart</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/customs.css">
	
	<script src="jquery/jquery.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script>
		function ajax_func(){
			xmlhttp = new  XMLHttpRequest();
		    xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById('get_process_data').innerHTML = xmlhttp.responseText;
				}
			}
			
			xmlhttp.open('GET', 'checkout_process.php',true);
			xmlhttp.send();
		}
		
	//Delete function
	function delete_func(checkout_id){
//		alert(checkout_id);
		xmlhttp = new  XMLHttpRequest();
		    xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById('get_process_data').innerHTML = xmlhttp.responseText;
				}
			}
			
			xmlhttp.open('GET', 'checkout_process.php?checkout_del_id='+checkout_id,true);
			xmlhttp.send();
	}
		
		
	function up_chk_qty(chk_qty, checkout_id){
		//alert(chk_qty);
			xmlhttp = new  XMLHttpRequest();
		    xmlhttp.onreadystatechange = function(){
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
					document.getElementById('get_process_data').innerHTML = xmlhttp.responseText;
				}
			}
			
			xmlhttp.open('GET', 'checkout_process.php?up_chk_qty='+chk_qty+'&up_chk_id='+checkout_id,true);
			xmlhttp.send();
	}
	
	
	</script>
</head>
<body onload="ajax_func();">
	<!---- Start of Navigation Bar-->
	<?php include 'includes/header.php';?>
	<!---- End of Navigation Bar-->
	
	<div class="container">
		<div class="page-header">
			<h2 class="pull-left">Checkout</h2>
			<div class=" pull-right"><button class="btn btn-success" data-toggle="modal" data-target="#proceed_modal" data-backdrop="static" data-keyboard="false">Proceed</button></div>
			<!--- The Proceed form Modal-->
				<div id="proceed_modal" class="modal fade">
					<div class="modal-dialog ">
						<div class="modal-content">
							<div class="modal-header">
								<!--Modal Header-->
									<button class="close" data-dismiss="modal">&times;</button>
								</div>
							<div class="modal-body">
								<form action="" class="form-group">
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" placeholder="Full Name" id="name">
									</div>
									
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" class="form-control" placeholder="Full Email" id="email">
									</div>
									<div class="form-group">
										<label for="contact">Tel Number</label>
										<input type="text" class="form-control" placeholder="Tel Number" id="contact">
									</div>
									<div class="form-group">
										<label for="city">City</label>
										<input list="city" class="form-control">
										<datalist id="city" >
										  <option>Tanzania</option> >
										  <option>Kenya</option>>
										  <option>Uganda</option>
										  <option>Burundi</option>
										  <option>Mombasa</option>
										</datalist>
									</div>
									<div class="form-group">
										<label for="address">Delivery Address</label>
										  <textarea class="form-control"></textarea>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-danger btn-block"  id="submit">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			<div class="clearfix"></div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">Order Detail</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>S .NO </th>
							<th>Item </th>
							<th>qty </th>
							<th width="5%">Delete </th>
							<th class="text-right">Price </th>
							<th class="text-right">Total </th>
						</tr>
					</thead>
					<tbody id="get_process_data">
                     <!--	The Buy process data	
                            
                            				
                            												-->
<!--
						<tr>
							<td>2</td>
							<td>Tea Cup Set</td>
							<td>4</td>
							<td><button class="btn btn-danger btn-sm">Delete</button></td>
							<td class="text-right"><b>150/=</b></td>
							<td class="text-right"><b>100/=</b></td>
						</tr>

-->
					</tbody>
				</table>
				
				<table class="table">
					<thead>
						<tr>
							<th class="text-center" colspan="2"> Order Summary</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Subtotal</td>
							<td class="text-right"><b>700</b></td>
						</tr>
						<tr>
							<td>Delivery Charges</td>
							<td class="text-right"><b>Fees</b></td>
						</tr>
						
						<tr>
							<td> Grand Total</td>
							<td class="text-right"><b>700</b></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	</div>
	
	<br><br><br><br>
	<!---- Start of footer-->
	<?php include 'includes/footer.php';?>
	<!---- End of foooter-->
	
</body>
</html>