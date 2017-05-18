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
							<p>ようこそ<?php print h($login_user); ?>さん。<a href="./index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></p>
							<div class="btn-group header-right" role="group">
									<a href="./cart.php" class="btn btn-default" role="button"><img class="icon-cart" src="img/icon/iconmonstr-shopping-cart_brown-28-240.png">カート</a>
									<a href="./mypage.php" class="btn btn-default" role="button">マイページ</a>
<?php if($user_id === '') { ?>
									<a href="./login.php" class="btn btn-default" role="button">ログイン</a>
<?php } else if ($user_id !== '') { ?>
									<a href="./logout.php" class="btn btn-default" role="button">ログアウト</a>
<?php } ?>
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
			<div class="box box-contact">
				<div class="contact">
					<h3>お問い合わせフォーム</h3>
<?php foreach ($err_msg as $value) { ?>
					<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><?php print $value; ?></p>
<?php } ?>
					<div class="input-group">
						<form method="post" action="contact.php" class="">
							<div>
								<label for="user_name">お名前　　　　　: </label>
								<input type="text" class="" name="user_name" placeholder="名前を入力してください" id="user_name" size="50">
							</div>
							<div>
								<label for="user_email">メールアドレス　: </label>
								<input type="text" class="" name="user_email" placeholder="メールアドレスを入力してください" id="user_email" size="50">
							</div>
							<div>
								<label for="user_tel">電話番号　　　　: </label>
								<input type="text" class="" name="user_tel" placeholder="電話番号を入力してください" id="user_tel" size="50">
							</div>
							<div>
								<label for="user_sex">性別　　　　　　: </label>
								<select name="user_sex" id="user_sex" class="">
									<option value="その他">性別を選択してください</option>
									<option value="男">男</option>
									<option value="女">女</option>
								</select>
							</div>
							<div>
								<label for="user_contact">お問い合わせ項目: </label>
								<select name="user_contact" id="user_contact" class="">
									<option value="その他">お問い合わせ項目を選択してください</option>
									<option value="商品の内容">商品の内容</option>
									<option value="商品の発送">商品の発送</option>
									<option value="感想">感想</option>
									<option value="それ以外">それ以外</option>
								</select>
							</div>
							<div>
								<label for="user_content">お問い合わせ内容: </label>
								<textarea type="text" class="" name="user_content" placeholder="お問い合わせ内容を入力してください" id="user_content" cols="50" rows="5"></textarea>
							</div>
							<input type="hidden" name="sql_kind" value="">
							<!-- <input type="hidden"><a href="mailto:">問い合わせ内容を管理者へ送信する</a> -->
							<a href="mailto:<!-- ここにアドレスを記載 -->?subject=<!-- ここに件名を記載 -->&amp;body=<!-- ここに本文を記載 -->">
								<!-- メールはこちらへ -->
							</a>
							<input type="submit" name="送信する" class="btn btn-default">
						</form>
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
