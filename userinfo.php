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
							<h3>ユーザ情報一覧ページ</h3>
						</div>
						<div class="dummy-header"></div>
						<div class="search-header">
							<p><a href="./tool.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>商品管理ページ</a></p>
							<!-- <p><a href="./userinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザ管理ページ</a></p> -->
							<p><a href="./resultinfo.php"><span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>ユーザの購入履歴一覧ページ</a></p>
						</div>
					</div><!-- header-top終わり -->
				</div>
	   	</div>
    </header>
    <main id="body-bk">
			<div class="box">
				<p>このページは、商品管理者専用のページです。</p>
				<p>下記は、ユーザ情報一覧となっています</p>
				<p>取り扱いには注意してください</p>
				<h4>ユーザ情報一覧</h4>
				<section>
					<table>
						<!-- <caption>ユーザ情報一覧</caption> -->
						<tr>
							<th>ユーザID</th>
							<th>ユーザ名</th>
							<th>パスワード</th>
							<!-- パスワードを伏せる方法を考える -->
							<th>登録日時</th>
						</tr>
						<tr>
								<td><?php //print $value['user_id']; ?></td>
								<td><?php //print $value['user_name']; ?></td>
								<td><?php //print $value['password']; ?></td>
								<td><?php //print $value['create_datetime']; ?></td>
						</tr>
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
