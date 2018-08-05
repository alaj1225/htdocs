<?php
// 本頁分三個部分:
// 1.功能選擇器，每個通能必定傳入一個屬性type，他可能是post也可能是get來取得
// 2.完整功能，對應選擇器的執行功能，全部都是完整流程的功能(如註冊，購買)
// 3.小積木工能，對應完整功能中，某些功能額外提出，作為可重複性使用的功能(如密碼重複檢查，訊息重複)
include_once "../lib/database.php";
$pdo = DB_CONNECT();
session_start();
// type的執行有些是POST，有些是GET
$type = @$_POST["type"];
if (empty($type)) {
  $type = @$_GET["typde"];
}
// 印出執行動作
// echo $type;
// 1.功能選擇器
  // sign_up-註冊
  // active_account 開通帳號
  // update_account-更新個人帳戶資料
  // updateaccount_password_only-更新個人帳戶的密碼
  // sign_in-登入
  // sign_out-登出
  // freeze_account-凍結帳號
  // unfreeze_account-解凍帳號
  // delete_account-刪除帳號
  // forget_password-忘記密碼
  // banner_img_edit-跑馬燈圖片
  // new_size-新增尺寸(老東西)
  // new_color-新增顏色(老東西)
  // update_size-更新尺寸(老東西)
  // update_color-更新顏色(老東西)
  // delete_size-刪除尺寸(老東西)
  // delete_color-刪除顏色(老東西)
  // admin_delete_cart-刪除整台購物車(管理員執行)
  // product_new_size-新增特定商品尺寸(新)
  // product_new_color-新增特定商品顏色(新)
  // product_update_size-更新特定商品尺寸(新)
  // product_update_color-更新特定商品顏色(新)
  // product_delete_size-刪除特定商品尺寸(新)
  // product_delete_color-刪除特定商品顏色(新)
  // product_update_normal-更新特定商品基本資料(新)
  // product_update_img-更新特定商品圖片(新)
  // product_update_normal-更新特定商品基本資料(新)
  // product_update_content-更新特定商品內文
  // new_product-新增商品
  // delete_product-刪除商品
  // update_classic9-更改經典
  // add_cart-新增至購物車(如果目前沒有任何購物車，就會先新增一輛，功能屬於積木區)
  // delete_cart_product-刪除購物車物品
  // delete_unpaid-刪除孤兒訂單
  // pay_cart-支付購物車，生成訂單
  // order_send-傳送參數到綠界進行提交作業
  // order_send_finish-把訂單物品寄出去後，設置成已經寄出
switch ($type) {
  case 'sign_up':
    sign_up(@$_POST["email"],@$_POST["password"],@$_POST["password2"],@$_POST["name"],@$_POST["phone"],@$_POST["sex"],@$_POST["address"],@$_POST["postcode"]);
    break;
  case 'active_account':
    active_account(@$_GET["email"],@$_GET["activecode"]);
    break;
  case 'update_account':
    update_account(@$_POST["name"],@$_POST["password"],@$_POST["email"],@$_POST["phone"],@$_POST["postcode"],@$_POST["address"],@$_POST["sex"]);
    break;
  case 'sign_in':
    sign_in(@$_POST["email"],@$_POST["password"]);
    break;
  case 'sign_out':
    sign_out();
    break;
  case 'freeze_account':
    freeze_account(@$_GET["id"]);
    break;
  case 'unfreeze_account':
    unfreeze_account(@$_GET["id"]);
    break;
  case 'delete_account':
    delete_account(@$_GET["id"]);
    break;
  case 'shopping_point':
    shopping_point(@$_GET["id"],@$_POST["shopping_point"]);
    break;
  case 'paying_rate':
    paying_rate(@$_GET["id"],@$_POST["paying_rate"]);
    break;
  case 'forget_password':
    forget_password(@$_POST["email"]);
    break;
  case 'banner_img_edit':
    banner_img_edit();
    break;
  case 'product_new_size':
    product_new_size(@$_POST["pid"],@$_POST["size"]);
    break;
  case 'product_new_color':
    product_new_color(@$_POST["pid"],@$_POST["color"]);
    break;
  case 'product_update_size':
    product_update_size(@$_POST["id"],@$_POST["size"],@$_POST["pid"]);
    break;
  case 'product_update_color':
    product_update_color(@$_POST["id"],@$_POST["color"],@$_POST["pid"]);
    break;
  case 'product_delete_size':
    product_delete_size(@$_GET["id"],@$_GET["pid"]);
    break;
  case 'product_delete_color':
    product_delete_color(@$_GET["id"],@$_GET["pid"]);
    break;
  case 'admin_delete_cart':
    admin_delete_cart(@$_GET["cid"]);
    break;
  case 'product_update_normal':
    product_update_normal(@$_POST["id"],@$_POST["name"],@$_POST["product_no"],@$_POST["price"],@$_POST["group"],@$_POST["show_gif_new"],@$_POST["show_gif_lovely"],@$_POST["show_gif_top"],@$_POST["show_gif_sale"],@$_POST["show_gif_hot"],@$_POST["stock"]);
    break;
  case 'product_update_content':
    product_update_content(@$_GET["id"],@$_POST["content"]);
    break;
  case 'product_update_img':
    product_update_img(@$_POST["id"]);
    break;
    // 老功能(共用選項將不再啟動，為了避免客人出爾反爾，此程式碼將暫時保留)
  case 'new_size':
    new_size(@$_POST["size"]);
    break;
    // 老功能(共用選項將不再啟動，為了避免客人出爾反爾，此程式碼將暫時保留)
  case 'new_color':
    new_color(@$_POST["color"]);
    break;
    // 老功能(共用選項將不再啟動，為了避免客人出爾反爾，此程式碼將暫時保留)
  case 'update_size':
    update_size(@$_POST["size"],@$_POST["sid"]);
    break;
    // 老功能(共用選項將不再啟動，為了避免客人出爾反爾，此程式碼將暫時保留)
  case 'update_color':
    update_color(@$_POST["color"],@$_POST["cid"]);
  break;
    // 老功能(共用選項將不再啟動，為了避免客人出爾反爾，此程式碼將暫時保留)
  case 'delete_size':
    delete_size(@$_GET["sid"]);
    break;
    // 老功能(共用選項將不再啟動，為了避免客人出爾反爾，此程式碼將暫時保留)
  case 'delete_color':
    delete_color(@$_GET["cid"]);
    break;
  case 'new_product':
    new_product(@$_POST["name"],@$_POST["product_no"],@$_POST["price"],@$_POST["original_price"],@$_POST["group"],@$_POST["color"],@$_POST["size"],@$_POST["show_gif_new"],@$_POST["show_gif_lovely"],@$_POST["show_gif_top"],@$_POST["show_gif_sale"],@$_POST["show_gif_hot"],@$_POST["content"],@$_POST["stock"]);
    break;
  // 此功能需要部分修改
  case 'delete_product':
    delete_product(@$_GET["id"]);
    break;
  case 'update_classic9':
    update_classic9(@$_POST["classic1"],@$_POST["classic2"],@$_POST["classic3"],@$_POST["classic4"],@$_POST["classic5"],@$_POST["classic6"],@$_POST["classic7"],@$_POST["classic8"],@$_POST["classic9"],@$_POST["classic10"],@$_POST["classic11"],@$_POST["classic12"]);
    break;
  case 'update_weekbest':
    update_weekbest(@$_POST["weekbest1"],@$_POST["weekbest2"],@$_POST["weekbest3"],@$_POST["weekbest4"],@$_POST["weekbest5"],@$_POST["weekbest6"]);
    break;
  case 'add_cart':
    add_cart(@$_POST["pid"],@$_POST["color"],@$_POST["size"],@$_SESSION["uid"],@$_POST["amount"],@$_POST["go_cart"]);
    break;
  case 'add_cart_by_preorder':
    add_cart_by_preorder(@$_GET["preid"]);
    break;
  case 'delete_cart_product':
    delete_cart_product(@$_GET["pid"]);
    break;
  case 'delete_preorder_product':
    delete_preorder_product(@$_GET["pid"]);
    break;
  case 'delete_unpaid':
    delete_unpaid(@$_GET["id"]);
    break;
  case 'cart_pay':
    cart_pay(@$_POST["order_name"],@$_POST["order_phone"],@$_POST["order_address"],@$_POST["order_postcode"],@$_POST["take_type"],@$_POST["take_name"],@$_POST["take_phone"],@$_POST["take_address"],@$_POST["take_postcode"],@$_POST["take_time"],@$_POST["note"],@$_POST["recipe"],@$_POST["donate_recipe"],@$_POST["CVSStoreName"],@$_POST["CVSAddress"],@$_POST["CVSStoreID"]);
    break;
  case 'pay_finish':
    pay_finish();
    break;
  case 'order_send':
    order_send(@$_GET["oid"]);
    break;
  case 'order_send_finish':
    order_send_finish(@$_GET["oid"]);
    break;
  case 'order_change':
    order_change(@$_GET["oid"],@$_GET["statues"],@$_GET["ori"]);
    break;
  case 'order_paid':
    order_paid(@$_GET["oid"]);
    break;
  case 'order_paid':
    order_paid(@$_GET["oid"]);
    break;
  case 'updateaccount_password_only':
    updateaccount_password_only(@$_POST["old_password"],@$_POST["new_password"],@$_POST["new_password2"]);
    break;
  default:
    echo "請透過正常管道進入本頁面";
    break;
}


