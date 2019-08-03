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
                listActions($uId);
            }else if($req=="add"){

                if(isset($_REQUEST["data"])){
                    addAction($uId);
                }else{
                    $response["success"] = 0;
                    $response["message"] = "provide data.";
                
                    echo json_encode($response);
                }

            }else if($req=="update"){

                if(isset($_REQUEST["data"])){
                    updateAction($uId);
                }else{
                    $response["success"] = 0;
                    $response["message"] = "provide data.";
                
                    echo json_encode($response);
                }

            }else if($req=="action"){

                if(isset($_REQUEST["robot_id"])){
                    listMyActions($uId);
                }else{
                    $response["success"] = 0;
                    $response["message"] = "provide robo id.";
                
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

    function addAction($uId){

        $data = json_decode($_REQUEST["data"],true);

        $roboId = $data["robot_id"];

        $result = mysql_query("SELECT * FROM robot WHERE id = '$roboId' ");

        if (empty($result) || mysql_num_rows($result) == 0){
    
            $response["success"] = 0;
            $response["message"] = "robot not exist";
    
            echo json_encode($response);
    
            exit(0);
        }

        $location1 = $data["location_1"];
        $location2 = $data["location_2"];
        $timeStart = $data["time_start"];
        $timeEnd = $data["time_end"];
        $goHome = $data["go_home"];
        $action = $data["action"];
        $lang = $data["lang"];

        $q = "INSERT INTO action(id,owner_id,robot_id,location_1,location_2,time_start,time_end,go_home,action,lang,status)
        VALUES
        (null,'$uId','$roboId', '$location1','$location2','$timeStart', '$timeEnd', '$goHome', '$action', '$lang', '1')";

        $result = mysql_query($q);

        if ($result) {
    
            $response["success"] = 1;
            $response["message"] = "Action successfully created.";

            echo json_encode($response);
        } else {
        
            $response["success"] = 0;
            $response["query"] = $q;
            $response["message"] = "Oops! An error occurred.";

            echo json_encode($response);
        }
    }

    function updateAction($uId){

        $data = json_decode($_REQUEST["data"],true);

        $roboId = $data["robot_id"];

        $result = mysql_query("SELECT * FROM robot WHERE id = '$roboId' ");

        if (empty($result) || mysql_num_rows($result) == 0){
    
            $response["success"] = 0;
            $response["message"] = "robot not exist";
    
            echo json_encode($response);
    
            exit(0);
        }

        $aId = $data["action_id"];

        $result = mysql_query("SELECT * FROM action WHERE id = '$aId' ");

        if (empty($result) || mysql_num_rows($result) == 0){
    
            $response["success"] = 0;
            $response["message"] = "Invalid Request";
    
            echo json_encode($response);
    
            exit(0);
        }

        $location1 = $data["location_1"];
        $location2 = $data["location_2"];
        $timeStart = $data["time_start"];
        $timeEnd = $data["time_end"];
        $goHome = $data["go_home"];
        $action = $data["action"];
        $lang = $data["lang"];

        $q = "UPDATE `action` SET" 
                        ."`robot_id` = '$roboId', "
                        ."`location_1` = '$location1', "
                        ."`location_2` = '$location2', "
                        ."`time_start` = '$timeStart', "
                        ."`time_end` = '$timeEnd', "
                        ."`go_home` = '$goHome', "
                        ."`action` = '$action', "
                        ."`lang` = '$lang'"
                    ." WHERE `action`.`id` = 1";

        $result = mysql_query($q);

        if ($result) {
    
            $response["success"] = 1;
            $response["message"] = "Action successfully updated.";

            echo json_encode($response);
        } else {
        
            $response["success"] = 0;
            $response["query"] = $q;
            $response["message"] = "Oops! An error occurred.";

            echo json_encode($response);
        }
    }


    function listActions($uId){

        $result = mysql_query("SELECT * FROM action WHERE id = $uId" );

        if (!empty($result)) {
            
            if (mysql_num_rows($result) > 0) {


                $response["success"] = 1;

                $response["data"] = array();

            
                while ($row = mysql_fetch_array($result)) {
                    $account = array();
                
                    $account["id"] = $row["id"];
                    $account["robot_id"] = $row["robot_id"];
                    $account["location_1"] = $row["location_1"];
                    $account["location_2"] = $row["location_2"];
                    $account["time_start"] = $row["time_start"];
                    $account["time_end"] = $row["time_end"];
                    $account["go_home"] = $row["go_home"];
                    $account["action"] = $row["action"];
                    $account["lang"] = $row["lang"];
        
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

    function listMyActions($uId){


        $roboId = $_REQUEST["robot_id"];

        $result = mysql_query("SELECT * FROM robot WHERE id = '$roboId' ");

        if (empty($result) || mysql_num_rows($result) == 0){
    
            $response["success"] = 0;
            $response["message"] = "robot not exist";
    
            echo json_encode($response);
    
            exit(0);
        }


        $result = mysql_query("SELECT * FROM action WHERE owner_id = '$uId' AND robot_id = '$roboId'" );

        if (!empty($result)) {
            
            if (mysql_num_rows($result) > 0) {


                $response["success"] = 1;

                $response["data"] = array();

            
                while ($row = mysql_fetch_array($result)) {
                    $account = array();
                
                    $account["id"] = $row["id"];
                    $account["robot_id"] = $row["robot_id"];
                    $account["location_1"] = $row["location_1"];
                    $account["location_2"] = $row["location_2"];
                    $account["time_start"] = $row["time_start"];
                    $account["time_end"] = $row["time_end"];
                    $account["go_home"] = $row["go_home"];
                    $account["action"] = $row["action"];
                    $account["lang"] = $row["lang"];
        
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