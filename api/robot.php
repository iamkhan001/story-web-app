<?php
 
    $response = array();

    require_once __DIR__ . '/db_connect.php';

    $db = new DB_CONNECT();

    if(!isset($_REQUEST["id"]) || !isset($_REQUEST["req"])){

        $response["success"] = 0;
        $response["message"] = "Provide valid parameters.";

        echo json_encode($response);

        exit(0);
    }
    $req = $_REQUEST['req'];
    $uId = $_REQUEST['id'];
    $result = mysql_query("SELECT role FROM account WHERE id = '$uId' ");

    if (!empty($result)) {
        if (mysql_num_rows($result) > 0) {
            $result = mysql_fetch_array($result);
            if($req=="list"){
                listRobots($uId);
            }else if($req=="add"){

                if(isset($_REQUEST["data"])){
                    addRobot($uId);
                }else{
                    $response["success"] = 0;
                    $response["message"] = "provide data.";
                
                    echo json_encode($response);
                }

            }else{
                $response["success"] = 0;
                $response["message"] = "Invalid Request.";
            
                echo json_encode($response);
            }
        }else{
            $response["success"] = 0;
            $response["message"] = "Permission Denied!";
        
            echo json_encode($response);
        }
    }

    function addRobot($uId){

        $data = json_decode($_REQUEST["data"],true);


        $srNo = $data["sr_no"];

        $result = mysql_query("SELECT id FROM robot WHERE sr_no = '$srNo' ");

        if (!empty($result) && mysql_num_rows($result) > 0){
    
            $response["success"] = 0;
            $response["message"] = "robot already registered";
    
            echo json_encode($response);
    
            exit(0);
        }

        
        $name = $data["name"];
     
        $result = mysql_query("INSERT INTO robot(id,owner_id,sr_no,name,created_date,status) VALUES(null,'$uId','$srNo', '$name', 'CURRENT_TIMESTAMP','1')");

        if ($result) {
    
            $response["success"] = 1;
            $response["message"] = "robot successfully created.";

            echo json_encode($response);
        } else {
        
            $response["success"] = 0;
            $response["message"] = "Oops! An error occurred.";

            echo json_encode($response);
        }
    }

    function listRobots($uId){

        $result = mysql_query("SELECT * FROM robot  WHERE owner_id = $uId");

        if (!empty($result)) {
            
            if (mysql_num_rows($result) > 0) {


                $response["success"] = 1;

                $response["data"] = array();

            
                while ($row = mysql_fetch_array($result)) {
                    $account = array();
                
                    $account["id"] = $row["id"];
                    $account["sr_no"] = $row["sr_no"];
                    $account["name"] = $row["name"];
                    $account["created_at"] = $row["created_date"];
                    $account["status"] = $row["status"];
        
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
        exit(0);
    }

?>