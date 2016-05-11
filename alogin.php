	<?php
// array for JSON response
$response = array();


// include db connect class
require_once __DIR__ . '/db_connect.php';

// connecting to db
$db = new DB_CONNECT();
if(isset($_POST['username']) && isset($_POST['password']))
{
	$user = $_POST['username'];
	$pass = $_POST['password'];

	$result = mysql_query("SELECT * FROM useraccount WHERE uname = '$user' AND pword = '$pass'");
	$rows = mysql_num_rows($result);
	
		if($rows == 1)
		{
			$results = mysql_fetch_array($result);

			$credentials = array();
			$credentials['userid'] = $results['user_id'] ;
			$credentials['username'] = $results['uname'];
			$credentials['password'] = $results['pword'];
			 // success
            $response["success"] = 1;

            // user node
            $response["logincredentials"] = array();

            array_push($response["logincredentials"], $credentials);
            echo json_encode($response);
		}else{
			// no product found
            $response["success"] = 0;
            $response["message"] = "No Credentials Foundssss";

            // echo no users JSON
            echo json_encode($response);
		}
	
}else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Credentials is missing";

    // echoing JSON response
    echo json_encode($response);
}

?>