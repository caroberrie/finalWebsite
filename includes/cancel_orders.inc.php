<?php
mysqli_query($link, "SET AUTOCOMMIT = 0");
$select_beautys = "SELECT beautys_id, quantity from beauty_orders_beautys WHERE beauty_orders_id = $beauty_orders_id";
$exec_select_beautys = @mysqli_query($link, $select_beautys);
if(!$exec_select_beautys){
	rollback('Ordered beautys could not be retrieved becase '.mysqli_error($link));
}else{
	while($one_record = mysqli_fetch_assoc($exec_select_beautys)){
		$quantity = $one_record['quantity'];
		$beautys_id = $one_record['beautys_id'];
		$update_beautys = "UPDATE beautys set stock_quantity = (stock_quantity+$quantity) WHERE beautys_id = $beautys_id";
		$exec_update_beautys = @mysqli_query($link, $update_beautys);
		if(!$exec_select_beautys){
			rollback('Update was not successful becase '.mysqli_error($link));
		}
	}
	$delete_order = "DELETE beauty_shipping_addresses.*, beauty_billing_addresses.*, beauty_transactions.* FROM beauty_orders 
	INNER JOIN beauty_billing_addresses USING (beauty_billing_addresses_id)
	INNER JOIN beauty_shipping_addresses USING (beauty_shipping_addresses_id)
	INNER JOIN beauty_transactions USING (beauty_transactions_id)
	WHERE beauty_orders_id = $beauty_orders_id";
	$exec_delete_order = @mysqli_query($link, $delete_order);
	if(!$exec_delete_order){
		rollback('Delete was not successful becase '.mysqli_error($link));
	}else{
		mysqli_query($link, "COMMIT");
		redirect('successfully deleted...', 'view_current_orders.php', 1);
	}	
}
?>