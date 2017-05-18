<?php
//設定ファイル読み込み
require_once './conf/setting.php';
//関数ファイル読み込み
require_once './model/model.php';

// リクエストメソッド確認
if (get_request_method()!== 'POST') {
  // POSTでなければログインページへリダイレクト
  header('Location: login.php');
  exit;
}
// セッション開始
session_start();
$err_msg = [];       // エラーメッセージ
// POST値取得
$user_name = get_post_data('user_name');
$result = check_user_name($user_name);
if ($result !== true) {
  $err_msg[] = $result;
}
// パスワードが正しく入力されているかチェック
$user_password = get_post_data('user_password');
$result = check_user_password($user_password);
if ($result !== true) {
  $err_msg[] = $result;
}
// $passwd = get_post_data('passwd'); // パスワード
// ユーザ名をCookieへ保存
// setcookie('email', $email, time() + 60 * 60 * 24 * 365);

// ユーザIDの取得（本来、データベースからメールアドレスとパスワードに応じたユーザIDを取得しますが、今回は省略しています）

// $data[0]['user_id'] = 'codetaro';

if (count($err_msg) === 0) {
	$link = get_db_connect();

	try {
		$user_data= get_check_user_data($link, $user_name, $user_password);

	} catch (PDOException $e) {
		$err_msg[] = $e-> getMessage();
		// throw $e; throwすると終了してしまう
	}
}
// var_dump($user_data);
// exit;
// 登録データを取得できたか確認
if (isset($user_data[0]['user_id'])) {
  // セッション変数にuser_idを保存
  $_SESSION['user_id'] = $user_data[0]['user_id'];

  if ($_SESSION['user_id'] === 1) {
    header('Location: tool.php');
    exit;
  } else {

  // ログイン済みユーザのホームページへリダイレクト
  header('Location: index.php');
  exit;
  }
} else {
	$err_msg[] = 'ログインに失敗しました';
  // ログインページへリダイレクト
	$_SESSION['err_msg'] = $err_msg;
  header('Location: login.php');
  exit;
}

// // ログインセッション
// session_start();
// // セッション変数からログイン済みか確認
// if (isset($_SESSION['user_name'])) {
// // ログイン済みの場合、ホームページへリダイレクト
// 	header('Location: index.php');
// 	exit;
// }
// // Cookie情報からメールアドレスを取得
// if (isset($_COOKIE['user_email'])) {
// 	$user_email = $_COOKIE['user_email'];
// } else {
// 	$user_email = '';
// }
// // Cookie情報からパスワードを取得
// if (isset($_COOKIE['user_password'])) {
// 	$user_password = $_COOKIE['user_password'];
// } else {
// 	$user_password = '';
// }

?>
