<?php
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
$insert_sql = "INSERT INTO member (Member_id, Member_account,Member_password,Member_factoryID,Token) VALUES (NULL, 'aaaaaa','123',2,'adsfasdfhjoijewiorjqpoiwjeirjweoijriowjer')";

#$result = $conn->query($insert_sql);

if ($conn->query($insert_sql) === TRUE) {
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
?>