//2.完整功能
  // sign_up-註冊
  function sign_up($email,$password,$password2,$name,$phone,$sex,$address,$postcode){
    global $pdo;
    if (is_empty($email)) { echo "<script>alert('請填寫信箱。');history.go(-1);</script>";die(); }
    if (email_exist($email)) { echo "<script>alert('請信箱已經被使用。');history.go(-1);</script>";die(); }
    if (is_empty($password)) { echo "<script>alert('請填寫密碼。');history.go(-1);</script>";die(); }
    if (!(password_confirm($password,$password2))) { echo "<script>alert('密碼和確認密碼欄位需相同。');history.go(-1);</script>";die(); }
    if (!(strlen_check($password))) { echo "<script>alert('密碼需要介於6-20碼。');history.go(-1);</script>";die(); }
    if (is_empty($name)) { echo "<script>alert('請填寫姓名。');history.go(-1);</script>";die(); }
    if (is_empty($phone)) { echo "<script>alert('請填寫電話。');history.go(-1);</script>";die(); }
    // if (!(phone_check($phone))) { echo "<script>alert('請確實填寫電話。');history.go(-1);</script>";die(); }
    if (is_empty($sex)) { echo "<script>alert('請選取性別。');history.go(-1);</script>";die(); }
    if ($sex != "男" && $sex != "女") { echo "<script>alert('請選擇網站提供的性別選項。');history.go(-1);</script>";die(); }
    if (is_empty($address)) { echo "<script>alert('請填寫地址。');history.go(-1);</script>";die(); }
    if (is_empty($postcode)) { echo "<script>alert('請填寫郵遞區號。');history.go(-1);</script>";die(); }
    $activecode = md5($email).time();
    $sql = "INSERT INTO user(email,password,active,authority,frozen,activecode) VALUES('".$email."','".md5($password)."',0,0,0,'".$activecode."')";
    // $sql = "INSERT INTO user(email,password,active,authority,frozen) VALUES('".$email."','".md5($password)."',1,0,0)";
    $pdo -> query($sql);
    $uid = $pdo ->lastInsertId();
    $sql = "INSERT INTO user_info(uid,name,sex,phone,address,postcode) VALUES(".$uid.",'".$name."','".$sex."','".$phone."','".$address."','".$postcode."')";
    $pdo -> query($sql);
    // 包含網站路徑
    include_once "../ECPAY/route.php";
    //寄信內容(屏蔽內容為暫時關閉開通認證，網站網址也還沒確定)
    $accepter = $name;//收件者名字
    $title = "您好,".$name."先生/小姐，您在Gracekr註冊完成只差此開通信件。";
    $content = "您好，您已完成註冊Gracekr，請點選以下連結進行帳號開通:<br>
                ".$route."/backend/function.php?type=active_account&email=".$email."&activecode=".$activecode;
    mailsend($email,$accepter,$title,$content);
    echo "<script>alert('註冊成功，請到信箱開通帳號後進行登入。如果沒有收到信件，請至垃圾信箱留意，或是耐心等待五分鐘。');location.href='../index.php';</script>";
    // echo "<script>alert('註冊成功。');location.href='../index.php';</script>";
  }
  // active_account-開通帳號
  function active_account($email,$activecode){
    global $pdo;
    // 只限定沒有開通的帳號
    $sql = "SELECT count(*) total,active FROM 00user_full_list WHERE email = '".$email."' AND activecode = '".$activecode."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
      $active = $row["active"];
    }
    if ($active == 1) {
      echo "<script>alert('您已完成開通驗證，直接登入即可。');location.href='../index.php';</script>";
    }
    else if ($total == 0) {
      echo "<script>alert('請透過合法手段進入該網站，或是該連結已經失效。');location.href='../index.php';</script>";
    }
    else {
    $sql2 = "UPDATE user SET active = 1 WHERE email = '".$email."'";
    $pdo -> query($sql2);
    // 直接設立成登入狀態的session(這邊比較醜)
    // 直接預設為登入狀態
    $sql = "SELECT *,count(*) total FROM 00user_full_list WHERE email = '".$email."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) {
      $_SESSION["uid"] = $row["id"];
      $_SESSION["authority"] = $row["authority"];
      $_SESSION["name"] = $row["name"];
    }
    echo "<script>alert('開通成功，歡迎來到gracekr。');location.href='../index.php';</script>";
    }
  }
  // update_account-更新個人資料
  function update_account($name,$password,$email,$phone,$postcode,$address,$sex){
    if (is_empty($name)) { echo "<script>alert('請填寫姓名。');history.go(-1);</script>";die(); }
    if (is_empty($phone)) { echo "<script>alert('請填寫電話。');history.go(-1);</script>";die(); }
    if (is_empty($address)) { echo "<script>alert('請填寫地址。');history.go(-1);</script>";die(); }
    if (is_empty($postcode)) { echo "<script>alert('請填寫郵遞區號。');history.go(-1);</script>";die(); }
    global $pdo;
    $sql = "SELECT *,count(*) total FROM 00user_full_list WHERE id = '".$_SESSION["uid"]."' AND password = '".md5($password)."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) {
      $sql2 = "UPDATE user_info SET name='".$name."' , phone = '".$phone."' , address= '".$address."' , postcode = ".$postcode." , sex = '".$sex."' WHERE id=".$_SESSION["uid"];
      $pdo -> query($sql2);
      echo "<script>alert('更改成功。');location.href='../index.php?page=member2';</script>";die();
    }
    else {
      echo "<script>alert('密碼錯誤，請重新操作');history.go(-1);</script>";die();
    }
  }
  // updateaccount_password_only-更新個人帳戶密碼
  function updateaccount_password_only($old,$password,$password2){
    if (is_empty($password)) { echo "<script>alert('請填寫新密碼。');history.go(-1);</script>";die(); }
    if (!(password_confirm($password,$password2))) { echo "<script>alert('新密碼和確認密碼欄位需相同。');history.go(-1);</script>";die(); }
    if (!(strlen_check($password))) { echo "<script>alert('新密碼需要介於6-20碼。');history.go(-1);</script>";die(); }
    global $pdo;
    $sql = "SELECT *,count(*) total FROM 00user_full_list WHERE id = ".$_SESSION["uid"]." AND password = '".md5($old)."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) {
      $sql2 = "UPDATE user SET password = '".md5($password)."' WHERE id =".$_SESSION["uid"];
      $pdo -> query($sql2);
      echo "<script>alert('更改成功，下次登入請使用新密碼。');location.href='../index.php?page=member';</script>";die();
    }
    else {
      echo "<script>alert('舊密碼錯誤，請重新操作');history.go(-1);</script>";die();
    }
  }
  // sign_in-登入
  function sign_in($email,$password){
    global $pdo;
    if (is_empty($email)) { echo "<script>alert('請填寫信箱。');history.go(-1);</script>";die(); }
    if (is_empty($password)) { echo "<script>alert('請填寫密碼。');history.go(-1);</script>";die(); }
    if (!(email_exist($email))) { echo "<script>alert('該信箱帳號沒有被註冊。');history.go(-1);</script>";die(); }
    if (frozen_check($email)) { echo "<script>alert('帳號被凍結，請聯絡管理人員。');history.go(-1);</script>";die(); }
    if (!(active_check($email))) { echo "<script>alert('該帳號尚未開通，請到信箱確認。');history.go(-1);</script>";die(); }
    $sql = "SELECT *,count(*) total FROM 00user_full_list WHERE email = '".$email."' AND password = '".md5($password)."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) {
      $_SESSION["uid"] = $row["id"];
      $_SESSION["authority"] = $row["authority"];
      $_SESSION["name"] = $row["name"];
      // 更新登入最後的時間(用來檢查購物車狀態)
      $sql = "UPDATE user SET last_login = NOW() WHERE id =".$row["id"];
      $pdo -> query($sql);
      // 最高權限管理員導向另外一個頁面
      if ($_SESSION["authority"] == 1) { echo "<script>alert('即將以最高權限管理員進行登入。');location.href='../admin_index.php';</script>";die(); }
      // 否則就到一班會員頁面
      echo "<script>alert('登入成功。');location.href='../index.php';</script>";die();
    }
    else {
      echo "<script>alert('信箱或密碼錯誤');history.go(-1);</script>";die();
    }
  }
  // sign_out-登出
  function sign_out(){
    UNSET($_SESSION["uid"]);
    UNSET($_SESSION["authority"]);
    UNSET($_SESSION["name"]);
    echo "<script>alert('登出完畢。');location.href='../index.php';</script>";
    header("location:../index.php");
  }
  // freeze_account-凍結帳號
  function freeze_account($id){
    global $pdo;
    $sql = "UPDATE user SET frozen = 1 WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('帳號凍結完成');history.go(-1);</script>";die();
  }
  // unfreeze_account-解凍帳號
  function unfreeze_account($id){
    global $pdo;
    $sql = "UPDATE user SET frozen = 0 WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('帳號解凍完成');history.go(-1);</script>";die();
  }
  // shopping_point-改購物金
  function shopping_point($id,$shopping_point){
    if (is_empty($shopping_point)) {
      // empty包括0，所以要設置例外，如果是空又不是0，那就是空了
      if ($shopping_point != 0) {
        { echo "<script>alert('欄位不可為空。');location.href='../admin_user.php';</script>";die(); }
      }
    }
    global $pdo;
    $sql = "UPDATE user SET shopping_point = ".$shopping_point." WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('更改成功。');location.href='../admin_user.php';</script>";die();
  }
  // paying_rate-打折變化
  function paying_rate($id,$paying_rate){
    if (is_empty($paying_rate)) { echo "<script>alert('欄位不可為空。');location.href='../admin_user.php';</script>";die(); }
    global $pdo;
    $sql = "UPDATE user SET paying_rate = ".$paying_rate." WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('更改成功。');location.href='../admin_user.php';</script>";die();
  }
  // delete_account-刪除帳號
  function delete_account($id){
    global $pdo;
    $sql = "DELETE FROM user WHERE id = ".$id;
    $pdo -> query($sql);
    $sql = "DELETE FROM user_info WHERE uid = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('帳號刪除完成');history.go(-1);</script>";die();
  }
  // forget_password-忘記密碼
  function forget_password($email){
    if (is_empty($email)) { echo "<script>alert('請填寫信箱。');history.go(-1);</script>";die(); }
    if (!(email_exist($email))) { echo "<script>alert('該信箱帳號沒有被註冊。');history.go(-1);</script>";die(); }
    else {
      global $pdo;
      $sql2 = "SELECT * FROM 00user_full_list WHERE email='".$email."'";
      $rs2 = $pdo -> query($sql2);
      foreach ($rs2 as $key => $row2) {
        $name = $row2["name"];
      }
      $pass_casual = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
      $sql = "UPDATE user SET password = '".md5($pass_casual)."' WHERE email = '".$email."'";
      $pdo -> query($sql);
      $accepter = $name;//收件者名字
      $title = "您好,".$name."先生/小姐，此封信件為臨時的密碼。";
      $content = "以下為您的帳號".$email."在Gracekr的臨時密碼，請在登入後立刻修改密碼:<br>
                  ".$pass_casual;
      mailsend($email,$accepter,$title,$content);
      echo "<script>alert('臨時用密碼已經寄送到您的信箱，請登入後更改密碼。如果沒有收到信件，請至垃圾信箱留意，或是耐心等待五分鐘。');location.href='../index.php';</script>";
    }
  }
  // banner_img_edit-跑馬燈圖片修改
  function banner_img_edit(){
    // 目前只有五筆跑馬燈可以執行
    $order_line = 1;
    while ($order_line < 6) {
      $x = "img".$order_line; //串字串，用來抓取name的命名
      $file = $_FILES[$x]; //打檔案代碼讀取化
        global $pdo;
          if (is_empty($file['name'])) { echo "這張沒有換圖片"; }
          else {
            $old_img_root = find_old_img_for_banner($order_line); // 先找出舊的圖片路徑，該步驟會回傳舊圖片的路徑
            delete_old_img($old_img_root); // 刪除舊的圖片
            $img_root = "../img/banner/"; //用於存放新的圖片路徑
            $img_show = "img/banner/"; //用於顯示新圖片的路徑
            // 下面是執行新檔案上傳的同時，最後會回傳一個"顯示用"的路徑
            $new_img_root = upload_new_img($file,$order_line,$img_root,$img_show);
            // 更新顯示路徑，是給banner專用的
            new_img_root_for_banner($new_img_root,$order_line);
          }
      $order_line = $order_line + 1;
    }
  echo "<script>alert('banner圖片更新完成。');location.href='../admin_banner.php';</script>";die();
  }
  // product_new_size-新增特定商品尺寸(新東西，編寫中)
  function product_new_size($pid,$size){
    if (is_empty($size)) { echo "<script>alert('欄位不可為空');history.go(-1);</script>";die(); }
    global $pdo;
    $sql = "SELECT count(*) total FROM product_size_new WHERE size_name = '".$size."' AND product_id=".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total > 0) {
      echo "<script>alert('這個商品已經有這個尺寸了。');location.href='../admin_product_edit.php?id=".$pid."';</script>";die();
    }
    else {
      $sql = "INSERT INTO product_size_new (product_id,size_name) VALUES (".$pid.",'".$size."')";
      $pdo -> query($sql);
      echo "<script>alert('尺寸新增完成。');location.href='../admin_product_edit.php?id=".$pid."';</script>";die();
    }
  }
  // product_new_color-新增特定商品顏色(新東西，編寫中)
  function product_new_color($pid,$color){
    if (is_empty($color)) { echo "<script>alert('欄位不可為空');history.go(-1);</script>";die(); }
    global $pdo;
    $sql = "SELECT count(*) total FROM product_color_new WHERE color_name = '".$color."' AND product_id=".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total > 0) {
      echo "<script>alert('這個商品已經有這個顏色了。');location.href='../admin_product_edit.php?id=".$pid."';</script>";die();
    }
    else {
      $sql = "INSERT INTO product_color_new (product_id,color_name) VALUES (".$pid.",'".$color."')";
      $pdo -> query($sql);
      echo "<script>alert('顏色新增完成。');location.href='../admin_product_edit.php?id=".$pid."';</script>";die();
    }
  }
  // product_update_size-更新特定商品尺寸(新東西，編寫中)
  function product_update_size($id,$size,$pid){
    global $pdo;
    $sql = "SELECT count(*) total FROM product_size_new WHERE size_name = '".$size."'AND product_id=".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total > 0) {
      echo "<script>alert('這個商品已經有這個尺寸了，或是您沒有對本欄位做更新。');location.href='../admin_product_edit.php?id=".$pid."';</script>";die();
    }
    $sql = "UPDATE product_size_new SET size_name = '".$size."' WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('更改成功。');location.href='../admin_product_edit.php?id=".$pid."';</script>";
  }
  // product_update_color-更新特定商品顏色(新東西，編寫中)
  function product_update_color($id,$color,$pid){
    global $pdo;
    $sql = "SELECT count(*) total FROM product_color_new WHERE color_name = '".$color."'AND product_id=".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total > 0) {
      echo "<script>alert('這個商品已經有這個顏色了，或是您沒有對本欄位做更新。');location.href='../admin_product_edit.php?id=".$pid."';</script>";die();
    }
    $sql = "UPDATE product_color_new SET color_name = '".$color."' WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('更改成功。');location.href='../admin_product_edit.php?id=".$pid."';</script>";
  }
  // admin_delete_cart-刪除購物車(透過管理員)
  function admin_delete_cart($cid){
    global $pdo;
    $sql = "SELECT * FROM cart_product WHERE cart_id =".$cid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $pid = $row["product_id"];
      $amount = $row["amount"];
      $sql2 = "UPDATE product SET stock = stock+".$amount." WHERE id =".$pid;
      $pdo -> query($sql2);
    }
    // 把購物車的詳細商品刪掉
    $sql = "DELETE FROM cart_product WHERE cart_id=".$cid;
    $pdo -> query($sql);
    // 把購物車的車子刪掉
    $sql = "DELETE FROM cart_list WHERE id=".$cid;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成，庫存已經從刪除的購物車中補回。');location.href='../admin_cart_list.php';</script>";
  }
  // product_delete_size-刪除特定商品尺寸(新東西，編寫中)
  function product_delete_size($id,$pid){
    global $pdo;
    $sql = "SELECT count(*) total FROM product_size_new WHERE product_id=".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total == 1) {
      echo "<script>alert('項目最少要有一項。');location.href='../admin_product_edit.php?id=".$pid."';</script>";
      die();
    }
    $sql = "DELETE FROM product_size_new WHERE id =".$id;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成。');location.href='../admin_product_edit.php?id=".$pid."';</script>";
  }
  // product_delete_color-刪除特定商品顏色(新東西，編寫中)
  function product_delete_color($id,$pid){
    global $pdo;
    $sql = "SELECT count(*) total FROM product_color_new WHERE product_id=".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total == 1) {
      echo "<script>alert('項目最少要有一項。');location.href='../admin_product_edit.php?id=".$pid."';</script>";
      die();
    }
    $sql = "DELETE FROM product_color_new WHERE id =".$id;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成。');location.href='../admin_product_edit.php?id=".$pid."';</script>";
  }
  // product_update_normal-更新特定商品基本資料(新東西，編寫中)
  function product_update_normal($id,$name,$product_no,$price,$group,$show_gif_new,$show_gif_lovely,$show_gif_top,$show_gif_sale,$show_gif_hot,$stock){
    global $pdo;
    $sql = "UPDATE product SET name = '".$name."',product_no = '".$product_no."',price = ".$price.",group_id=".$group.",show_gif_new = ".$show_gif_new.",show_gif_lovely = ".$show_gif_lovely.",show_gif_top = ".$show_gif_top.",show_gif_sale = ".$show_gif_sale.",show_gif_hot = ".$show_gif_hot.",stock = ".$stock." WHERE id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('更改完成');location.href='../admin_product_edit.php?id=".$id."';</script>";

  }
  // product_update_content-更新特定商品內文(新東西，編寫中)
  function product_update_content($id,$content){
    global $pdo;
    $content = htmlentities(htmlspecialchars($content));
    $sql = $pdo->prepare("UPDATE product set content = :content WHERE id = :id");
      $sql->bindParam(':id', $id);
      $sql->bindParam(':content', $content);
    $sql->execute();
    // $sql = "UPDATE product SET content = '".$content."' WHERE id = ".$id;
    // $pdo -> query($sql);
    echo "<script>alert('更改完成');location.href='../admin_product_edit.php?id=".$id."';</script>";
  }

  // product_update_img-更新特定商品圖片(新東西，編寫中)
  function product_update_img($id){
    check_img_size();
    global $pdo;
      // 目前只有12筆資料可以執行
      $order_line = 1;
      while ($order_line < 12) {
        $x = "img".$order_line; //串字串，用來抓取name的命名
        $file = $_FILES[$x]; //打檔案代碼讀取化
          global $pdo;
            if (is_empty($file['name'])) { echo "這張沒有換圖片<br>"; }
            else {
              $old_img_root = find_old_img_for_product($order_line,$id); // 先找出舊的圖片路徑，該步驟會回傳舊圖片的路徑
              echo $old_img_root;
              delete_old_img($old_img_root); // 刪除舊的圖片
              $img_root = "../img/product/"; //用於存放新的圖片路徑
              $img_show = "img/product/"; //用於顯示新圖片的路徑
              // 下面是執行新檔案上傳的同時，最後會回傳一個"顯示用"的路徑
              $new_img_root = upload_new_img($file,$order_line,$img_root,$img_show);
              // 更新顯示路徑，是給banner專用的
              new_img_root_for_product($new_img_root,$order_line,$id);
            }
            $order_line = $order_line + 1;
      }
    echo "<script>alert('banner圖片更新完成。');location.href='../admin_product_edit.php?id=".$id."';</script>";die();
  }
  // new_size-新增顏色(舊功能)
  function new_color($color){
    global $pdo;
    if (is_empty($color)) { echo "<script>alert('請填寫內容。');history.go(-1);</script>";die(); }
    if (color_exist($color)) { echo "<script>alert('請顏色已經存在。');history.go(-1);</script>";die(); }
    $sql = "INSERT INTO list_product_color(color_name) VALUES('".$color."')";
    $pdo -> query($sql);
    echo "<script>alert('顏色新增完成。');location.href='../admin_product_color_size.php';</script>";die();
  }
  // new_color-新增尺寸(舊功能)
  function new_size($size){
    global $pdo;
    if (is_empty($size)) { echo "<script>alert('請填寫內容。');history.go(-1);</script>";die(); }
    if (size_exist($size)) { echo "<script>alert('請尺寸已經存在。');history.go(-1);</script>";die(); }
    $sql = "INSERT INTO list_product_size(size_name) VALUES('".$size."')";
    $pdo -> query($sql);
    echo "<script>alert('尺寸新增完成。');location.href='../admin_product_color_size.php';</script>";die();
  }
  // update_size-更新顏色(舊功能)
  function update_color($color,$cid){
    global $pdo;
    if (is_empty($color)) { echo "<script>alert('請填寫內容。');history.go(-1);</script>";die(); }
    if (color_exist($color)) { echo "<script>alert('請顏色已經存在，或是該項目內容沒有任何更新。');history.go(-1);</script>";die(); }
    $sql = "UPDATE list_product_color SET color_name ='".$color."' WHERE id =".$cid;
    $pdo -> query($sql);
    echo "<script>alert('更新完成。');location.href='../admin_product_color_size.php';</script>";die();
  }
  // update_color-更新尺寸(舊功能)
  function update_size($size,$sid){
    global $pdo;
    if (is_empty($size)) { echo "<script>alert('請填寫內容。');history.go(-1);</script>";die(); }
    if (size_exist($size)) { echo "<script>alert('請尺寸已經存在，或是該項目內容沒有任何更新。');history.go(-1);</script>";die(); }
    $sql = "UPDATE list_product_size SET size_name ='".$size."' WHERE id =".$sid;
    $pdo -> query($sql);
    echo "<script>alert('更新完成。');location.href='../admin_product_color_size.php';</script>";die();
  }
  // delete_size-刪除顏色(舊功能)
  function delete_color($cid){
    global $pdo;
    $sql = "DELETE FROM list_product_color WHERE id = ".$cid;
    $pdo -> query($sql);
    $sql = "DELETE FROM product_color WHERE color_id =".$cid;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成。');location.href='../admin_product_color_size.php';</script>";die();
  }
  // delete_color-刪除尺寸(舊功能)
  function delete_size($sid){
    global $pdo;
    $sql = "DELETE FROM list_product_size WHERE id = ".$sid;
    $pdo -> query($sql);
    $sql = "DELETE FROM product_size WHERE size_id =".$sid;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成。');location.href='../admin_product_color_size.php';</script>";die();
  }
  // new_prodcut-新增商品
  function new_product($name,$product_no,$price,$original_price,$group,$color,$size,$show_gif_new,$show_gif_lovely,$show_gif_top,$show_gif_sale,$show_gif_hot,$content,$stock){
    check_img_size();
    global $pdo;
    // 重複商品可以先跳過，一個商品重複發兩次是比較少見的...
    // 品項重複跳過。(自己會把選項重複的情況很少...)
    if (is_empty($name)) { echo "<script>alert('請填寫商品名稱。');history.go(-1);</script>";die(); }
    if (is_empty($product_no)) { echo "<script>alert('請填寫商品編號。');history.go(-1);</script>";die(); }
    if (is_empty($stock)) { echo "<script>alert('請填寫庫存');history.go(-1);</script>";die(); }
    // if (is_empty($original_price)) { echo "<script>alert('請填寫原價價錢。');history.go(-1);</script>";die(); }
    if (is_empty($price)) { echo "<script>alert('請填寫價錢。');history.go(-1);</script>";die(); }
    if (is_empty($group)) { echo "<script>alert('請選擇一項分類。');history.go(-1);</script>";die(); }
    if (count($color) == 0) { echo "<script>alert('請至少要有一項顏色。');history.go(-1);</script>";die(); }
    if (count($size) == 0) { echo "<script>alert('請至少要有一項尺寸。');history.go(-1);</script>";die(); }
    // 要先檢查圖片是不是每張都有上傳設定(解除限制)
    // $order_line = 1;
    // while ($order_line < 12) {
          $x = "img1"; //串字串，用來抓取name的命名(再前面的頁面img1,img2...依此類推下去)
          $file = $_FILES[$x]; //打檔案代碼讀取化
    //       echo $file['name'];
          if (is_empty($file['name'])) { echo "<script>alert('請確認包含招牌圖片。');history.go(-1);</script>";die(); }
    //       //只要有任何一張圖片是空的就會直接把你擋下來
    //       $order_line = $order_line + 1;
    // }
    // 寫入非重複屬性的資料
    $content = htmlentities(htmlspecialchars($content));
    // echo $content;
    // die();
    $sql = "INSERT INTO product(name,product_no,price,group_id,show_gif_new,show_gif_lovely,show_gif_top,show_gif_sale,show_gif_hot,stock)
    VALUES('".$name."','".$product_no."',".$price.",".$group.",".$show_gif_new.",".$show_gif_lovely.",".$show_gif_top.",".$show_gif_sale.",".$show_gif_hot.",".$stock.")";
    $pdo -> query($sql);
    $pid = $pdo ->lastInsertId();
    $sql = $pdo->prepare("UPDATE product set content = :content WHERE id = :id");
      $sql->bindParam(':id', $pid);
      $sql->bindParam(':content', $content);
    $sql->execute();
    // 寫入重複性的資料(顏色)(舊的不使用暫時屏蔽)
    // for ($i=0; $i < count($color) ; $i++) {
    //   $sql = "INSERT INTO product_color(product_id,color_id) VALUES(".$pid.",".$color[$i].")";
    //   $pdo -> query($sql);
    // }
    for ($i=0; $i < count($color) ; $i++) {
      $sql = "INSERT INTO product_color_new(product_id,color_name) VALUES(".$pid.",'".$color[$i]."')";
      $pdo -> query($sql);
    }

    // 寫入重複性的資料(尺寸)(舊的不使用暫時屏蔽)
    // for ($i=0; $i < count($size) ; $i++) {
    //   $sql = "INSERT INTO product_size(product_id,size_id) VALUES(".$pid.",".$size[$i].")";
    //   $pdo -> query($sql);
    // }
    for ($i=0; $i < count($size) ; $i++) {
      $sql = "INSERT INTO product_size_new(product_id,size_name) VALUES(".$pid.",'".$size[$i]."')";
      $pdo -> query($sql);
    }

    // 最後更新圖片
    // 為了以方便重複性使用，不使用INSERT去寫進路徑，而是先直接寫空資料進資料庫後，再立刻更新圖片路徑(這個功能便可以重複使用)
    $order_line = 1;
    // 本處總共11個圖片，迴圈執行11次
    while ($order_line < 12) {
      $x = "img".$order_line; //串字串，用來抓取name的命名(再前面的頁面img1,img2...依此類推下去)
      $file = $_FILES[$x]; //打檔案代碼讀取化
      if (is_empty($file['name'])) {
        echo "此張圖片空白";
      }
      else {
        global $pdo;
        $sql = "INSERT INTO product_img(product_id,img_root,order_line) VALUES(".$pid.",'nothing',".$order_line.")";
        $pdo -> query($sql);
        // $old_img_root = find_old_img_for_banner($order_line); // 先找出舊的圖片路徑，該步驟會回傳舊圖片的路徑
        // delete_old_img($old_img_root); // 刪除舊的圖片
        $img_root = "../img/product/"; //用於存放新的圖片路徑
        $img_show = "img/product/"; //用於顯示新圖片的路徑
        // 下面是執行新檔案上傳的同時，最後會回傳一個"顯示用"的路徑
        $new_img_root = upload_new_img($file,$order_line,$img_root,$img_show);
        // 更新顯示路徑，是給banner專用的
        new_img_root_for_product($new_img_root,$order_line,$pid);
      }
      $order_line = $order_line + 1;
    }
    echo "<script>alert('新增完成。');location.href='../admin_index.php';</script>";die();
  }
  // delete_product-刪除商品
  function delete_product($id){
    global $pdo;
    // 在這之前，要先確認精選12，週選6，購物車，訂單裡面有沒有，如果有找到任何一筆，就要擋下來
    // 先找購物車
    // $sql = "SELECT count(*) total FROM cart_product WHERE product_id = ".$id;
    // $rs = $pdo -> query($sql);
    // foreach ($rs as $key => $row) {
    //   $total = $row["total"];
    // }
    // if ($total > 0) { echo "<script>alert('有客人將這項商品放在購物車中，暫時不可刪除。');history.go(-1);</script>";die(); }
    // // 再找訂單
    // $sql = "SELECT count(*) total FROM order_product WHERE product_id = ".$id;
    // $rs = $pdo -> query($sql);
    // foreach ($rs as $key => $row) {
    //   $total = $row["total"];
    // }
    // if ($total > 0) { echo "<script>alert('已經有客人的訂單中有這項商品了，暫時不可刪除');history.go(-1);</script>";die(); }
    // 再找精選12
    $sql = "SELECT count(*) total FROM product_classic9 WHERE product_id = ".$id;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total > 0) { echo "<script>alert('請先將該商品從精選12中移除設定再刪除商品。');history.go(-1);</script>";die(); }
    // 最後找週選
    $sql = "SELECT count(*) total FROM product_weekbest WHERE product_id = ".$id;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $total = $row["total"];
    }
    if ($total > 0) { echo "<script>alert('請先將該商品從週選6項中移除設定再刪除商品。');history.go(-1);</script>";die(); }
    // 最後才開始刪除動作
    // 把圖片刪光光，找到路徑後刪除
    $order_line = 1;
    // 本處總共11個圖片，迴圈執行11次
    while ($order_line < 12) {
      $old_img_root = find_old_img_for_product($order_line,$id); // 先找出舊的圖片路徑，該步驟會回傳舊圖片的路徑
      delete_old_img($old_img_root); // 刪除舊的圖片
      $order_line = $order_line + 1;
    }
    // 刪除這個路徑圖片(product_img)的資料
    $sql = "DELETE FROM product_img WHERE product_id =".$id;
    $pdo -> query($sql);
    // 刪除product的資料
    $sql = "DELETE FROM product WHERE id =".$id;
    $pdo -> query($sql);
    // 刪除product_color的資料
    // $sql = "DELETE FROM product_color WHERE product_id=".$id;
    // $pdo -> query($sql);
    $sql = "DELETE FROM product_color_new WHERE product_id=".$id;
    $pdo -> query($sql);
    // 刪除product_size的資料
    // $sql = "DELETE FROM product_size WHERE product_id=".$id;
    // $pdo -> query($sql);
    $sql = "DELETE FROM product_size_new WHERE product_id=".$id;
    $pdo -> query($sql);
    // 刪除還再購物車裡面的物品(直接刪除?)，已經結帳的物品不受影響，將由人員自行連絡
    // 額外設定，把購物車中的內容刪除(未結帳的，以結帳的內容都是直接寫入資料庫)
    $sql = "DELETE FROM cart_product WHERE product_id = ".$id;
    $pdo -> query($sql);


    echo "<script>alert('刪除完成。');location.href='../admin_product_list.php';</script>";die();
  }
  // update_classic9-更改經典
  function update_classic9($classic1,$classic2,$classic3,$classic4,$classic5,$classic6,$classic7,$classic8,$classic9,$classic10,$classic11,$classic12){
    if (is_empty($classic1)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic2)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic3)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic4)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic5)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic6)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic7)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic8)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic9)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic10)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic11)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (is_empty($classic12)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic1))) { echo "<script>alert('經典1商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic2))) { echo "<script>alert('經典2商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic3))) { echo "<script>alert('經典3商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic4))) { echo "<script>alert('經典4商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic5))) { echo "<script>alert('經典5商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic6))) { echo "<script>alert('經典6商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic7))) { echo "<script>alert('經典7商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic8))) { echo "<script>alert('經典8商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic9))) { echo "<script>alert('經典9商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic10))) { echo "<script>alert('經典10商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic11))) { echo "<script>alert('經典11商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    if (!(product_exist($classic12))) { echo "<script>alert('經典12商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_classic9.php';</script>";die(); }
    else {
      global $pdo;
      $sql = "UPDATE product_classic9 SET product_id = ".$classic1." WHERE order_line=1";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic2." WHERE order_line=2";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic3." WHERE order_line=3";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic4." WHERE order_line=4";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic5." WHERE order_line=5";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic6." WHERE order_line=6";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic7." WHERE order_line=7";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic8." WHERE order_line=8";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic9." WHERE order_line=9";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic10." WHERE order_line=10";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic11." WHERE order_line=11";
      $pdo -> query($sql);
      $sql = "UPDATE product_classic9 SET product_id = ".$classic12." WHERE order_line=12";
      $pdo -> query($sql);

    }
    echo "<script>alert('精選更新完成。');location.href='../admin_classic9.php';</script>";die();
  }
  // update_classic9-更改經典
  function update_weekbest($weekbest1,$weekbest2,$weekbest3,$weekbest4,$weekbest5,$weekbest6){
    if (is_empty($weekbest1)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_weekbest.php';</script>";die(); }
    if (is_empty($weekbest2)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_weekbest.php';</script>";die(); }
    if (is_empty($weekbest3)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_weekbest.php';</script>";die(); }
    if (is_empty($weekbest4)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_weekbest.php';</script>";die(); }
    if (is_empty($weekbest5)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_weekbest.php';</script>";die(); }
    if (is_empty($weekbest6)) { echo "<script>alert('所有商品精選都為必填。');location.href='../admin_weekbest.php';</script>";die(); }
    if (!(product_exist($weekbest1))) { echo "<script>alert('經典1商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_weekbest.php';</script>";die(); }
    if (!(product_exist($weekbest2))) { echo "<script>alert('經典2商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_weekbest.php';</script>";die(); }
    if (!(product_exist($weekbest3))) { echo "<script>alert('經典3商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_weekbest.php';</script>";die(); }
    if (!(product_exist($weekbest4))) { echo "<script>alert('經典4商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_weekbest.php';</script>";die(); }
    if (!(product_exist($weekbest5))) { echo "<script>alert('經典5商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_weekbest.php';</script>";die(); }
    if (!(product_exist($weekbest6))) { echo "<script>alert('經典6商品編號是不存在的，請確認過表單填寫正確。');location.href='../admin_weekbest.php';</script>";die(); }
    else {
      global $pdo;
      $sql = "UPDATE product_weekbest SET product_id = ".$weekbest1." WHERE order_line=1";
      $pdo -> query($sql);
      $sql = "UPDATE product_weekbest SET product_id = ".$weekbest2." WHERE order_line=2";
      $pdo -> query($sql);
      $sql = "UPDATE product_weekbest SET product_id = ".$weekbest3." WHERE order_line=3";
      $pdo -> query($sql);
      $sql = "UPDATE product_weekbest SET product_id = ".$weekbest4." WHERE order_line=4";
      $pdo -> query($sql);
      $sql = "UPDATE product_weekbest SET product_id = ".$weekbest5." WHERE order_line=5";
      $pdo -> query($sql);
      $sql = "UPDATE product_weekbest SET product_id = ".$weekbest6." WHERE order_line=6";
      $pdo -> query($sql);
    }
    echo "<script>alert('精選更新完成。');location.href='../admin_weekbest.php';</script>";die();
  }
  // add_cart_by_preorder 透過預購加入至購物車
  function add_cart_by_preorder($preid){
    global $pdo;
    $sql = "SELECT * FROM preorder_list_detail WHERE id = ".$preid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $stock = $row["stock"];
      $amount = $row["amount"];
      $color_id = $row["color_id"];
      $size_id = $row["size_id"];
      $product_id = $row["product_id"];
    }
    if ($amount > $stock) {
      echo "<script>alert('庫存已被預購完畢，請等候進貨。');history.go(-1);</script>";die();
    }
    else {
      $sql2 = "SELECT * FROM cart_list WHERE user_id =".$_SESSION["uid"];
      $rs2 = $pdo -> query($sql2);
      foreach ($rs2 as $key => $row2) {
        $cart_id = $row2["id"];
      }
      $sql3 = "INSERT INTO cart_product(cart_id,product_id,color_id,size_id,amount) VALUES(".$cart_id.",".$product_id.",".$color_id.",".$size_id.",".$amount.")";
      $pdo -> query($sql3);
      $sql4 = "DELETE FROM preorder_product WHERE id =".$preid;
      $pdo -> query($sql4);
      $sql5 = "UPDATE product SET stock = stock-".$amount;
      $pdo -> query($sql5);
      echo "<script>alert('加入購物車成功了。');history.go(-1);</script>";die();
    }
  }
  // add_cart-新增至購物車
  function add_cart($pid,$color,$size,$uid,$amount,$go_cart){
    // 沒登入先直接踢出去
    if (is_empty($uid)) { echo "<script>alert('請先登入');location.href='../index.php?page=login';</script>";die(); }
    // 預購功能，這次時間有限...只好先直接寫在裡面。
    // 這是預購
    if ($go_cart == "preorder") {
      global $pdo;
      $uid = $_SESSION["uid"];
      // 預購也會建立購物車
      if (!(cart_exist($uid))) { new_cart($uid); }
      $sql = "INSERT INTO preorder_product(user_id,product_id,color_id,size_id,amount) VALUES(".$uid.",".$pid.",".$color.",".$size.",".$amount.")";
      $pdo -> query($sql);
      echo "<script>alert('預購完成。可以到「會員專區」→「訂單查詢」進行預購商品的查詢。');location.href='../index.php?page=product&pid=".$pid."';</script>";die();
      die();
    }
    // 前台已經有檢查，但是後台也要有檢查時間差
    global $pdo;
    $sql2 = "SELECT stock FROM product WHERE id = ".$pid;
    $rs2 = $pdo -> query($sql2);
    foreach ($rs2 as $key => $row2) {
      $stock = $row2["stock"];
    }
    if ($stock == 0) {
      echo "<script>alert('該商品已經售完，歡迎預購。');location.href='../index.php?page=product&pid=".$pid."';</script>";die();
    }
    // 如果有先被買走數量
    if ($amount > $stock) {
      echo "<script>alert('目前該商品數量不足，請重新選購數量');location.href='../index.php?page=product&pid=".$pid."';</script>";die();
    }
    if ($amount < 1) {
      echo "<script>alert('至少要選擇一件，數量不可為負數。');location.href='../index.php?page=product&pid=".$pid."';</script>";die();
    }
    // 檢查這個會員是不是已經有購物車了，如果沒有，先生成一個給他
    if (!(cart_exist($uid))) { new_cart($uid); }
    // 透過使用者id找出cart_id
    $cid = cart_id_find($uid);
    // 把商品uid跟選擇的color,size id寫進表單中
    $sql = "INSERT INTO cart_product(cart_id,product_id,color_id,size_id,amount) VALUES(".$cid.",".$pid.",".$color.",".$size.",".$amount.")";
    $pdo -> query($sql);
    $stock_new = $stock - $amount;
    $sql = "UPDATE product SET stock = ".$stock_new." WHERE id=".$pid;
    $pdo -> query($sql);
    // 加入購物車並且跳轉業面暫時關閉
    if ($go_cart == "yes") {
      header("location:../index.php?page=cart");
    }
    // 現在只有加入購物車
    if ($go_cart == "no") {
      echo "<script>alert('加入購物車完成。');location.href='../index.php?page=product&pid=".$pid."';</script>";die();
    }
  }
  // delete_cart_product-刪除購物車物品
  function delete_cart_product($pid){
    global $pdo;
    // $sql = "DELETE FROM cart_product WHERE product_id=".$pid; 屏蔽是為了記得錯誤，是特定id，而不是商品id,會全部刪掉的。
    //把庫存還回去
    $sql2 = "SELECT * FROM cart_product WHERE id =".$pid;
    $rs = $pdo -> query($sql2);
    foreach ($rs as $key => $row) {
      $product_id = $row["product_id"];
      $amount = $row["amount"];
      $sql = "UPDATE product SET stock = stock+".$amount." WHERE id = ".$product_id;
      $pdo -> query($sql);
    }
    //把特定商品刪掉
    $sql = "DELETE FROM cart_product WHERE id=".$pid;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成。');history.go(-1);</script>";die();
  }
  // delete_preorder_product-刪除預購物品
  function delete_preorder_product($pid){
    global $pdo;
    // $sql = "DELETE FROM cart_product WHERE product_id=".$pid; 屏蔽是為了記得錯誤，是特定id，而不是商品id,會全部刪掉的。
    //把特定商品刪掉
    $sql = "DELETE FROM preorder_product WHERE id=".$pid;
    $pdo -> query($sql);
    echo "<script>alert('刪除完成。');history.go(-1);</script>";die();
  }
  // pay_cart支付購物車，生成訂單(無金流版本)
  // function cart_pay($order_name,$order_phone,$order_address,$take_name,$take_phone,$take_address,$take_time,$note,$recipe,$donate_recipe){
  //   global $pdo;
  //   // 先找出購物車的總金額(總金額，使用者id，購物車id)
  //   $sql = "SELECT * FROM cart_list_all WHERE user_id = ".$_SESSION["uid"];
  //   $rs = $pdo -> query($sql);
  //   foreach ($rs as $key => $row) {
  //     $price = $row["price"];//取得總價
  //     $user_id = $row["user_id"];//取得會員id
  //     $cart_id = $row["cart_id"];//取得購物車id去對照詳細內容
  //   }
  //   // 把購物車跟寫好的資訊整合寫成訂單(已付款)
  //   $t = "A".time().$user_id;
  //   $sql ="INSERT INTO order_list(user_id,order_name,order_phone,order_address,take_name,take_phone,take_address,note,take_time,price,create_time,sended,recipe,donate_recipe,order_no) VALUES (".$user_id.",'".$order_name."',".$order_phone.",'".$order_address."','".$take_name."',".$take_phone.",'".$take_address."','".$note."','".$take_time."',".$price."+80,NOW(),'未送出','".$recipe."','".$donate_recipe."','".$t."')";
  //   $pdo -> query($sql);
  //   $order_id = $pdo ->lastInsertId();
  //   // 把訂單詳細內容的資訊整合成訂單詳細內容(已付款)
  //   $sql = "SELECT * FROM cart_list_detail WHERE cart_id=".$cart_id;
  //   $rs = $pdo -> query($sql);
  //   foreach ($rs as $key => $row) {
  //     $sql2 = "INSERT INTO order_product(order_id,user_id,product_name,price,size,color) VALUES (".$order_id.",".$user_id.",'".$row["product_name"]."',".$row["price"].",'".$row["size_name"]."','".$row["color_name"]."')";
  //     $pdo -> query($sql2);
  //   }
  //   // 把購物車的詳細商品刪掉
  //   $sql = "DELETE FROM cart_product WHERE cart_id=".$cart_id;
  //   $pdo -> query($sql);
  //   // 把購物車的車子刪掉
  //   $sql = "DELETE FROM cart_list WHERE id=".$cart_id;
  //   $pdo -> query($sql);
  //   echo "<script>alert('付款成功了，請到會員專區查看。');location.href='../index.php';</script>";die();
  // }

  function delete_unpaid($id){
    global $pdo;
    // 這是不會交回去的。
    // 把訂單的庫存交回去
    // $sql = "SELECT * FROM order_product WHERE order_id = ".$id;
    // $rs = $pdo -> query($sql);
    // foreach ($rs as $key => $row) {
    //   $amount = $row["amount"];//商品總數
    //   $pid = $row["product_id"];//商品的id
    //   $sql2 = "UPDATE product SET stock = stock +".$amount." WHERE id = ".$pid;
    //   $pdo -> query($sql2);
    // }
    // 刪除訂單
    $sql = "DELETE FROM order_list WHERE id =".$id;
    $pdo -> query($sql);
    // 刪除訂單內的商品
    $sql = "DELETE FROM order_product WHERE order_id = ".$id;
    $pdo -> query($sql);
    echo "<script>alert('刪除未付款訂單完成');location.href='../admin_order_list_unpaid.php';</script>";die();

  }

  // 串上金流的測試版本
  function cart_pay($order_name,$order_phone,$order_address,$order_postcode,$take_type,$take_name,$take_phone,$take_address,$take_postcode,$take_time,$note,$recipe,$donate_recipe,$shop_name,$shop_address,$shop_id){
    global $pdo;
    // 先找出購物車的總金額(總金額，使用者id，購物車id)
      // 先找出購物車的總金額(總金額，使用者id，購物車id)
      $sql = "SELECT * FROM cart_list_all WHERE user_id = ".$_SESSION["uid"];
      $rs = $pdo -> query($sql);
      foreach ($rs as $key => $row) {
        $price = $row["price"];//取得總價
        $user_id = $row["user_id"];//取得會員id
        $cart_id = $row["cart_id"];//取得購物車id去對照詳細內容
      }
      // 把購物車跟寫好的資訊整合寫成訂單(未付款暫時表單)
      // $order_no = "No".time().$user_id;
      if ($take_type == "地址配送") {
        $shop_name = "無";
        $shop_address = "無";
        $shop_id = "無";
        if ($take_address == "") {
          echo "<script>alert('地址為必填。');location.href='../index.php?page=Shop_Step2';</script>";die();
        }
        if ($take_postcode == "") {
          echo "<script>alert('郵遞區號為必填。');location.href='../index.php?page=Shop_Step2';</script>";die();
        }
      }
      if ($take_type == "超商取貨") {
        $take_address = "無";
        $take_postcode = "無";
        if ($shop_name == "") {
          echo "<script>alert('請選擇超商。');history.go(-1);</script>";die();
        }
      }      $sql ="INSERT INTO order_list(user_id,order_name,order_phone,order_address,order_postcode,take_type,take_name,take_phone,take_address,take_postcode,note,take_time,price,create_time,sended,recipe,donate_recipe,order_no,take_shop_name,take_shop_address,take_shop_id)
      VALUES (".$user_id.",'".$order_name."','".$order_phone."','".$order_address."','".$order_postcode."','".$take_type."','".$take_name."','".$take_phone."','".$take_address."','".$take_postcode."','".$note."','".$take_time."',".$price.",NOW(),'未送出','".$recipe."','".$donate_recipe."','未付款訂單沒有編號','".$shop_name."','".$shop_address."','".$shop_id."')";
      $pdo -> query($sql);
      $order_id = $pdo ->lastInsertId();
      // 把訂單詳細內容的資訊整合成訂單詳細內容
      $sql = "SELECT * FROM cart_list_detail WHERE cart_id=".$cart_id;
      $rs = $pdo -> query($sql);
      foreach ($rs as $key => $row) {
        $sql2 = "INSERT INTO order_product(order_id,user_id,product_name,product_id,price,size,color,amount) VALUES (".$order_id.",".$user_id.",'".$row["product_name"]."',".$row["product_id"].",".$row["price"].",'".$row["size_name"]."','".$row["color_name"]."',".$row["amount"].")";
        $pdo -> query($sql2);
      }
      // // 把購物車的詳細商品刪掉
      // $sql = "DELETE FROM cart_product WHERE cart_id=".$cart_id;
      // $pdo -> query($sql);
      // // 把購物車的車子刪掉
      // $sql = "DELETE FROM cart_list WHERE id=".$cart_id;
      // $pdo -> query($sql);
      // echo "<script>alert('付款成功了，請到會員專區查看。');location.href='../index.php';</script>";die();
    header("location:../ECPAY/sample_All_CreateOrder.php?uid=".$_SESSION["uid"]."&order_id=".$order_id."&cart_id=".$cart_id."&order_no='".$order_no."'");
  }
  // pay_finish支付完畢，生成正式訂單
  function pay_finish(){
    $order_id = $_POST["CustomField1"];
    $cart_id = $_POST["CustomField2"];
    $order_no = $_POST["CustomField3"];
    $result = $_POST["RtnCode"];
    // 付款成功才刷新
    if ($result = 1) {
      global $pdo;
      // 把訂單的狀態改成已經付款
      $sql ="UPDATE order_list SET paid = '已付款',paid_time = NOW(),order_no = '".$order_no."' WHERE id =".$order_id;
      $pdo -> query($sql);
      // 把購物車的詳細商品刪掉
      $sql = "DELETE FROM cart_product WHERE cart_id=".$cart_id;
      $pdo -> query($sql);
      // 把購物車的車子刪掉
      $sql = "DELETE FROM cart_list WHERE id=".$cart_id;
      $pdo -> query($sql);
      echo "1|OK";
      echo "<script>alert('付款成功了，請到會員專區查看。');location.href='../index.php';</script>";die();
    }
    // 不然就是顯示付款失敗
    else {
      global $pdo;
      // 付款失敗的訂單由管理員直接刪除
      // 把未付款的訂單直接刪除
      // $sql = "DELETE FROM order_list WHERE order_no = '".$order_no."' WHERE id =".$order_id;
      // $pdo -> query($sql);
      // 把未付款的訂單附帶商品一起刪除
      // $sql = "DELETE FROM order_product WHERE order_id = ".$order_id;
      // $pdo -> query($sql);
      echo "<script>alert('付款失敗，請確認付款手段正確。');location.href='../index.php';</script>";die();
    }
  }
  // order_paid-調整為已收到款項
  function order_paid($oid){
    global $pdo;
    $sql = "UPDATE order_list SET paid = '已付款' WHERE id=".$oid;
    $pdo -> query($sql);
    echo "<script>alert('確認已收到款項。');location.href='../admin_order_list.php';</script>";die();
  }
  // order_send-傳送參數到綠界物流
  function order_send($oid){
    // global $pdo;
    // $sql = "UPDATE order_list SET sended = '已出貨' WHERE id=".$oid;
    // $pdo -> query($sql);
    // echo "<script>alert('出貨成功');location.href='../admin_order_list.php';</script>";die();
    global $pdo;
    $sql = "SELECT ol.*,us.* FROM order_list ol LEFT JOIN 00user_full_list us ON ol.user_id = us.id WHERE ol.id = ".$oid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      $take_type = $row["take_type"];
    }
    if ($take_type == "超商取貨") {
      header("location:../ECPAY/sample_BGCvsCreateShippingOrder.php?oid=".$oid);
    }
    if ($take_type == "地址配送") {
      header("location:../ECPAY/sample_BGHOMECreateShippingOrder.php?oid=".$oid);
    }
  }
  // order_send-祭送出訂單的物品，調整為已經出貨
  function order_send_finish($oid){
    $RtnCode = $_POST["RtnCode"];
    $RtnMsg = $_POST["RtnMsg"];
    // echo $_POST["CheckMacValue"];
    global $pdo;
    $sql = "UPDATE order_list SET sended = '已出貨',RtnCode = ".$RtnCode.",RtnMsg = '".$RtnMsg."' WHERE id=".$oid;
    $pdo -> query($sql);
    echo "<script>alert('出貨成功');location.href='../admin_order_list.php';</script>";die();
  }
  // order_send-祭送出訂單的物品，調整為已經出貨
  function order_change($oid,$statues,$ori){
    global $pdo;
    if ($ori == "已出貨") {
      $sql = "UPDATE order_list SET sended = '".$statues."',RtnCode = '',RtnMsg = '這是張已被出貨的訂單又被改成未出貨。' WHERE id=".$oid;
      $pdo -> query($sql);
      echo "<script>alert('更改成功，請至綠界後台查看多出來的物流訂單並且處理。');location.href='../admin_order_list.php';</script>";die();
    }
    else {
      $sql = "UPDATE order_list SET sended = '".$statues."' WHERE id=".$oid;
      $pdo -> query($sql);
      echo "<script>alert('更改成功。');location.href='../admin_order_list.php';</script>";die();
    }
  }

// 3.小積木功能
  // 確認會員是否已經有購物車(只要加入過購物車一次就會有，也只會有一個)
  function cart_exist($uid){
    global $pdo;
    $sql = "SELECT count(*) total FROM cart_list WHERE user_id =".$uid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total >= 1) { return true; }
  }
  // 建造一個購物車
  function new_cart($uid){
    global $pdo;
    $sql = "INSERT INTO cart_list(user_id) VALUES(".$uid.")";
    $pdo -> query($sql);
  }
  // 找出購物車的id
  function cart_id_find($uid){
    global $pdo;
    $sql = "SELECT * FROM cart_list WHERE user_id =".$uid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) { return $row["id"]; }
  }
  // 確認這個商品是存在的
  function product_exist($pid){
    global $pdo;
    $sql = "SELECT count(*) total FROM product WHERE id =".$pid;
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total >= 1) { return true; }
  }
  // 顏色已經存在
  function color_exist($color){
    global $pdo;
    $sql = "SELECT count(*) total FROM list_product_color WHERE color_name = '".$color."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total >= 1) { return true; }
  }
  // 尺寸已經存在
  function size_exist($size){
    global $pdo;
    $sql = "SELECT count(*) total FROM list_product_size WHERE size_name = '".$size."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total >= 1) { return true; }
  }
  // 檢查手機是否都是數字(暫時關閉使用中)
  function phone_check($variable){
    if (is_numeric($variable)) { return true; }
  }
  // 檢查長度(介於6-20碼)
  function strlen_check($variable){
    if (strlen($variable) >= 6 && strlen($variable) <= 20) { return true; }
  }
  // 檢查欄位是否為空
  function is_empty($variable){
    if (empty($variable)) { return true; }
  }
  // 檢查密碼1和2是否相同
  function password_confirm($password,$password2){
    if ($password == $password2) { return true; }
  }
  // 檢查資訊是否已經存在(重複)
  function email_exist($email){
    global $pdo;
    $sql = "SELECT count(*) total FROM user WHERE email = '".$email."'";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) { return true; }
  }
  // 檢查帳號是否被凍結了(登入時檢查)
  function frozen_check($email){
    global $pdo;
    $sql = "SELECT count(*) total FROM user WHERE email = '".$email."' AND frozen = 1";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) { return true; }
  }
  // 檢查帳號是否開通了(登入時檢查)
  function active_check($email){
    global $pdo;
    $sql = "SELECT count(*) total FROM user WHERE email = '".$email."' AND active = 1";
    $rs = $pdo -> query($sql);
    foreach ($rs as $row) { $total = $row["total"]; }
    if ($total > 0) { return true; }
  }
  // 尋找舊的圖片路徑(banner專用)
  function find_old_img_for_banner($order_line){
    global $pdo;
    $sql = "SELECT img_root FROM banner WHERE order_line = ".$order_line;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      return $row["img_root"];
    }
  }
  // 尋找舊的圖片的路徑(product專用)
  function find_old_img_for_product($order_line,$id){
    global $pdo;
    $sql = "SELECT img_root FROM product_img WHERE order_line = ".$order_line." AND product_id=".$id;
    $rs = $pdo -> query($sql);
    foreach ($rs as $key => $row) {
      return $row["img_root"];
    }
  }
  // 先檢查唯一圖片大小
  function check_img_size(){
    $file = $_FILES['img1'];
    if ($file['size'] >1000000) { echo "<script>alert('招牌圖片檔案大小不可超過1MB。');history.go(-1);</script>";die(); }
    // if ($file['size'] >1000000) { echo "<script>alert('招牌圖片檔案大小不可超過1MB。');history.go(-1);</script>";die(); }

  }

  function delete_old_img($old_img){
    $old_img = "../"."$old_img";
    unlink($old_img);//將檔案刪除
  }
  // 上傳檔案功能
  function upload_new_img($new_file,$order_line,$img_root,$img_show){
    $type=$new_file['type'];
    $size=$new_file['size'];
    $name=iconv("UTF-8","BIG-5",$new_file['name']);
    $nameEcho=$new_file['name'];
    $tmp_name=$new_file['tmp_name'];
    $sizemb=round($size/1024000,2);
    // echo "檔案類型：".$type."</br>";
    // echo "檔案大小：".$sizemb."MB</br>";
    // echo "檔案名稱：".$nameEcho."</br>";
    // echo "暫存名稱：".$tmp_name."</br>";
    if($type=="image/jpg" || $type=="image/png" ||
       $type=="image/jpeg" || $type=="image/gif" ||
       $type=="image/JPG" || $type=="image/PNG" ||
       $type=="image/JPEG" || $type=="image/GIF"){
     if($sizemb < 1){
      $file=explode(".",$name);
      $new_name=$file[0]."-".date(ymdhis)."-".rand(0,10);
      $chi_name=iconv("BIG-5","UTF-8",$new_name);
      // echo "</br>已修改為新檔名:".$chi_name."後上傳成功";
      move_uploaded_file($tmp_name,$img_root.$new_name.".".$file[1]);
      // 回傳顯示用的路徑
      $new_img_root = $img_show.$new_name.".".$file[1];
      return $new_img_root;
      //
      // echo "上傳成功";
     }else{
      // echo "檔案太大，上傳失敗";
      echo "<script>alert('檔案格式錯誤，上傳失敗');history.go(-1);</script>";die();
     }
    }else{
    //  echo "檔案格式錯誤，上傳失敗";
      echo "<script>alert('檔案太大，上傳失敗');history.go(-1);</script>";die();
    }
  }
  // 設定新的圖片顯示路徑(banner使用)
  function new_img_root_for_banner($new_img_root,$order_line){
    global $pdo;
    $sql = "UPDATE banner SET img_root = '".$new_img_root."' WHERE order_line = ".$order_line;
    $pdo -> query($sql);
  }
  // 設定新的圖片顯示路徑(product專用)
  function new_img_root_for_product($new_img_root,$order_line,$pid){
    global $pdo;
    $sql = "UPDATE product_img SET img_root = '".$new_img_root."' WHERE order_line = ".$order_line." AND product_id =".$pid;
    $pdo -> query($sql);
  }

  // 寄信功能
  // $email //收件者信箱內容
  // $accepter //收件者名稱
  // $title //標題
  // $content //內文
  function mailsend($email,$accepter,$title,$content){
    include_once("../lib/PHPMailer/PHPMailerAutoload.php"); // 匯入PHPMailer類別
    $mail = new PHPMailer();                        // 建立新物件
    $mail->IsSMTP();                                // 設定使用SMTP方式寄信
    $mail->SMTPAuth = true;                         // 設定SMTP需要驗證
    $mail->SMTPSecure = "ssl";                      // Gmail的SMTP主機需要使用SSL連線
    $mail->Host = "smtp.gmail.com";                 // Gmail的SMTP主機
    // $mail->Host = "smtp.mail.yahoo.com.tw";         // YAHOO的SMTP主機
    $mail->Port = 465;                              // Gmail的SMTP主機的port為465
    $mail->CharSet = "utf-8";                       // 設定郵件編碼
    $mail->Encoding = "base64";
    $mail->WordWrap = 50;                           // 每50個字元自動斷行
    $mail->SMTPDebug  = 2;
    // 執行寄信動作的信箱
    include_once "../ECPAY/route.php";
    // $mail->Username = $sender_mail;     // 設定驗證帳號
    // $mail->Password = $sender_pass;              // 設定驗證密碼
    $mail->Username = "gracekr888@gmail.com";     // 設定驗證帳號
    $mail->Password = "ivy761025";              // 設定驗證密碼
    // 顯示寄信者是誰
    $mail->From = "gracekr888@gmail.com";         // 設定寄件者信箱
    $mail->FromName = "GRACEKR管理員";                 // 設定寄件者姓名
    $mail->Subject = $title; // 設定郵件標題
    $mail->IsHTML(true);    // 設定郵件內容為HTML
    $mailList =       // 代表收件者資訊的陣列   (信箱, 姓名, 密碼)
        array(
            array($email,$accepter),
        );

    foreach ($mailList as $receiver) {
        $mail->AddAddress($receiver[0], $receiver[1]);  // 收件者郵件及名稱

        $mail->Body = $content;
        if($mail->Send()) {                             // 郵件寄出
          // echo"<script>alert('成功完成訂單了，請到您的信箱查看。');</script>";
        } else {
          // echo"<script>alert('信件沒有寄出成功。');</script>";
        }
        $mail->ClearAddresses();  // 清除使用者欄位，為下一封信做準備
    }
  }
 ?>
