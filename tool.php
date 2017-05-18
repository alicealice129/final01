<?php
// 設定ファイル読み込み
require_once './conf/setting.php';
// 関数ファイル読み込み
require_once './model/model.php';

session_start();

// adminユーザのみログインできるようにする
// その実装が終わってから、表示させる
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

$request_method = get_request_method();
$msg = [];                    // 正常のメッセージ
$err_msg = [];                // エラーメッセージ
$create_datetime = date('Y-m-d H:i:s');  //作成日時を取得
$update_datetime = date('Y-m-d H:i:s');  //更新日時を取得
$img_dir = './image/';
$item_list = [];
$new_img_filename = '';   // アップロードした新しい画像ファイル名
$item_img = '';   // アップロードした新しい画像ファイル名

$sql_kind = get_post_data('sql_kind');
$change_status = get_post_data('change_status');
// 商品登録ボタンが押された場合の処理
if ($sql_kind === 'insert_item' && $request_method === 'POST' ){
	// 商品名が正しく入力されているかチェック
	$item_name = get_post_data('item_name');
	$result = check_item_name($item_name);
	if ($result !== true) {
	  $err_msg[] = $result;
	}
  // 値段が正しく入力されているかチェック
	$item_price = get_post_data('item_price');
	$result = check_item_price($item_price);
	if ($result !== true) {
	  $err_msg[] = $result;
	}
  // 在庫数が正しく入力されているかチェック
	$item_stock = get_post_data('item_stock');
	$result = check_item_stock($item_stock, '在庫');
	if ($result !== true) {
	  $err_msg[] = $result;
	}
	//商品カテゴリが正しく入力されているかチェック
  $category_name = get_post_data('category_name');
  $result = check_category($category_name);
  if ($result !== true) {
    $err_msg[] = $result;
  }
  // 商品画像が正しく選択されているかチェック
  // $item_img = get_post_data('item_img');
  // $result = check_item_img($item_img);
  // $result = check_item_img('item_img');
  // if ($result !== $new_img_filename) {
  //   $err_msg[] = $result;
  // } else if {
  //   $item_img = $new_img_filename;
  // }
  // HTTP POST でファイルがアップロードされたかどうかチェック
  if (is_uploaded_file($_FILES['item_img']['tmp_name']) === TRUE) {
    // 画像の拡張子を取得
    $extension = pathinfo($_FILES['item_img']['name'], PATHINFO_EXTENSION);
    // 指定の拡張子であるかどうかチェック
    if ($extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
      // 保存する新しいファイル名の生成（ユニークな値を設定する）
      $item_img = sha1(uniqid(mt_rand(), true)). '.' . $extension;
      // 同名ファイルが存在するかどうかチェック
      if (is_file($img_dir . $item_img) !== TRUE) {
        // アップロードされたファイルを指定ディレクトリに移動して保存
        if (move_uploaded_file($_FILES['item_img']['tmp_name'], $img_dir . $item_img) !== TRUE) {
            $err_msg[] = 'ファイルアップロードに失敗しました';
          }
        } else {
        $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
      }
    } else {
      $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEG又はPNGのみ利用可能です。';
    }
  } else {
    $err_msg[] = 'ファイルを選択してください';
  }
  //ステータスが正しく入力されているかチェック
  $status = get_post_data('status');
  $result = check_status($status);
  if ($result != true) {
    $err_msg[] = $result;
  }
  // これから登録する商品をitem_masterに挿入
  if(count($err_msg) === 0) {
		try {
    $link = get_db_connect();
		insert_item_data($link, $item_name, $item_price, $item_stock, $item_img, $status, $category_name, $create_datetime, $update_datetime);
  	$msg[] = '新規商品の登録が完了しました!!';
		} catch(PDOException $e) {
	    $err_msg[] = $e->getMessage();
		}
	}
}

// 在庫数更新ボタンが押された場合の処理
if ($sql_kind === 'update_stock' && $request_method === 'POST'){
  // 在庫数が正しく入力されているかチェック
	$item_stock = get_post_data('item_stock');
	$result = check_item_stock($item_stock, '在庫');
	if ($result !== true) {
	  $err_msg[] = $result;
  }
  // 商品IDが正しくPOSTされているかチェック
  $item_id = get_post_data('item_id');
  if(count($err_msg) === 0) {
		try {
	    $link = get_db_connect();
			update_item_stock($link, $item_stock, $update_datetime, $item_id);
			$msg[] = '在庫数を変更しました!!';
		} catch (PDOException $e) {
	    $err_msg = $e->getMessage();
	  }
  }
}
// ステータスボタン(公開→非公開(0)または非公開→公開(1))が押された場合
if ($sql_kind === 'change_item_status' && $request_method === 'POST') {
  // 商品IDが正しくPOSTされているかチェック
  $item_id = get_post_data('item_id');
  //ステータスが正しく入力されているかチェック
  $status = get_post_data('change_status');
  $result = check_status($status);
  if ($result != true) {
    $err_msg[] = $result;
  }

  if(count($err_msg) === 0) {
		try {
	    $link = get_db_connect();
	    change_item_status($link, $status, $update_datetime, $item_id);
			$msg[] = 'ステータスを変更しました!!';
	  } catch (PDOException $e) {
	    $err_msg[] = $e->getMessage();
	  }
	}
}
// 「この商品を削除」ボタンが押された場合の処理
if ($sql_kind === 'delete_item' && $request_method === 'POST'){
	// 商品IDが正しくPOSTされているかチェック
  $item_id = get_post_data('item_id');
	if(count($err_msg) === 0){
		try {
			$link = get_db_connect();
			delete_item($link, $item_id);
			$msg[] = 'この商品を削除しました';
		} catch (PDOException $e) {
	    $err_msg[] = $e->getMessage();
	  }
	}
}
// 商品一覧を取得
$link = get_db_connect();
$item_list = get_all_item_list($link);
// var_dump($item_list);

// 商品管理ページテンプレート読み込み
include_once './view/tool_view.php';
?>
