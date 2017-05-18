<?php
require_once './conf/setting.php';
require_once './model/model.php';

session_start();

// 未ログインなら、ログイン画面へ
if(login_check() === false){
	header('Location: ./login.php');
	exit;
}
$user_id = '';
if (isset($_SESSION['user_id']) === TRUE) {
  // ログイン済みの場合
  $user_id = $_SESSION['user_id'];
  //データベースに接続して、ログインユーザの情報を得る
  $link = get_db_connect();
  try {
  	$user_data= get_login_user_data($link, $user_id);
  } catch (PDOException $e) {
  	$err_msg[] = $e-> getMessage();
  }
} else {
  // $user_id = 'ゲスト';
}
// var_dump($user_data);
// // Cookie情報からユーザ名を取得 (ログインの時のみ)
// if (isset($_COOKIE['user_name'])) {
//   $user_name = $_COOKIE['user_name'];
// } else {
//   $user_name = '';
// }
// ユーザ名の取得の確認
$login_user = '';
if (isset($user_data[0]['user_name'])) {
  $login_user = $user_data[0]['user_name'];
} else {
  $login_user = 'ゲスト';
}
// var_dump($login_user);
// エラーメッセージ
$err_msg = [];
$user_id = get_user_id();
$msg = [];
$img_dir = './image/';

//商品一覧を取得
try{
  $dbh = get_db_connect();
  // $cart_list = get_cart_list($dbh);
}catch(PDOException $e){
  $err_msg = $e->getMessage();
}
// $total_price = get_total_price($cart_list);

$sql_kind = get_post_data('sql_kind');
$request_method = get_request_method();
$create_datetime = date('Y-m-d H:i:s');  //作成日時を取得
$update_datetime = date('Y-m-d H:i:s');  //更新日時を取得

// カートより商品を削除する処理
if($sql_kind === 'delete_cart' && $request_method === 'POST'){
	$params = array(
	  'item_id' => get_post_data('item_id'),
	  'user_id' => get_user_id()
	);
	try{
	  $dbh = get_db_connect();
	  $msg[] = delete_cart_item($dbh, $params);
	}catch(PDOException $e){
	  $err_msg[] = $e->getMessage();
	}
}

// カートの中に入っている購入予定数を変更する処理
if($sql_kind === 'update_cart' && $request_method === 'POST'){
	$params = array(
	  'item_id' => get_post_data('item_id'),
	  'user_id' => get_user_id(),
		'amount'  => get_post_data('amount'),
	  'update_datetime' => date('Y-m-d H:i:s')
	);
	$params['amount'] = (int)$params['amount'];
	try{
	  $dbh = get_db_connect();
	  // $msg[] = update_cart_amount($dbh, $params);
		$msg[] = update_cart($dbh, $params);
	}catch(PDOException $e){
	  $err_msg[] = $e->getMessage();
	}
}

$cart_list = get_cart_list($dbh);
$total_price = get_total_price($cart_list);

include_once './view/cart_view.php';

 ?>
