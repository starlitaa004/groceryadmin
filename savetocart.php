<?php
// array for JSON response
$response = array();

// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for required fields
if(isset($_POST['qty']) && isset($_POST['item_num']) && isset($_POST['ornum']) && isset($_POST['user_id']))
{
	$purchase_qty = $_POST['qty'];
	$item_num = $_POST['item_num'];
	$order_num = $_POST['ornum'];
	$user_id = $_POST['user_id'];

	$getcurrent = mysql_query("UPDATE item SET item_itemonhand = item_itemonhand - $purchase_qty WHERE item_num = $item_num");
	$item = mysql_fetch_assoc($getcurrent);

	// mysql inserting a new row
	$result = mysql_query("INSERT INTO cart(customer_num,or_num,item_num,item_qty)VALUES('$user_id','$order_num','$item_num','$purchase_qty')");

	// check if row inserted or not
	if($result)
	{
		// successfully inserted into database

		$response['success'] = 1;
		$response['message'] = "Oops! An error occurred.";

		// echoing JSON response
        echo json_encode($response);
	}
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

?>