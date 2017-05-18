<?php
//設定ファイル読み込み
require_once './conf/setting.php';
//関数ファイル読み込み
require_once './model/model.php';

session_start();
$user_id = '';
// ユーザ情報（user_idなど)の取得
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
}
// ユーザ名の取得の確認
$login_user = '';
if (isset($user_data[0]['user_name'])) {
  $login_user = $user_data[0]['user_name'];
} else {
  $login_user = 'ゲスト';
}

// 商品情報関連
$request_method = get_request_method();
$msg = [];
$cart_msg = '';
$err_msg = [];
$create_datetime = date('Y-m-d H:i:s');  //作成日時を取得
$update_datetime = date('Y-m-d H:i:s');  //更新日時を取得
$item_list = [];
$img_dir = './image/';
$sql_kind = get_post_data('sql_kind');

// ステータスが公開の商品一覧を取得
// 商品一覧を取得
$link = get_db_connect();
// $item_list = get_public_item_list($link);

// 「カテゴリより検索」ボタンが押された場合の処理
if ($sql_kind === 'search_category' && $request_method === 'POST' ){
	//商品カテゴリが正しくPOSTされているかチェック
	$category_name = get_post_data('category_name');
	$result = check_category($category_name);
	if ($result !== true) {
		$err_msg[] = $result;
	}
	//カテゴリ検索のsql
	$item_list = search_category($link, $category_name);

// 「商品名より検索」ボタンが押された場合の処理
} else if($sql_kind === 'search_word' && $request_method === 'POST'){
	//検索キーワードが正しくPOSTされているかチェック
	$keyword = get_post_data('keyword');
	$result = check_keyword($keyword);
	if ($result !== true) {
		$err_msg[] = $result;
	}
	//カテゴリ検索のsql
	$item_list = search_keyword($link, $keyword);
} else {
	$item_list = get_public_item_list($link);
}
if($sql_kind === 'add_cart' && $request_method === 'POST'){
  $params = array(
    'item_id' => get_post_data('item_id'),
    'user_id' => get_user_id(),
    'amount'  => get_post_data('amount')
  );
  try{
	  $dbh = get_db_connect();
		$cart_msg = add_cart($dbh, $params);
	}catch(PDOException $e){
	  $err_msg[] = $e->getMessage();
	}
}

// カテゴリ検索テンプレート読み込み
include_once './view/category_view.php';

?>
