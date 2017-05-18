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
						</div>
						<div class="dummy-header"></div>
						<div class="search-header">
							<p>
								ようこそ<?php print h($login_user); ?></a>さん。
								<a href="./index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
							</p>
							<div class="input-group">
								<span class="input-group-btn">
									<img class="icon-header" src="img/icon/cupcakeicon1.jpeg" />
								</span>
							</div>
						</div>
					</div><!-- header-top終わり -->
					<div class="header-list">
		        <ul>
		          <li><a href="./index.php" class="logo-color">ホーム</a></li>
		          <li><a href="./category.php" class="logo-color">カテゴリ検索</a></li>
							<li><a href="./access.php" class="logo-color">アクセス</a></li>
							<li><a href="./contact.php" class="logo-color">お問い合わせ</a></li>
		        </ul>
		      </div>
					<!-- header-list終わり -->
				</div>
	   	</div>
    </header>
    <main id="body-bk">
			<div class="box box-login">
				<div class="logout">
					<p>ログアウトしました。</p>
					<a href="./login.php">ログインページへ</a>
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
					<p><small>Copyright&copy;LoveFruitCupcake All Rights Reserved.</small></p>
				</div>
			</div>
		</footer><!-- footer-fixed終わり -->
	</body>
</html>
