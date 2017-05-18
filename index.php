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
    // var_dump($data['user_name']);

  } catch (PDOException $e) {
  	$err_msg[] = $e-> getMessage();
  	// throw $e; throwすると終了してしまう
  }
} else {
  // $user_id = 'ゲスト';
}

// Cookie情報からユーザ名を取得
//ログインページのみ
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

// 商品情報関連
$request_method = get_request_method();
$msg = [];
$err_msg = [];
$create_datetime = date('Y-m-d H:i:s');  //作成日時を取得
$update_datetime = date('Y-m-d H:i:s');  //更新日時を取得
$item_list = [];
$img_dir = './image/';
// ステータスが公開の商品一覧を取得
// 商品一覧を取得
$link = get_db_connect();
$item_list = get_public_item_list($link);

// カートに追加する処理
$sql_kind = get_post_data('sql_kind');
// var_dump($user_data['user_id']);
// var_dump($user_data);
if($sql_kind === 'add_cart' && $request_method === 'POST'){
  // ログインしてなかったら、ログイン画面に戻る
  if ($user_id === '') {

    // セッション変数にuser_idを保存
    // $_SESSION['user_id'] = $user_data['user_id'];

    //それ専用のページ
    // ログインしてない時は、他のページをinclude_onceで読み込ませると良い
    header('Location: login.php');
    exit;
  }
  // // 商品IDが正しくPOSTされているかチェック
  // $item_id = get_post_data('item_id');
  // $item_id = check_input($item_id);
  // if ($item_id != true) {
  //   $err_msg[] = $item_id;
  // }
  // // ログインしているユーザIDを受けとる
  // $user_id = get_user_id();
  // $user_id = check_input($user_id);
  // if ($user_id != true) {
  //   $err_msg[] = $user_id;
  // }
  // // カートに入れる数量が正しくPOSTされているかチェック
  // $amount = get_post_data('amount');
  // $amount = check_input($amount);
  // if ($user_id != true) {
  //   $err_msg[] = $user_id;
  // }
  $params = array(
    'item_id' => get_post_data('item_id'),
    'user_id' => get_user_id(),
    'amount'  => get_post_data('amount')
  );
  // var_dump($params['item_id']);
  try{
    // if(check_params($params) === true){
    // if(count($err_msg) === 0) {
      $link = get_db_connect();
      //商品を一個追加。
      $msg = add_cart($link, $params);
      // $msg = '商品をカートに入れました。';
    // }

  }catch(PDOException $e){
    $err_msg = $e->getMessage();
  }
}

// get_calendar();
$now_year = date("Y"); // 現在の年を取得
$now_month = date("n"); // 在の月を取得
$now_day = date("j"); // 現在の日を取得
// 曜日の配列作成
$weekday = array( "日", "月", "火", "水", "木", "金", "土" );
// 1日の曜日を数値で取得
$fir_weekday = date( "w", mktime( 0, 0, 0, $now_month, 1, $now_year ) );

//トップページテンプレート読み込み
include_once './view/index_view.php';
?>
