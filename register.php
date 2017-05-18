<?php
// MVC挑戦中
//設定ファイル読み込み
require_once './conf/setting.php';
//関数ファイル読み込み
require_once './model/model.php';

$err_msg = [];			// エラーメッセージ
$create_datetime = date('Y-m-d H:i:s');    //作成日時を取得
$update_datetime = date('Y-m-d H:i:s');    //更新日時を取得
$request_method = get_request_method();
if ($request_method === 'POST'){
	// 名前が正しく入力されているかチェック
	$user_name = get_post_data('user_name');
	$result = check_user_name($user_name);
	if ($result !== true) {
	  $err_msg[] = $result;
	}
	// emailが正しく入力されているかチェック
	$user_email = get_post_data('user_email');
	$result = check_user_email($user_email);
	if ($result !== true) {
	  $err_msg[] = $result;
	}
	// パスワードが正しく入力されているかチェック
	$user_password = get_post_data('user_password');
	$result = check_user_password($user_password);
	if ($result !== true) {
	  $err_msg[] = $result;
	}
}
// var_dump($err_msg);
$link = get_db_connect();
if ($request_method === 'POST' && count($err_msg) === 0) {

	try {
		$rows = get_check_user_data_register($link, $user_name, $user_email);
		var_dump($rows);
		if (count($rows) === 0)	 {
			insert_post_user_data($link, $user_name, $user_email, $user_password, $create_datetime, $update_datetime);

		} else if (($rows[0]['user_name'] === $user_name && $rows[0]['user_email'] === $user_email) || $rows[0]['user_name'] === $user_name || $rows[0]['user_email'] === $user_email) {
				$err_msg[] = 'そのユーザ名及びメールアドレスはすでに存在します。別のユーザ名及びメールアドレスを入力してください';
		}
	} catch (PDOException $e) {
		$err_msg[] = $e->getMessage();
		// throw $e;
  }
}

// ユーザ名の取得の確認
$login_user = '';
if (isset($user_data[0]['user_name'])) {
  $login_user = $user_data[0]['user_name'];
} else {
  $login_user = 'ゲスト';
}

//新規会員登録テンプレート読み込み
include_once './view/register_view.php';

?>
