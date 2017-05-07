<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>EatFruitCupcake</title>
		<link rel="shortcut icon" href="img/icon/cupcakeicon10.ico">
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./tool.css">
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
							<h3>全ユーザの購入履歴ページ</h3>
						</div>
						<div class="dummy-header"></div>
						<div class="search-header">
							<p><a href="./userinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザ管理ページ</a></p>
							<p><a href="./tool.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>商品管理ページ</a></p>
							<!-- <p><a href="./resultinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザの購入履歴一覧ページ</a></p> -->
						</div>
					</div><!-- header-top終わり -->
				</div>
	   	</div>
    </header>
    <main id="body-bk">
			<div class="box">
				<p>このページは、商品管理者専用のページです。</p>
				<p>全ユーザの購入履歴を見ることができます。</p>
				<p>検索ボタンで絞り込みも可能です。</p>
				<h4>全ユーザの購入履歴</h4>
				<section class="tool-section">
					<!-- <h5>商品情報変更</h5> -->
					<table>
						<caption>購入履歴一覧</caption>
						<tr>
							<th>ユーザ名</th>
							<th>商品名</th>
							<th>商品画像</th>
							<th>価格</th>
							<th>購入数</th>
							<th>購入日時</th>
						</tr>
<?php //foreach ($data as $value) { ?>
<?php //if($value['status'] === '1') {	?>
						<!-- <tr> -->
<?php //} else {?>
						<!-- <tr class="status-false">
<?php //} ?>
							<form method="post">
								<td><?php //print $value['item_id']; ?></td>
								<td><img src="<?php //print $img_dir. $value['item_img']; ?>"></td>
								<td class="item-name-width"><?php //print $value['item_price']; ?></td>
								<td class="text-align-right"><?php //print $value['item_price']; ?>円</td>
								<td><input type="text" class="input-text-width text-align-right" name="update_stock" value="<?php //print $value['item_stock']; ?>">個&nbsp;&nbsp;<input type="submit"  class="btn btn-default" value="変更"></td>
								<input type="hidden" name="item_id" value="<?php //print $value['item_id']; ?>">
								<input type="hidden" name="sql_kind" value="update">
							</form>
							<form method="post">
<?php //if ($value['status'] === '1') { ?>
								<td><input type="submit" class="btn btn-default"  value="公開 → 非公開"></td>
								<input type="hidden" name="change_status" value="0"> -->
<?php //} else { ?>
								<!-- <td><input type="submit"  class="btn btn-default" value="非公開 → 公開"></td>
								<input type="hidden" name="change_status" value="1"> -->
<?php //} ?>
								<!-- <input type="hidden" name="item_id" value="<?php //print $value['item_id']; ?>">
								<input type="hidden" name="sql_kind" value="change">
							</form> -->
						</tr>
<?php //} ?>
					</table>
				</section>
			</div>
    </main>
    <footer id="footer-fixed">
			<div id="footer-bk">
				<div class="box">
					<ul>
						<li><a href="./site.php">サイトマップ</a></li>
						<li><a href="./policy.php">プライバシーポリシー</a></li>
						<li><a href="./contact.php">お問い合わせ</a></li>
						<li><a href="./help.php">ご利用ガイド</a></li>
					</ul>
					<p><small>Copyright&copy;EatFruitCupcake All Rights Reserved.</small></p>
				</div>
			</div>
		</footer>
	</body>
</html>
