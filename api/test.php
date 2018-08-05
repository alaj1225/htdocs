<?php
    include_once "database.php";
    $output = array();
    $account = @$_GET['account'] ? $_GET['account'] : '';
    $password = @$_GET['password'] ? $_GET['password'] : '';
    $factoryID= @$_GET['factoryID'] ? $_GET['factoryID'] : '';

    $conn = DB_CONNECT();
    insertProduct();
  // Create connection
    function insertProduct(){
            global  $conn;
            global  $account;
            global  $password;
            global  $factoryID;
        
            $insert_sql = "INSERT INTO member (Member_id, Member_account,Member_password,Member_factoryID,Token) VALUES (NULL, '".$account."','".$password."',".$factoryID.",'adsfasdfhjoijewiorjqpoiwjeirjweoijriowjer')";
            #$result = $conn->query($insert_sql);
            if ( $conn->query($insert_sql) === TRUE) {
                $output = array(
                        'code' => 200, //成功代碼
                    );
            }else {
                $output = array(
                        'code' => -401, //失敗代碼
                        );

            }
            exit(json_encode($output));
            $conn->close();
        return $output;
    }
// Check connection
?>

