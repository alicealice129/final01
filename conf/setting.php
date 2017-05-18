<?
define('HTML_CHARACTER_SET', 'UTF-8');    //HTML文字エンコーディング
define('DB_CHARACTER_SET', 'UTF-8');      //DB文字エンコーディング
//データベースの接続情報
define('DB_HOST', 'localhost');
define('DB_USER', 'root');   //MySQLのユーザ名　
define('DB_PASSWD', 'root');    //MySQLのパスワード　
define('DB_NAME', 'cupcake');   // MySQLのDB名
// define('DSN', 'mysql:dbname=camp;host=localhost');  //データベースのDSN情報
define('DSN', 'mysql:dbname=cupcake;host=localhost');  //データベースのDSN情報
// define('DSN', 'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARACTER_SET);  //データベースのDSN情報

define('IMG_DIR', './img/');   // 画像ファイル保存ディレクトリ
?>
