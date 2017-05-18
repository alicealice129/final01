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
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
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
							<h3 class="admin">全ユーザの購入履歴ページ</h3>
						</div>
						<div class="dummy-header"></div>
						<div class="search-header">
							<p><a href="./userinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザ情報一覧ページ</a></p>
							<p><a href="./tool.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>商品管理ページ</a></p>
							<p><a class="btn btn-default" href="./logout.php" role="button">ログアウト</a></p>
						</div>
					</div><!-- header-top終わり -->
				</div>
	   	</div>
    </header>
    <main id="body-bk">
			<div class="box">
				<p>このページは、商品管理者専用のページです。</p>
				<p>全ユーザの購入履歴を見ることができます。</p>
				<!-- <p>検索ボタンで絞り込みも可能です。</p> -->
				<h4>全ユーザの購入履歴</h4>
				<section class="tool-section">
					<div class="table-responsive">
<?php foreach($err_msg as $value) { ?>
						<p><?php print $err_msg; ?></p>
<?php } ?>
						<table class="table table-bordered table-hover">
							<!-- <caption>ユーザ情報一覧</caption> -->
							<tr class="danger">
							<!-- <tr> -->
								<th>ユーザID</th>
								<th>ユーザ名</th>
								<th>商品名</th>
								<th>商品画像</th>
								<th>価格</th>
								<th>購入数</th>
								<th>購入日時</th>
							</tr>
<?php if (count($err_msg) === 0) { ?>
<?php foreach($all_purchase_data as $value) { ?>
							<!-- <tr class="warning"> -->
							<tr>
									<td><?php print h($value['user_id']); ?></td>
									<td><?php print h($value['user_name']); ?></td>
									<td><?php print h($value['item_name']); ?></td>
									<td><img src="<?php print $img_dir. h($value['item_img']); ?>" class="cupcake-image-size"></td>
									<td><?php print h($value['item_price']); ?></td>
									<td><?php print h($value['amount']); ?></td>
									<td><?php print h($value['create_datetime']); ?></td>
							</tr>
<?php  } ?>
<?php  } ?>
						</table>
					</div>
				</section>
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
