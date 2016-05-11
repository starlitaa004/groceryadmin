<?php
// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for required fields
if(isset($_POST['ornum']) && isset($_POST['rtype']))
{
	
	$item_ornum = $_POST['ornum'];
	$recieve_type = $_POST['rtype'];
	$dates = date("m-d-Y");
	$stats = "on process";
	// JOINE THE cart and item TABLE to get the price of the item....
	$querycart = mysql_query("SELECT cart.customer_num, cart.item_num, cart.item_qty, item.item_price FROM cart JOIN item ON cart.item_num = item.item_num WHERE cart.or_num = '$item_ornum'");
	$rows = mysql_fetch_assoc($querycart);

	if($rows >= 1)
	{
		$cus_no = $rows['customer_num'];
		do{
		$item_price = $rows['item_price'];
		$item_num = $rows['item_num'];
		$item_qty = $rows['item_qty'];
		$item_subprice = $item_qty * $item_price;

		mysql_query("INSERT INTO order_details(od_orno,od_itemno,od_qty,od_itemprice)VALUES('$item_ornum','$item_num','$item_qty','$item_subprice')");
		}while($rows = mysql_fetch_assoc($querycart));
		
		mysql_query("INSERT INTO order_master(om_orno,om_ordate,om_cusno,om_empno,om_vat)VALUES('$item_ornum','$dates','$cus_no','','')");

		mysql_query("INSERT INTO recievetype(receivetypeNo,receivetype,purchaseddate,receivedate,receivetime,status,deliveredby)
					 VALUES('$item_ornum','$recieve_type','$dates','','','$stats','')");
		// if($result)
		// {
			$response['success'] = 1;
			$response['message'] = "success";

		// echoing JSON response
        echo json_encode($response);

		
		// }
	}else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
}

?>