<?php session_start();?>
<?php include "checkout_process.php";?>
	<?php

	$c   			  =1;
	//$checkout_sel_sql = "SELECT * FROM checkout WHERE checkout_reference = '$_SESSION[ref]'";
	$checkout_sel_sql = "SELECT * FROM checkout c JOIN items i ON  c.checkout_product = i.item_id  WHERE c.checkout_reference='$_SESSION[ref]'";
	$checkout_sel_run =  mysqli_query($conn , $checkout_sel_sql);
	while($check_sel_rows  = mysqli_fetch_assoc( $checkout_sel_run)){
		$discounted_price =$check_sel_rows['item_price'] -$check_sel_rows['item_discount'];
		echo "
			<tr>
				<td>$c</td>
				<td>$check_sel_rows[item_title]</td>
				<td>1</td>
				<td><button class='btn btn-danger btn-sm'>Delete</button></td>
				<td class='text-right'><b>$discounted_price/=</b></td>
				<td class='text-right'><b>100/=</b></td>
			</tr>	
		";
		$c++;
	}
						
	?>