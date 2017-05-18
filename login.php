<?php
// MVC挑戦中
//設定ファイル読み込み
require_once './conf/setting.php';
//関数ファイル読み込み
require_once './model/model.php';


// ログインプロセス
// セッション開始
session_start();
$err_msg = [];       // エラーメッセージ

if (isset($_SESSION['err_msg'])) {
  $err_msg = $_SESSION['err_msg'];  //配列にそのまま代入する
  unset($_SESSION['err_msg']);
}


// ユーザ名の取得の確認
$login_user = '';
if (isset($user_data[0]['user_name'])) {
  $login_user = $user_data[0]['user_name'];
} else {
  $login_user = 'ゲスト';
}

//新規会員登録テンプレート読み込み
include_once './view/login_view.php';

?>
