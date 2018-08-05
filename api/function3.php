<?php
// 本頁分三個部分:
// 1.功能選擇器，每個通能必定傳入一個屬性type，他可能是post也可能是get來取得
// 2.完整功能，對應選擇器的執行功能，全部都是完整流程的功能(如註冊，購買)
// 3.小積木工能，對應完整功能中，某些功能額外提出，作為可重複性使用的功能(如密碼重複檢查，訊息重複)
include_once "database.php";
$pdo = DB_CONNECT();
session_start();
$output = array();
// type的執行有些是POST，有些是GET
$type = @$_POST["type"];
if (empty($type)) {
  $type = @$_GET["type"];
}
//功能選擇器
switch($type){
    case 'sign_up':
        sign_up(@$_GET["email"],@$_GET["password"],@$_GET["factoryID"]);
        break;
    case 'sign_in':
        sign_in(@$_GET["email"],@$_GET["password"]);
        break;
    case 'factory_list':
        factory_list();
        break;
    case 'factory_add':
        factory_add(@$_GET["factoryName"],@$_GET["factoryPhone"],@$_GET["factoryAddress"],@$_GET["factoryNote"]);
        break;
     case 'factory_delete':
        factory_delete(@$_GET["factoryID"]);
        break;
    case 'Product_add':
        Product_add(@$_GET["productName"],@$_GET["factoryShipID"],@$_GET["productCount"],@$_GET["factoryOrderID"]);
        break;
    case 'Product_delete':
        Product_delete(@$_GET["ProductID"],@$_GET["factoryOrderID"]);
        break;
   case 'Product_updata':
        Product_updata(@$_GET["ProductID"],@$_GET["ProductCount"]);
        break;
    case 'Product_list':
        Product_list(@$_GET["factoryID"]);
        break;
}
//完整功能
//會員區塊(1)註冊會員(2)刪除會員
 function sign_up($email,$password,$factoryID){
    global $pdo;
    if(is_empty($email)||is_empty($password)||is_empty($factoryID)){
        $code =  -100;//當有傳入值有為空時
    }else if (email_exist($email)) {
        $code =  -101;//當信箱重複註冊時
    }else if (factory_exist($factoryID)) { 
        $code =  -102;//沒有此廠商時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $token = md5($email).time();
        $sql = "INSERT INTO member(Member_id,Member_account,Member_password,Member_factoryID,Token) VALUES(NULL,'".$email."','".md5($password)."',".$factoryID.",'".$token."')";
        // $sql = "INSERT INTO user(email,password,active,authority,frozen) VALUES('".$email."','".md5($password)."',1,0,0)";

        if ( $pdo -> query($sql) == TRUE) {
           $code =  200;
        }else{
           $code =  -401;
        }
    }
    $output = array('code' => $code,);
    exit(json_encode($output));
    $pdo->close();
    #return $output;
   
 }

