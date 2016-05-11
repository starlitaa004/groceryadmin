<?php
$response = array();

require_once __DIR__ . '/db_connect.php';
$db = new DB_CONNECT();

if(isset($_GET['category'])){
    $category = $_GET['category'];

    if($category == "")
    {
        $result = mysql_query("SELECT *FROM item") or die(mysql_error());
    }
    else{
    $result = mysql_query("SELECT *FROM item WHERE  item_desc LIKE '$category%' OR item_cat LIKE '$category%' OR nutri_facts LIKE '%$category%'") or die(mysql_error());
    }
}
else{
$result = mysql_query("SELECT *FROM item") or die(mysql_error());
}

if (mysql_num_rows($result) > 0) {
    $response["item"] = array();
    
    while ($row = mysql_fetch_array($result)) {
     
        $product = array();
        $product["item_num"] = $row["item_num"];
        $product["item_desc"] = $row["item_desc"];
        $product["item_price"] = $row["item_price"];
        $product["item_expdate"] = $row["item_expdate"];
        $product["item_cat"] = $row["item_cat"];
        $product["nutri_facts"] = $row["nutri_facts"];
        $product["price"] = $row["item_price"];
        $product["itemonhand"] = $row["item_itemonhand"];
        $product["expdate"] = $row["item_expdate"];

        array_push($response["item"], $product);
    }
    
    $response["success"] = 1;
    echo json_encode($response);
} else {
    $response["success"] = 0;
    $response["message"] = "No products found";
    echo json_encode($response);
}

?>
