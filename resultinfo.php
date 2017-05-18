<?php
// 設定ファイル読み込み
require_once './conf/setting.php';
// 関数ファイル読み込み
require_once './model/model.php';

session_start();

// adminユーザのみログインできるようにする
// ログインしていないなら、ログイン画面へ
if(login_check() === false) {
  header('Location: ./login.php');
  exit;
}

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

$err_msg = [];
$img_dir = './image/';
try {
  $link = get_db_connect();
  $all_purchase_data = get_all_purchase_data($link);
} catch(PDOException $e){
  $err_msg = $e->getMessage();
}


// 全ユーザの購入履歴一覧ページテンンプレート読み込み
include_once './view/resultinfo_view.php';

?>
