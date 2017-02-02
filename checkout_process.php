<?php session_start();?>
<?php include 'database/db.php';?>

<!--Buy process page and Ajax Request-->
	<?php
     if(isset($_REQUEST['checkout_del_id'])){
		    $chk_del_sql = "DELETE  FROM checkout WHERE  checkout_id ='$_REQUEST[checkout_del_id]'";
		   // $chk_del_run = mysqli_query($conn,  $chk_del_sql);
		 if($chk_del_run  = mysqli_query($conn,  $chk_del_sql)){
			 ?><script>alert('Hi')</script> <?php
		 }else{
			 ?><script>alert('Hi')</script> <?php
		 }
	 }
   // UPDATE CHECKOUT 
    if(isset($_REQUEST['up_chk_qty'])){
		$up_chk_qty = "UPDATE  checkout SET checkout_quantity ='$_REQUEST[up_chk_qty]' WHERE checkout_id='$_REQUEST[up_chk_id]'";
		$up_chk_run =  mysqli_query($conn, $up_chk_qty);
	}
  
	$c   			  =1;
	//$checkout_sel_sql = "SELECT * FROM checkout WHERE checkout_reference = '$_SESSION[ref]'";
	$checkout_sel_sql 	   = "SELECT * FROM checkout c JOIN items i ON  c.checkout_product = i.item_id  WHERE c.checkout_reference='$_SESSION[ref]'";
	$checkout_sel_run 	   =  mysqli_query($conn , $checkout_sel_sql);
	while($check_sel_rows  = mysqli_fetch_assoc( $checkout_sel_run)){
		
		$discounted_price  = $check_sel_rows['item_price'] -  $check_sel_rows['item_discount'];// Calculate the discounted_price
		$total			   =  $discounted_price *   $check_sel_rows['checkout_quantity']; // Calculate the Total Amount
		echo "
			<tr>
				<td>$c</td>
				<td>$check_sel_rows[item_title]</td>";?>
				
				<td><input type='number' style='width:45px;'  onblur="up_chk_qty(this.value, '<?php echo $check_sel_rows['checkout_id'];?>');"   value='<?php echo $check_sel_rows['checkout_quantity'];?>'></td>
				
				<td><button class='btn btn-danger btn-sm' onclick="delete_func(<?php echo $check_sel_rows['checkout_id'];?>);">Delete</button></td>
				
				<?php echo "<td class='text-right'><b>$discounted_price/=</b></td>
				<td class='text-right'><b>$total/=</b></td>
			</tr>	
		";
		$c++;
	}
				
	?>