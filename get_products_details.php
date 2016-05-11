<?php

/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */

// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();

// check for post data
if (isset($_GET["item_num"])) {
    $item_num = $_GET['item_num'];

    // get a product from products table
    $result = mysql_query("SELECT * FROM item WHERE item_num = '$item_num'");

    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {

            $result = mysql_fetch_array($result);

            $product = array();
            $product["item_num"] = $result["item_num"];
            $product["item_desc"] = $result["item_desc"];
            $product["item_price"] = $result["item_price"];
            $product["item_qty"] = $result["item_itemonhand"];
            $product["item_unit"] = $result["item_unit"];
            $product["item_expdate"] = $result["item_expdate"];
            // success
            $response["success"] = 1;

            // user node
            $response["item"] = array();

            array_push($response["item"], $product);

            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No product found";

        // echo no users JSON
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