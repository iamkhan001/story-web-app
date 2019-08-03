<?php


$response = array();

require_once __DIR__ . '/db_connect.php';

$db = new DB_CONNECT();

$result = mysql_query("SELECT * FROM languages");

if (!empty($result)) {
    
    if (mysql_num_rows($result) > 0) {


        $response["success"] = 1;

        $response["data"] = array();

    
        while ($row = mysql_fetch_array($result)) {
            $account = array();
        
            $account["id"] = $row["id"];
            $account["language"] = $row["language"];
            $account["code"] = $row["code"];
           
            array_push($response["data"], $account);
        }

        echo json_encode($response);

    } else {
        
        $response["success"] = 0;
        $response["message"] = "No data found";

        echo json_encode($response);
    }
} else {
    
    $response["success"] = 0;
    $response["message"] = "No data found";

    echo json_encode($response);
}


?>