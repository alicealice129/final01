<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>EatFruitCupcake</title>
		<link rel="shortcut icon" href="img/icon/cupcakeicon10.ico">
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
		<script src="js/jquery-3.2.1.min.js"></script>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script>
			$(function(){
				$('.delete').on('submit', function(){
					return window.confirm('本当にこの商品を削除しますか？');
				});
			});
		</script>
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

    <header class="header-fixed">
	  	<div id="header-bk">
		    <div id="header">
					<div class="header-top">
						<div class="logo-header">
							<a href="./index.php">
								<img class="icon-header" src="img/icon/cupcakeicon1.jpeg">
								<img class="logo-header-img" src="img/cupcakelogo.png">
							</a>
							<p>フルーツカップケーキ専門店</p>
							<h3 class="admin">商品管理ページ</h3>
						</div>
						<div class="dummy-header"></div>
						<div class="search-header">
							<p><a href="./userinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザ情報一覧ページ</a></p>
							<p><a href="./resultinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザの購入履歴一覧ページ</a></p>
							<p><a class="btn btn-default" href="./logout.php" role="button">ログアウト</a></p>
						</div>
					</div><!-- header-top終わり -->
				</div>
	   	</div>
    </header>
    <main id="body-bk">
			<div class="box">
				<p>このページは、商品管理者専用のページです。</p>
				<h3>商品販売管理ツール</h3>
<?php foreach ($err_msg as $value) { ?>
								<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><?php print $value; ?></p>
<?php } ?>
<?php foreach ($msg as $value) { ?>
								<p><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span><?php print $value; ?></p>
<?php } ?>
				<!-- <div class="row"> -->
      		<!-- <div class="col-sm-4"> -->
						<div class="tool-section panel panel-danger">
							<!-- <h5>新規商品追加</h5> -->
							<div class="panel-heading">
								新規商品追加
							</div>
							<div class="panel-body">
								<form class="form-responsive" action="tool.php" method="post" enctype="multipart/form-data">
									<div class="input-group">
										<label for="item_name">名前:  </label>
										<input type="text" name="item_name" id="item_name" class="" placeholder="20文字以内" size="30">
									</div>
									<div class="input-group">
										<label for="item_price">価格: </label>
										<input type="text" name="item_price" id="item_price" class="" placeholder="7桁以内">円
									</div>
									<div class="input-group">
										<label for="item_stock">個数: </label>
										<input type="text" name="item_stock" id="item_stock" class="" placeholder="7桁以内">個
									</div>
									<div class="input-group">
										<label for="category_name">商品カテゴリ: </label>
										<select name="category_name" id="category_name" class="">
											<option value="その他">カテゴリを選択してください</option>
											<option value="プレーン">プレーン</option>
											<option value="チョコ">チョコ</option>
											<option value="タルト">タルト</option>
										</select>
									</div>
									<div class="input-group">
										<label for="item_img">商品画像 </label>
										<input type="file" name="item_img" id="item_img" class="" placeholder="20文字以内">
									</div>
									<div class="input-group">
										<label for="status">ステータス: </label>
										<select name="status" id="status" class="">
											<option value="0">非公開</option>
						          <option value="1">公開</option>
										</select>
						      </div>
									<input type="hidden" name="sql_kind" value="insert_item">
									<div><input type="submit" class="btn btn-default" value="■■■商品登録■■■"></div>
								</form>
							</div>
						<!-- </div> -->
					<!-- </div> -->
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4>商品一覧</h4>
						<div class="tool-section panel panel-danger">
							<!-- <h5>商品情報変更</h5> -->
							<div class="panel-heading">
								商品情報変更
							</div>
							<div class="table-responsive">
								<!-- <div class="">商品一覧</div> -->
								<table class="table table-bordered table-hover">
									<!-- <caption>商品一覧</caption> -->
									<tr class="danger">
										<th>商品ID</th>
										<th>カテゴリ</th>
										<th>商品画像</th>
										<th>商品名</th>
										<th>価格　</th>
										<th>在庫数</th>
										<th>ステータス(操作)</th>
									</tr>
<?php foreach ($item_list as $value) { ?>
									<tr <?php if ($value['status'] === 1){print 'class="warning"';}?>>
										<td><?php print h($value['item_id']); ?></td>
										<td><?php print h($value['category_name']); ?></td>
										<td><img src="<?php print $img_dir. h($value['item_img']); ?>" class="cupcake-image-size"></td>
										<td class="item-name-width"><?php print h($value['item_name']); ?></td>
										<td class="text-align-right"><?php print h($value['item_price']); ?>円</td>
										<td>
											<form method="post" action="tool.php">
												<label>数量: </label>
												<input type="text" class="input-text-width text-align-right" name="item_stock" value="<?php print h($value['item_stock']); ?>">個&nbsp;&nbsp;</label>
												<input type="submit"  class="btn btn-default" value="在庫数更新">
												<input type="hidden" name="item_id" value="<?php print h($value['item_id']); ?>">
												<input type="hidden" name="sql_kind" value="update_stock">
											</form>
										</td>
										<td>
											<form method="post" action="tool.php">
<!-- ステータスが非公開だったら -->
<?php if ($value['status'] === 0) { ?>
												<input type="submit" class="btn btn-default"  value="非公開 → 公開">
												<input type="hidden" name="change_status" value="1">
												<input type="hidden" name="sql_kind" value="change_item_status">
<?php } else { ?>
												<input type="submit"  class="btn btn-default" value="公開 → 非公開">
												<input type="hidden" name="change_status" value="0">
												<input type="hidden" name="sql_kind" value="change_item_status">
<?php } ?>
												<input type="hidden" name="item_id" value="<?php print h($value['item_id']); ?>">
											</form>
											<form method="post" action="tool.php" class="delete">
												<input type="submit" class="btn btn-default" value="この商品を削除">
												<input type="hidden" name="item_id" value="<?php print h($value['item_id']); ?>">
												<input type="hidden" name="sql_kind" value="delete_item">
											</form>
										</td>
									</tr>
<?php } ?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
    </main>
    <footer id="footer-fixed">
			<div id="footer-bk">
				<div class="box">
					<ul>
						<li><a href="./index.php">ホーム</a></li>
						<li><a href="./category.php">カテゴリ検索</a></li>
						<li><a href="./access.php">アクセス</a></li>
						<li><a href="./contact.php">お問い合わせ</a></li>
					</ul>
					<p><small>Copyright&copy;EatFruitCupcake All Rights Reserved.</small></p>
				</div>
			</div>
		</footer>
	</body>
</html>
