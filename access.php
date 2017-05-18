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
$err_msg = [];
$create_datetime = date('Y-m-d H:i:s');  //作成日時を取得
$update_datetime = date('Y-m-d H:i:s');  //更新日時を取得
$item_list = [];

$sql_kind = get_post_data('sql_kind');



// カテゴリ検索テンプレート読み込み
include_once './view/access_view.php';

?>
