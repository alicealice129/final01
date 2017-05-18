<?php
// $create_datetime = date('Y-m-d H:i:s');    //作成日時を取得

/**
* リクエストメソッドを取得
* @return str GET/POST/PUTなど
*/
function get_request_method() {
  return $_SERVER['REQUEST_METHOD'];
}
/**
* 特殊文字をHTMLエンティティに変換する
* @param str $str 変換文字
* @return str 変換後文字
*/
function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
}
/**
* 初期化、検査、受け取り($POSTデータを取得)
* @param str $key 配列キー
* @return str POST値   変換後文字
*/
function get_post_data($key) {
  // まずは初期化、issetの処理をしたら受け取る
  $str = '';
  if(isset($_POST[$key]) === TRUE) {
    $str = $_POST[$key];
  }
  return $str;
}
/**
* 前後の空白を削除
* @param str $str 文字列
* @return str 前後の空白を削除した文字列
*/
function trim_space($str) {
  return preg_replace('/\A[　\s]*|[　\s]*\z/u', '', $str);
}
/**
* チェック関数
*/
function check_input($value) {
  if($value === '') {
    // return false;
    return 'いずれか選択してください';
  }
  return true;
}

/**
* 名前が正しく入力されているかチェック
* @param str $user_name 名前
* @return mixed
*/
function check_user_name($user_name) {
  $name_regex = '/^[a-zA-Z0-9]{6,}$/';
  trim_space($user_name);
  if (mb_strlen($user_name) === 0){
    return '名前を入力してください';
  } else if ((mb_strlen($user_name) < 6) || preg_match($name_regex, $user_name) !== 1){
    return '名前は6文字以上の半角英数字で入力してください';
  } else {
    return true;
  }
}
/**
* パスワードが正しく入力されているかチェック
* @param str $user_password 名前
* @return mixed
*/
function check_user_password($user_password) {
  $password_regex = '/^[a-zA-Z0-9]{6,}$/';
  trim_space($user_password);
  if (mb_strlen($user_password) === 0){
    return 'パスワードを入力してください';
  } else if ((mb_strlen($user_password) < 6) || preg_match($password_regex, $user_password) !== 1){
    return 'パスワードは6文字以上の半角英数字で入力してください';
  } else {
    return true;
  }
}
/**
* emailが正しく入力されているかチェック
* @param str $user_password 名前
* @return mixed
*/
function check_user_email($user_email) {
  $email_regex = '/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/iD';
  trim_space($user_email);
  if (mb_strlen($user_email) === 0){
    return 'メールアドレスを入力してください';
  } else if (preg_match($email_regex, $user_email) !== 1){
    return 'メールアドレスは正しい形式で入力してください';
  } else {
    return true;
  }
}
/**
* 商品名が正しく入力されているかチェック
* @param str $item_name 名前
* @return mixed
*/
function check_item_name($str) {
  $str = trim_space($str);
  if (mb_strlen($str) === 0){
    return '商品名を入力してください';
  } else if (mb_strlen($str) > 20){
    return '商品名は20文字以内で入力してください';
  } else {
    return true;
  }
}
/**
* 値段が正しく入力されているかチェック
* @param str $item_price 名前
* @return mixed
*/
function check_item_price($str) {
  $price_regex = '/\A[0]\z|\A[1-9][0-9]+\z/';
  $str = trim_space($str);
  if (mb_strlen($str) === 0){
    return '値段を入力してください';
  } else if (mb_strlen($str) > 7 || preg_match($price_regex, $str) !== 1){
    return '値段は7桁以内の数値で入力してください';
  } else {
    return true;
  }
}
/**
* 在庫が正しく入力されているかチェック
* @param str $item_stock 名前
* @return mixed
*/
function check_item_stock($str, $key) {
  $stock_regex = '/\A[0]\z|\A[1-9][0-9]+\z/';
  $str = trim_space($str);
  if (mb_strlen($str) === 0){
    // return '値段を入力してください';
    return $key .'を入力してください';
  } else if (mb_strlen($str) > 7 || preg_match($stock_regex, $str) !== 1){
    return $key .'は7桁以内の数値で入力してください';
  } else {
    return true;
  }
}
/**
* 商品カテゴリをチェック
*/
function check_category($value){
  // if(preg_match('/\A[0123]\z/', $value) !== 1) {
  if($value !== 'その他' && $value !== 'プレーン' && $value !== 'チョコ' && $value !== 'タルト') {
    return '商品カテゴリが不正です';
  } else if ($value === 'その他'){
    return '商品カテゴリは下記の3種類のいずれかを選択してください';
  } else {
    return true;
  }
}
/**
* 画像が正しく選択されているかチェック
* @param str $item_img 名前
* @return mixed
*/
function check_item_img($name) {
  $new_img_filename = '';
  // HTTP POST でファイルがアップロードされたかどうかチェック
  if (is_uploaded_file($_FILES[$name]['tmp_name']) === TRUE) {
    // 画像の拡張子を取得
    $extension = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
    // 指定の拡張子であるかどうかチェック
    if ($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
      // 保存する新しいファイル名の生成（ユニークな値を設定する）
      $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
      // 同名ファイルが存在するかどうかチェック
      if (is_file($img_dir . $new_img_filename) !== TRUE) {
        // アップロードされたファイルを指定ディレクトリに移動して保存
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
            return 'ファイルアップロードに失敗しました';
        }
        } else {
        return 'ファイルアップロードに失敗しました。再度お試しください。';
      }
    } else {
      return 'ファイル形式が異なります。画像ファイルはJPEG又はPNGのみ利用可能です。';
    }
  } else {
    return 'ファイルを選択してください';
  }
  return $new_img_filename;
}
/**
* ステータスをチェック
*/
function check_status($value){
  if(preg_match('/\A[01]\z/', $value) !== 1) {
    return '公開ステータスが不正です';
  } else {
    return true;
  }
}
/**
* 数量が正しく入力されているかチェック
* @param str $item_stock 名前
* @return mixed
*/
function check_item_amount($str) {
  $amount_regex = '/\A[0]\z|\A[1-9][0-9]+\z/';
  $str = trim_space($str);
  if (preg_match($amount_regex, $str) !== 1){
    return '数量は正の整数で入力してください';
  } else {
    return true;
  }
}
/**
* 検索キーワードが正しく入力されているかチェック
* @param str $item_name 名前
* @return mixed
*/
function check_keyword($str) {
  $str = trim_space($str);
  if (mb_strlen($str) === 0){
    return '検索キーワードを入力してください';
  } else if (mb_strlen($str) > 20){
    return '検索キーワードは20文字以内で入力してください';
  } else {
    return true;
  }
}
/**
* DBハンドルを取得
* @return obj $dbh DBハンドル
*/
function get_db_connect() {

  try {
    //データベースに接続
    $dbh = new PDO(DSN, DB_USER, DB_PASSWD);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch (PDOException $e) {
    return $err_msg = '接続できませんでした。理由: '.$e->getMessage();
  }
  return $dbh;
}
/**
* クエリを実行しその結果を配列で受け取る
*
* @param obj $dbh, DBハンドル
* @param str $sql SQL文
* @return  array  配列結果データ
* select文実行のための関数
*/
function get_as_array($link, $sql) {

  // try {
    //SQL文を実行する準備
    $stmt = $link->prepare($sql);
    //SQLを実行
    $stmt->execute();
    //レコードの取得
    $rows = $stmt->fetchAll();
  // } catch (PDOException $e) {
  //   return '接続できませんでした。理由: '.$e->getMessage();
  // }

  return $rows;
}
/**
* insertを実行する
*
* @param obj $link DBハンドル
* @param str SQL文
* @return bool
*/
function insert_db($dbh, $sql) {
  try {
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQLを実行
    $stmt->execute();
  } catch (PDOException $e) {
    throw $e;
  }
  return true;
}
// register.php関連
/**
* 変数5つ用いてDBにレコード挿入
*
* @param obj  $dbh DBハンドル
* @param str  $sql SQL文,bindする値を?で二つ指定してください
* @param str  $p1 bindする値その１
* @param str  $p2 bindする値その２
* @param str  $p3 bindする値その３
* @param str  $p4 bindする値その４
*/
function set_as_record($dbh, $sql, $p1, $p2, $p3, $p4, $p5) {

  try {
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $p1, PDO::PARAM_STR);
    $stmt->bindValue(2, $p2, PDO::PARAM_STR);
    $stmt->bindValue(3, $p3, PDO::PARAM_STR);
    $stmt->bindValue(4, $p4, PDO::PARAM_STR);
    $stmt->bindValue(5, $p5, PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
  } catch (PDOException $e) {
    throw $e;
  }
}
/**
* 新規ユーザを登録する
*
* @param obj $link DBハンドル
* @param str $goods_name 商品名
* @param int $price 価格
* @return bool
*/
function insert_post_user_data($link, $user_name, $user_email,$user_password, $create_datetime, $update_datetime) {

  // SQL生成
  // $sql = 'INSERT INTO test_drink_master(drink_name, price) VALUES(\'' . $drink_name . '\', ' . $price . ')';
  $sql = 'INSERT INTO ec_user (user_name, user_email, user_password, create_datetime, update_datetime)
          VALUES (?, ?, ?, ?, ?)';
  // クエリ実行
  // return insert_db($link, $sql);
  set_as_record($link, $sql, $user_name, $user_email, $user_password, $create_datetime, $update_datetime);
}
/**
* これから登録しようとしているユーザがすでに存在しているかどうかをユーザ名とアカウントで確認する。
* アカウント情報を取得する
* @param obj $dbh DBハンドル
* @param $user_name
* @param $user_email
* @return array コメントの一覧配列データ
*/
function get_check_user_data_register($link, $user_name, $user_email) {
  //SQL生成
  $sql = 'SELECT user_name, user_email
          FROM ec_user
          WHERE user_name = ?
            AND user_email = ?';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
  $stmt->bindValue(2, $user_email, PDO::PARAM_STR);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}

/**
* ログインしようとしているユーザが、すでに登録済みの場合のみログインできるようにする。ユーザ名とメールアドレス、パスワードで確認する。
* アカウント情報を取得する
* @param obj $dbh DBハンドル
* @param $user_name
* @param $user_password
* @return array コメントの一覧配列データ
*/
function get_check_user_data($link, $user_name, $user_password) {
  //SQL生成
  $sql = 'SELECT user_id
          FROM ec_user
          WHERE user_name = ?
            AND user_password = ?';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
  $stmt->bindValue(2, $user_password, PDO::PARAM_STR);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}
/**
* ログインしたログインIDに基づく、ユーザ情報を取得する
* @param obj $dbh DBハンドル
* @param $user_id
* @return array コメントの一覧配列データ
*/
function get_login_user_data($link, $user_id) {
  //SQL生成
  $sql = 'SELECT user_name
          FROM ec_user
          WHERE user_id = ?';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}
/**
* 登録済みのユーザ情報一覧を取得する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function get_all_user_data($link) {
  //SQL生成
  $sql = 'SELECT user_id, user_name, user_email, user_password, create_datetime
          FROM ec_user';
  $rows = get_as_array($link, $sql);
  // // SQL文を実行する準備
  // $stmt = $link->prepare($sql);
  // $stmt->execute();
  // // レコードの取得
  // $rows = $stmt->fetchAll();
  return $rows;
}
/**
* 新規商品を登録する
*
* @param obj $link DBハンドル
* @param str $goods_name 商品名
* @param int $price 価格
* @return bool
*/
function insert_item_data($link, $item_name, $item_price, $item_stock, $item_img, $status, $category_name, $create_datetime, $upadte_datedate) {
    // SQL生成
    $sql = 'INSERT INTO ec_item_master (item_name, item_price, item_stock, item_img, status, category_name, create_datetime, update_datetime)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    // SQL文を実行する準備
    $stmt = $link->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $item_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $item_price, PDO::PARAM_STR);
    $stmt->bindValue(3, $item_stock, PDO::PARAM_STR);
    $stmt->bindValue(4, $item_img, PDO::PARAM_STR);
    $stmt->bindValue(5, $status, PDO::PARAM_STR);
    $stmt->bindValue(6, $category_name, PDO::PARAM_STR);
    $stmt->bindValue(7, $create_datetime, PDO::PARAM_STR);
    $stmt->bindValue(8, $upadte_datedate, PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    // return '新規商品の登録が完了しました!!';
    return true;
}
/**
* 商品の一覧を取得する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function get_all_item_list($dbh) {
  //SQL生成
  $sql = 'SELECT item_id, item_name, item_price, item_stock, category_name, item_img, status FROM ec_item_master ORDER BY item_id DESC';
  //クエリ実行
  return get_as_array($dbh, $sql);
}
/**
* 在庫数を変更する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function update_item_stock($dbh, $item_stock, $update_datetime, $item_id) {
    //SQL生成
    $sql = 'UPDATE ec_item_master
            SET item_stock = ?, update_datetime = ?
            WHERE item_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $item_stock,    PDO::PARAM_STR);
    $stmt->bindValue(2, $update_datetime, PDO::PARAM_STR);
    $stmt->bindValue(3, $item_id, PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    return true;
}
/**
* ステータスを変更する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function change_item_status($dbh, $status, $update_datetime, $item_id) {
    //SQL生成
    $sql = 'UPDATE ec_item_master
            SET status = ?, update_datetime = ?
            WHERE item_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $status,    PDO::PARAM_STR);
    $stmt->bindValue(2, $update_datetime, PDO::PARAM_STR);
    $stmt->bindValue(3, $item_id, PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    return true;
}
/**
* 商品管理テーブルより商品をを削除する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function delete_item($dbh, $item_id) {
    //SQL生成
    $sql = 'DELETE FROM ec_item_master
            WHERE item_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $item_id,    PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    return true;
}
/**
* 公開中の商品の一覧を取得する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function get_public_item_list($dbh) {
  try {
    //SQL生成
    $sql = 'SELECT item_id, item_name, item_price, item_stock, item_img, status, category_name
            FROM ec_item_master
            WHERE status = 1';
    //SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    //SQLを実行
    $stmt->execute();
    //レコードの取得
    $rows = $stmt->fetchAll();
    return $rows;
  } catch (PDOException $e) {
    return $err_msg = '接続できませんでした。理由: '.$e->getMessage();
  }
}
/**
*  引数を取得する
* @param obj $dbh DBハンドル
* @return array
*/
function get_as_param($dbh, $sql, $params){
  $stmt = $dbh->prepare($sql);
  $stmt->execute($params);
  if($stmt->rowCount() > 0){
    $result = $stmt->fetch();
    return $result[0];
  }
  return false;
}
/**
*  カートテーブルよりカートの数量を取得する
* @param obj $dbh DBハンドル
* @return array
*/
function get_cart_amount($dbh, $user_id, $item_id) {
  $sql = 'SELECT amount
          FROM ec_cart
          WHERE user_id = :user_id AND item_id = :item_id';
  // $stmt->bindValue('name', $user_name, PDO::PARAM_STR);
  // $stmt->bindValue('user_comment', $user_comment, PDO::PARAM_STR);
  $check_params = array(
    'user_id' => $user_id,
    'item_id' => $item_id
  );
  return get_as_param($dbh, $sql, $check_params);
}
/**
*  商品一覧より、カートに商品を追加する
* @param obj $dbh DBハンドル
* @return array
*/
function add_cart($dbh, $params) {
  $amount = get_cart_amount($dbh, $params['user_id'], $params['item_id']);
  if($amount === false){
    $insert_params =$params;
    $insert_params['create_datetime'] = date('Y-m-d H:i:s');
    // $insert_params['create_datetime'] = $create_datetime;
    $insert_params['update_datetime'] = date('Y-m-d H:i:s');
    // $insert_params['update_datetime'] = $update_datetime;
    $msg = insert_cart($dbh, $insert_params);
    return $msg;
  } else {
    $update_params = $params;
    // $update_params['update_datetime'] = $update_datetime;
    $update_params['update_datetime'] = date('Y-m-d H:i:s');
    $update_params['amount'] = (int)$params['amount'] + $amount;
    $msg = update_cart($dbh, $update_params);
    return $msg;
  }
}
function update_cart($dbh, $params) {
  try {
    //SQL生成
    $sql = 'UPDATE ec_cart
            SET amount = ?, update_datetime = ?
            WHERE user_id = ? AND item_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $params['amount'],    PDO::PARAM_STR);
    $stmt->bindValue(2, $params['update_datetime'], PDO::PARAM_STR);
    $stmt->bindValue(3, $params['user_id'], PDO::PARAM_STR);
    $stmt->bindValue(4, $params['item_id'], PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    $msg = 'カートの数を更新しました';
    return $msg;
  } catch (PDOException $e) {
      return $err_msg = $e->getMessage();
    // throw $e;
  }
}
function insert_cart($dbh, $params) {
  try {
    // $sql = 'INSERT INTO ec_cart (user_id, item_id, amount, create_datetime, update_datetime)
    //         VALUES(:user_id, :item_id, :amount, :create_datetime, :update_datetime)';
    // // SQL文を実行する準備
    // $stmt = $dbh->prepare($sql);
    // // SQLを実行
    // $stmt->execute($params);

    // SQL生成
    $sql = 'INSERT INTO ec_cart (user_id, item_id, amount, create_datetime, update_datetime)
            VALUES (?, ?, ?, ?, ?)';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $params['user_id'], PDO::PARAM_STR);
    $stmt->bindValue(2, $params['item_id'], PDO::PARAM_STR);
    $stmt->bindValue(3, $params['amount'], PDO::PARAM_STR);
    $stmt->bindValue(4, $params['create_datetime'], PDO::PARAM_STR);
    $stmt->bindValue(5, $params['update_datetime'], PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    return $msg = '商品をカートに追加しました!!';
  } catch (PDOException $e) {
    // throw $e;
    return $err_msg = $e->getMessage();
  }
  // return true;
}
/**
*  カートテーブルよりカートの内容を取得する
* @param obj $dbh DBハンドル
* @return array
*/
function get_cart_list($dbh) {
  $sql = 'SELECT
            ec_cart.item_id,
            ec_cart.amount,
            ec_item_master.item_name,
            ec_item_master.item_price,
            ec_item_master.item_img,
            ec_item_master.item_stock
          FROM ec_cart
          INNER JOIN ec_item_master
          ON ec_cart.item_id = ec_item_master.item_id
          WHERE user_id = :user_id';
  // $stmt->bindValue('name', $user_name, PDO::PARAM_STR);
  // $stmt->bindValue('user_comment', $user_comment, PDO::PARAM_STR);
  $params = array(
    'user_id' => get_user_id()
  );
  return get_as_arraylist($dbh, $sql, $params);
}

/**
*  引数を取得する
* @param obj $dbh DBハンドル
* @return array
*/
function get_as_arraylist($dbh, $sql, $params = array()){
  $stmt = $dbh->prepare($sql);
  $stmt->execute($params);
  if($stmt->rowCount() > 0){
    return $stmt->fetchAll();
  }
  return array();
}
/**
*  合計金額を取得する
* @param obj $dbh DBハンドル
* @return array
*/
function get_total_price($cart_list){
  $sum = 0;
  foreach($cart_list as $item){
    $sum += $item['item_price'] * $item['amount'];
  }
  return $sum;
}
/**
* カートテーブルよりカートに入っている商品を削除する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function delete_cart_item($dbh, $params) {
  try {
    //SQL生成
    $sql = 'DELETE FROM ec_cart
            WHERE user_id = ? AND item_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $params['user_id'], PDO::PARAM_STR);
    $stmt->bindValue(2, $params['item_id'], PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    $msg = 'この商品を削除しました';
    return $msg;
  } catch (PDOException $e) {
    return $err_msg =  $e->getMessage();
    // throw $e;
  }
}
function update_cart_amount($dbh, $params) {
  try {
    //SQL生成
    $sql = 'UPDATE ec_cart
            SET amount = ?, update_datetime = ?
            WHERE user_id = ? AND item_id = ?';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $params['amount'],    PDO::PARAM_STR);
    $stmt->bindValue(2, $params['update_datetime'], PDO::PARAM_STR);
    $stmt->bindValue(3, $params['user_id'], PDO::PARAM_STR);
    $stmt->bindValue(4, $params['item_id'], PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    $msg = 'カートの数を更新しました';
    return $msg;
  } catch (PDOException $e) {
    return $err_msg = $e->getMessage();
    // throw $e;
  }
}
// 購入履歴の挿入
function insert_history($dbh, $params){
  // try {
  $sql = 'INSERT INTO ec_item_history(user_id, item_id, amount, item_price, create_datetime)
          VALUES(?, ?, ?, ?, ?)';
  // SQL文を実行する準備
  $stmt = $dbh->prepare($sql);
  // SQL文のプレースホルダに値をバインド
  $stmt->bindValue(1, $params['user_id'], PDO::PARAM_STR);
  $stmt->bindValue(2, $params['item_id'], PDO::PARAM_STR);
  $stmt->bindValue(3, $params['amount'], PDO::PARAM_STR);
  $stmt->bindValue(4, $params['item_price'], PDO::PARAM_STR);
  $stmt->bindValue(5, $params['create_datetime'], PDO::PARAM_STR);
  // SQLを実行
  $stmt->execute();
  // return true;
  // } catch (PDOException $e) {
    // throw $e;
    // return $e->getMessage();
  // }
}

function delete_cart($dbh){
  // try {
    //SQL生成
    $sql = 'DELETE FROM ec_cart
            WHERE user_id = ?';
    $delete_params = array('user_id' => get_user_id());
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    $stmt->bindValue(1, $delete_params['user_id'], PDO::PARAM_STR);
    // SQLを実行
    $stmt->execute();
    // return true;
  // } catch (PDOException $e) {
  //   return $e->getMessage();
  //   // throw $e;
  // }
}
/**
* カテゴリ検索を行う
* @param obj $dbh DBハンドル
* @param $category_name
* @return array 検索画面
*/
function search_category($link, $category_name) {
  //SQL生成
  $sql = 'SELECT item_id, item_name, item_price, item_stock, item_img, status, category_name
          FROM ec_item_master
          WHERE category_name = ?';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $category_name, PDO::PARAM_STR);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}
/**
* 単語検索を行う
* @param obj $dbh DBハンドル
* @param $category_name
* @return array 検索画面
*/
function search_keyword($link, $keyword) {
  //SQL生成
  $sql = 'SELECT item_id, item_name, item_price, item_stock, item_img, status, category_name
          FROM ec_item_master
          WHERE category_name LIKE ? OR item_name LIKE ?';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $category_name = "%".$keyword."%";
  $stmt->bindValue(1, $category_name, PDO::PARAM_STR);
  $keyword =  "%".$keyword."%";
  $stmt->bindValue(2, $keyword, PDO::PARAM_STR);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}
/**
* 全ユーザの購入履歴情報一覧を取得する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function get_all_purchase_data($link) {
  //SQL生成
  $sql = 'SELECT
            ec_user.user_id,
            ec_user.user_name,
            ec_item_master.item_name,
            ec_item_master.item_img,
            ec_item_history.item_price,
            ec_item_history.amount,
            ec_item_history.create_datetime
          FROM ec_item_history
          INNER JOIN ec_item_master
          ON ec_item_history.item_id = ec_item_master.item_id
          INNER JOIN ec_user
          ON ec_item_history.user_id = ec_user.user_id';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}
/**
* ログインユーザの購入履歴情報一覧を取得する
* @param obj $dbh DBハンドル
* @return array コメントの一覧配列データ
*/
function get_my_purchase_data($link, $user_id) {
  //SQL生成
  $sql = 'SELECT
            ec_user.user_name,
            ec_item_master.item_name,
            ec_item_master.item_img,
            ec_item_history.item_price,
            ec_item_history.amount,
            ec_item_history.create_datetime
          FROM ec_item_history
          INNER JOIN ec_item_master
          ON ec_item_history.item_id = ec_item_master.item_id
          INNER JOIN ec_user
          ON ec_item_history.user_id = ec_user.user_id
          WHERE ec_user.user_id = ?';
  // SQL文を実行する準備
  $stmt = $link->prepare($sql);
  $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  return $rows;
}

// カレンダーを作成
function get_calendar() {
  // 現在の年月を取得
  $year = date('Y');
  $month = date('n');
  // 月末日を取得
  $last_day = date('j', mktime(0, 0, 0, $month + 1, 0, $year));

  $calendar = array();
  $j = 0;

  // 月末日までループ
  for ($i = 1; $i < $last_day + 1; $i++) {
    // 曜日を取得
    $week = date('w', mktime(0, 0, 0, $month, $i, $year));
    // 1日の場合
    if ($i == 1) {
      // 1日目の曜日までをループ
      for ($s = 1; $s <= $week; $s++) {
        // 前半に空文字をセット
        $calendar[$j]['day'] = '';
        $j++;
      }
    }
    // 配列に日付をセット
    $calendar[$j]['day'] = $i;
    $j++;
    // 月末日の場合
    if ($i == $last_day) {
      // 月末日から残りをループ
      for ($e = 1; $e <= 6 - $week; $e++) {
          // 後半に空文字をセット
          $calendar[$j]['day'] = '';
          $j++;
      }
    }
  }
}


//ログイン関連

/**
 * ログインしているかどうかのチェック
 * @return bool ログインしていればtrue
 */
function login_check(){
  if(isset($_SESSION['user_id']) === true){
    return true;
  }
  return false;
}

/**
 * ログインidの取得
 * @return int user_idの値
 */
function get_user_id(){
    return $_SESSION['user_id'];
}
//配列内の各変数をバリデーション
function check_params($params){
  $validate_flg = true;
  foreach($params as $key => $value){
    if(validate($key, $value) === false){
      $validate_flg = false;
    }
  }
  return $validate_flg;
}
?>
