<?php
//設定ファイル読み込み
require_once './conf/setting.php';
//関数ファイル読み込み
require_once './model/model.php';

session_start();//未ログインならloginへ。
if(login_check() === false){
  header('Location: ./login.php');
  exit;
};
//POSTでなければログイン画面へ。
// if(get_request_method() !== 'POST'){
//   header('Location: ./login.php');
//   exit;
// }
$user_id = '';
if (isset($_SESSION['user_id']) === TRUE) {
  // ログイン済みの場合
  $user_id = $_SESSION['user_id'];
  //データベースに接続して、ログインユーザの情報を得る
  $link = get_db_connect();
  try {
  	$user_data= get_login_user_data($link, $user_id);
    $login_user = $user_data[0]['user_name'];
  } catch (PDOException $e) {
  	$err_msg[] = $e-> getMessage();
  	// throw $e; throwすると終了してしまう
  }
}
$err_msg = []; //エラーメッセージ
$user_id = get_user_id();
$msg = [];
$img_dir = './image/';
$create_datetime = date('Y-m-d H:i:s');
$update_datetime = date('Y-m-d H:i:s');

//商品一覧を取得
try {
  $dbh = get_db_connect();
  $cart_list = get_cart_list($dbh);
  //トランザクション開始
  $dbh->beginTransaction();
  try {
    // 各商品の購入処理
    foreach($cart_list as $item) {
      if ($item['item_stock'] - $item['amount'] < 0) {
        throw new Exception($item['item_name']. 'の在庫が足りません。');
      }
      // 商品在庫の更新
      $new_stock = $item['item_stock'] - $item['amount'];
      $params = array(
        'item_id' => $item['item_id'],
        'stock' => $item['item_stock'] - $item['amount'],
        'update_datetime' => $update_datetime
      );
      // update_item_stock($dbh, $param);
      update_item_stock($dbh, $params['stock'], $params['update_datetime'], $item['item_id']);
      // $msg = '在庫数を変更しました';

      //購入履歴のinsert
      $params = array(
        'user_id' => get_user_id(),
        'item_id' => $item['item_id'],
        'amount'  => $item['amount'],
        'item_price' => $item['item_price'],
        'create_datetime' => $create_datetime,
        'update_datetime' => $update_datetime
      );
      insert_history($dbh, $params);

      //購入商品をセッションに保存
      // set_flush('cart_list', $cart_list);
    }
    //購入処理が全て完了したらカート内容を削除 (foreachが終わった後)
    delete_cart($dbh);
    //コミット
    $dbh->commit();
      // commitされたら必ず実行される
    // if ($result1 === true && $result2 === true) {
    $msg = '商品の購入が完了しました。';
    // }
   } catch(Exception $e){
    //ロールバック
    $dbh->rollback();
    //例外をスロー
    throw $e;
  }
} catch(Exception $e) {
  $err_msg[] = $e->getMessage();
  // var_dump($err_msg);
  // set_flush_err_msg();
  // header('Location: ./cart.php');
  exit;
}
$total_price = get_total_price($cart_list);

//購入結果ページテンプレート読み込み
include_once './view/result_view.php';

?>
