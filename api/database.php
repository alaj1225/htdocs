<?php
    function DB_CONNECT(){
        $servername = "localhost";
        $username = "test123";
        $password = "1234";
        $dbname = "wms";
        $output = array();
        $uuid = @$_GET['uuid'] ? $_GET['uuid'] : '';

          // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    } 
//        try{
//        $servername = "localhost";
//        $username = "test123";
//        $password = "1234";
//        $dbname = "wms";
//      // Create connection
//        $conn = new mysqli($servername, $username, $password, $dbname);
//        // Check connection
//        return $conn;
//        }catch{
//            die("Could not connect to the database: " . $pe->getMessage());
//        }
    
    function _log($msg)
    {
        $pdo = DB_CONNECT();
        $sql = "INSERT INTO log(message,logtime)VALUES('".$msg."',NOW())";
        $pdo -> query($sql);
    }
?>

