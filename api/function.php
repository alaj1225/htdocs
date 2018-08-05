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
}
//完整功能
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
              $code =  -104;//帳密錯誤
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