function sign_in($email,$password){
    global $pdo;
    if(is_empty($email)||is_empty($password)){
        $code =  -100;//當有傳入值有為空時
        $token= "";
    }else if (!email_exist($email)) {
        $code =  -103;//沒有此信箱
        $token= "";
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    
    if($code>0){
        $password=md5($password);
        $sql = "SELECT *,count(*) total FROM member WHERE Member_account = '".$email."' AND Member_password = '".$password."'";
        if ( $pdo -> query($sql) == TRUE) {
            $rs = $pdo -> query($sql);
            foreach ($rs as $row) { 
                $total = $row["total"]; 
                $token = $row["Token"];
            }
            if ($total > 0) {
              $_SESSION["uid"] = $row["Member_id"];
              $_SESSION["authority"] = $row["Token"];
              $_SESSION["name"] = $row["Member_account"];
              $code =  200;
            }
            else {
              $code =  $password;//帳密錯誤
            }
        }else{
            $code =  -401;//寫入錯誤
        }
    }
    $output = array('code' => $code,
                    'token'=> $token,
                    );
    exit(json_encode($output));
    $pdo->close();
  }

// 廠商區塊 (1)顯示廠商列表(2)新增廠商(3)刪除廠商
function factory_list(){
    global $pdo;
//    if(is_empty($token)){
//        $code =  -100;//當有傳入值有為空時
//    }else{
//        $code =  200;//以上判斷皆沒有問題
//    }
    $code =  200;//以上判斷皆沒有問題
    if($code>0){
        $sql = "SELECT * FROM factory ";
        if ( $pdo -> query($sql) == TRUE) {
            $rs = $pdo -> query($sql);
            $factoryOutput = array();
            foreach ($rs as $row) { 
                $FactoryId = $row["Factory_id"]; 
                $FactoryName = $row["Factory_name"];
                $FactoryPhone = $row["Factory_phone"];
                $FactoryAddress = $row["Factory_address"];
                $FactoryNote= $row["Factory_Note"];
                $factoryDetail = array(
                    'FactoryId' => $FactoryId,
                    'FactoryName'=> $FactoryName,
                    'FactoryPhone'=> $FactoryPhone,
                    'FactoryAddress'=> $FactoryAddress,
                    'FactoryNote'=> $FactoryNote,
                    
                    );
                array_push($factoryOutput,$factoryDetail);
            }
        
        }else{
            $code =  -401;//寫入錯誤
        }
    }
    $output = array('code' => $code,
                    'data'=> $factoryOutput
                    );
    exit(json_encode($output));
    $pdo->close();
  }

 function factory_add($factoryName,$factoryPhone,$factoryAddress,$factoryNote){
    global $pdo;
    if(is_empty($factoryName)){
        $code =  -100;//當有傳入值有為空時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $sql = "INSERT INTO factory(Factory_id,Factory_name,Factory_phone,Factory_address,Factory_Note) VALUES(NULL,'".$factoryName."','".$factoryPhone."','".$factoryAddress."','".$factoryNote."')";
        if ( $pdo -> query($sql) == TRUE) {
           $code =  200;
        }else{
           $code =  -401;
        }
    }
    $output = array('code' => $code,);
    exit(json_encode($output));
    $pdo->close();   
 }
 function factory_delete($factoryID){
    global $pdo;
    if(is_empty($factoryID)){
        $code =  -100;//當有傳入值有為空時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $sql = "DELETE FROM member WHERE Member_factoryID = ".$factoryID;
        $pdo -> query($sql);
        $sql = "DELETE FROM factory WHERE Factory_id = ".$factoryID;
        if ( $pdo -> query($sql) == TRUE) {
           $code =  200;
        }else{
           $code =  -401;
        }
    }
    $output = array('code' => $code,);
    exit(json_encode($output));
    $pdo->close();   
 }

//產品區塊
function Product_add($productName,$factoryShipID,$productCount,$factoryOrderID){
    global $pdo;
    if(is_empty($productName)||is_empty($factoryShipID)||is_empty($productCount)||is_empty($factoryOrderID)){
        $code =  -100;//當有傳入值有為空時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $sql = "INSERT INTO product(Product_id,Product_Name,Factory_Ship_id,Product_count,Factory_Order_id) VALUES(NULL,'".$productName."',".$factoryShipID.",".$productCount.",".$factoryOrderID.")";
        if ( $pdo -> query($sql) == TRUE) {
           $code =  200;
        }else{
           $code =  -401;
        }
    }
    $output = array('code' => $code,);
    exit(json_encode($output));
    $pdo->close();   
 }
function Product_delete($ProductID,$factoryOrderID){
    global $pdo;
    if(is_empty($ProductID)){
        $code =  -100;//當有傳入值有為空時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $sql = "SELECT *,count(*) total FROM product WHERE Product_id = 3 AND Factory_Order_id = 4";
        $rs = $pdo -> query($sql);
        foreach ($rs as $row) {
          $total = $row["total"];            
        }
        if ($total > 0) {
            $sql = "DELETE FROM purchaseitem WHERE purchaseItem_Prouduct_id = ".$ProductID ;
            $pdo -> query($sql);
            $sql = "DELETE FROM orderitem WHERE OrderItem_Prouduct_id = ".$ProductID;
            $pdo -> query($sql);
            $sql = "DELETE FROM product WHERE Product_id = ".$ProductID." AND Factory_Order_id = ".$factoryOrderID;
            if ( $pdo -> query($sql) == TRUE) {
               $code =  200;
            }else{
               $code =  -401;
            }
        }else{
             $code =  -105;
        }
    }
    $output = array('code' => $code,);
    exit(json_encode($output));
    $pdo->close();   
 }

function Product_updata($ProductID,$ProductCount){
    global $pdo;
    if(is_empty($ProductID)||is_empty($ProductCount)){
        $code =  -100;//當有傳入值有為空時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $sql = "SELECT *,count(*) total FROM product WHERE Product_id = ".$ProductID;
        $rs = $pdo -> query($sql);
        foreach ($rs as $key => $row) {
            $total = $row["total"];
            $count = $row["Product_count"];
            
        }
        if ($total > 0&&$count-$ProductCount>=0) {
            $sql = "UPDATE product SET Product_count = Product_count -".$ProductCount." WHERE Product_id = ".$ProductID ;
            if ( $pdo -> query($sql) == TRUE) {
               $code =  200;
            }else{
               $code =  -401;
            }
        }else{
             $code =  -105;
        }
    }
    $output = array('code' => $code,);
    exit(json_encode($output));
    $pdo->close();   
 }
function Product_list($factoryID){
    global $pdo;
    if(is_empty($factoryID)){
        $code =  -100;//當有傳入值有為空時
    }else{
        $code =  200;//以上判斷皆沒有問題
    }
    if($code>0){
        $sql = "SELECT * FROM product ";
        if ( $pdo -> query($sql) == TRUE) {
            $rs = $pdo -> query($sql);
            $factoryOutput = array();
            foreach ($rs as $row) { 
                $Productid = $row["Product_id"]; 
                $ProductName = $row["Product_name"];
                $FactoryShipId = $row["Factory_Ship_id"];
                $ProductCount = $row["Product_count"];
                $FactoryOrderId= $row["Factory_Order_id"];
                $factoryDetail = array(
                    'Product_id' => $Productid,
                    'Product_name'=> $ProductName,
                    'Factory_Ship_id'=> $FactoryShipId,
                    'Product_count'=> $ProductCount,
                    'Factory_Order_id'=> $FactoryOrderId,
                    
                    );
                array_push($factoryOutput,$factoryDetail);
            }
        
        }else{
            $code =  -401;//寫入錯誤
        }
    }
    $output = array('code' => $code,
                    'data'=> $factoryOutput
                    );
    exit(json_encode($output));
    $pdo->close();
  }
//小積木工能
 function is_empty($variable){
    if (empty($variable)) { return true; }
  }
 function email_exist($email){
    global $pdo;
    $sql = "SELECT count(*) total FROM member WHERE member_account = '".$email."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) { return true; }
  }
function factory_exist($factoryID){
    global $pdo;
    $sql = "SELECT count(*) total FROM factory WHERE Factory_id = '".$factoryID."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total == 0) { return true; }
  }

?>