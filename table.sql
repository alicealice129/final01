-- DB名：cupcake
-- ①商品情報テーブル(item_master)　−>　自動販売機で販売する商品情報
CREATE TABLE ec_item_master (
  item_id INT(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  item_name VARCHAR(255) NOT NULL COMMENT '商品名',
  item_price INT(11) NOT NULL COMMENT '値段',
  item_img VARCHAR(255) NOT NULL COMMENT '商品の画像ファイル名',
  status INT(11) NOT NULL	COMMENT '公開ステータス（0:非公開、1:公開)',
  item_stock INT(11) NOT NULL COMMENT '在庫数',
  create_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'レコードの作成日',
  update_datetime datetime not null default current_timestamp on update current_timestamp COMMENT 'レコードの更新日',
  primary key(item_id)
);
-- ②カートテーブル(ec_cart)　−>　購入予定の商品情報
DROP TABLE ec_cart;
CREATE TABLE ec_cart (
  cart_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'カートID',
  user_id INT(11) NOT NULL COMMENT 'ユーザID',
  item_id INT(11) NOT NULL COMMENT '商品ID',
  amount INT(11) NOT NULL COMMENT '購入予定商品数',
  create_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'レコードの作成日',
  update_datetime datetime not null default current_timestamp on update current_timestamp COMMENT 'レコードの更新日',
  primary key(cart_id)
);
-- ③ユーザテーブル(ec_user)　−>　ユーザ情報
-- user_nameとuser_emailはユニークに設定する！
CREATE TABLE ec_user (
  user_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザID',
  user_name VARCHAR(255) NOT NULL COMMENT 'ユーザ名',
  user_email VARCHAR(255) NOT NULL COMMENT 'メールアドレス',
  user_password VARCHAR(255) NOT NULL COMMENT 'パスワード',
  create_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'レコードの作成日',
  update_datetime datetime not null default current_timestamp on update current_timestamp COMMENT 'レコードの更新日',
  primary key(user_id)
);
-- ④購入履歴テーブル(ec_item_history)　−>　商品を購入した履歴情報
-- やり直し！
CREATE TABLE ec_item_history (
  history_id INT(11) NOT NULL AUTO_INCREMENT COMMENT '履歴ID',
  user_id INT(11) NOT NULL COMMENT 'ユーザID',
  item_id INT(11) NOT NULL COMMENT '商品ID',
  -- item_price
  create_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'レコードの作成日',
  primary key(history_id)
);
-- ⑤お気に入りテーブル(ec_item_favorite)　−>　ユーザがお気に入りボタンを押すことによって挿入されたお気に入り情報
CREATE TABLE ec_item_favorite (
  favorite_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'お気に入りID',
  user_id INT(11) NOT NULL COMMENT 'ユーザID',
  item_id INT(11) NOT NULL COMMENT '商品ID',
  create_datetime DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'レコードの作成日',
  update_datetime datetime not null default current_timestamp on update current_timestamp COMMENT 'レコードの更新日',
  primary key(favorite_id)
);


-- ２回目やり直し！！
-- ①商品情報テーブル(item_master)　−>　自動販売機で販売する商品情報
DROP TABLE ec_item_master;
CREATE TABLE ec_item_master (
  item_id INT(11) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  item_name VARCHAR(255) NOT NULL COMMENT '商品名',
  item_price INT(11) NOT NULL COMMENT '値段',
  item_img VARCHAR(255) NOT NULL COMMENT '商品の画像ファイル名',
  status INT(11) NOT NULL	COMMENT '公開ステータス（0:非公開、1:公開)',
  item_stock INT(11) NOT NULL COMMENT '在庫数',
  create_datetime DATETIME NOT NULL COMMENT 'レコードの作成日',
  update_datetime datetime not null COMMENT 'レコードの更新日',
  primary key(item_id)
);
-- ②カートテーブル(ec_cart)　−>　購入予定の商品情報
DROP TABLE ec_cart;
CREATE TABLE ec_cart (
  cart_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'カートID',
  user_id INT(11) NOT NULL COMMENT 'ユーザID',
  item_id INT(11) NOT NULL COMMENT '商品ID',
  amount INT(11) NOT NULL COMMENT '購入予定商品数',
  create_datetime DATETIME NOT NULL COMMENT 'レコードの作成日',
  update_datetime datetime not null COMMENT 'レコードの更新日',
  primary key(cart_id)
);
-- ③ユーザテーブル(ec_user)　−>　ユーザ情報
-- user_nameとuser_emailはユニークに設定する！
DROP TABLE ec_user;
CREATE TABLE ec_user (
  user_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザID',
  user_name VARCHAR(255) NOT NULL COMMENT 'ユーザ名',
  user_email VARCHAR(255) NOT NULL COMMENT 'メールアドレス',
  user_password VARCHAR(255) NOT NULL COMMENT 'パスワード',
  create_datetime DATETIME NOT NULL COMMENT 'レコードの作成日',
  update_datetime datetime not null COMMENT 'レコードの更新日',
  primary key(user_id)
);
-- ④購入履歴テーブル(ec_item_history)　−>　商品を購入した履歴情報
DROP TABLE ec_item_history;
CREATE TABLE ec_item_history (
  history_id INT(11) NOT NULL AUTO_INCREMENT COMMENT '履歴ID',
  user_id INT(11) NOT NULL COMMENT 'ユーザID',
  item_id INT(11) NOT NULL COMMENT '商品ID',
  item_price INT(11) NOT NULL COMMENT '値段',
  create_datetime DATETIME NOT NULL COMMENT 'レコードの作成日',
  update_datetime datetime not null COMMENT 'レコードの更新日',
  primary key(history_id)
);
-- ⑤お気に入りテーブル(ec_item_favorite)　−>　ユーザがお気に入りボタンを押すことによって挿入されたお気に入り情報
DROP TABLE ec_item_favorite;
CREATE TABLE ec_item_favorite (
  favorite_id INT(11) NOT NULL AUTO_INCREMENT COMMENT 'お気に入りID',
  user_id INT(11) NOT NULL COMMENT 'ユーザID',
  item_id INT(11) NOT NULL COMMENT '商品ID',
  create_datetime DATETIME NOT NULL COMMENT 'レコードの作成日',
  update_datetime datetime not null COMMENT 'レコードの更新日',
  primary key(favorite_id)
);
