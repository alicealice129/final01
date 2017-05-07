<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>EatFruitCupcake</title>
		<link rel="shortcut icon" href="img/icon/cupcakeicon10.ico">
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./index.css">
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
							<p>ようこそ<?php //print h($user_name); ?>プリントphp</a>さん。<a href="./index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></p>
							<div class="btn-group header-right" role="group">
									<a href="./favor.php" class="btn btn-default" role="button"><span class="glyphicon glyphicon-star" aria-hidden="true"></span>お気に入り</a>
									<a href="./cart.php" class="btn btn-default" role="button"><img class="icon-cart" src="img/icon/iconmonstr-shopping-cart_brown-28-240.png">カート</a>
									<a href="./mypage.php" class="btn btn-default" role="button">マイページ</a>
<?php //if(ログアウトしてたらまたはログインしていなかったら) { ?>
									<a href="./login.php" class="btn btn-default" role="button">ログイン</a>
<?php //} else if (ログインしたら) { ?>
									<a href="./logout.php" class="btn btn-default" role="button">ログアウト</a>
<?php //} ?>
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
      <!-- <div id="body"> -->
			<div class="box">
				<img class="main-picture" src="img/top262NR62GT4W.jpg">
			</div>
			<div class="box middle">
				<nav>
	        <section>
	          <div class="background_color_white">
							<h3 class="dish-pic">フルーツ別カップケーキ</h3>
							<ul>
								<li><a href="#" class="cupcake-pic">オレンジ</a></li>
								<li><a href="#" class="cupcake-pic">ストロベリー</a></li>
								<li><a href="#" class="cupcake-pic">バナナ</a></li>
								<li><a href="#" class="cupcake-pic">ブルーベリー</a></li>
								<li><a href="#" class="cupcake-pic">マンゴー</a></li>
								<li><a href="#" class="cupcake-pic">ミックス</a></li>
								<li><a href="#" class="cupcake-pic">ラズベリー</a></li>
								<li><a href="#" class="cupcake-pic cupcake-pic-last">レーズン</a></li>
							</ul>
	          </div>
	        </section>
					<section>
						<div class="background_color_white">
							<h3 class="dish_pic">生地別カップケーキ</h3>
							<ul>
								<li><a href="#" class="arrow_pic">プレーン</a></li>
								<li><a href="#" class="arrow_pic">チョコ</a></li>
								<li><a href="#" class="arrow_pic">紅茶</a></li>
								<li><a href="#" class="arrow_pic arrow_pic_last">タルト生地</a></li>
							</ul>
						</div>
					</section>
				</nav>
				<article>
					<div class="text-align-center">
						<p>当サイトは、フルーツに特化した、甘さ控えめのカップケーキ専門店です。</p>
						<p>商品一覧より、お選びください。</p>
						<p>商品一覧</p>
						<div class="item-list">
							<figure>
								<div class="cupcake-image">
									<img src="./img/orangecupcake-1201424__480.jpg" class="cupcake-image-size">
									<figcaption>オレンジカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/strawberrycupcakes-697445__480.jpg" class="cupcake-image-size">
									<figcaption>ストロベリーカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/orangecupcake-1201424__480.jpg" class="cupcake-image-size">
									<figcaption>バナナカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/blueberry-muffins-1839247__480.jpg" class="cupcake-image-size">
									<figcaption>ブルーベリーカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/mangomuffins-1624198__480.jpg" class="cupcake-image-size">
									<figcaption>マンゴーカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/the-cake-1268126__480.jpg" class="cupcake-image-size">
									<figcaption>ミックスカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/rasberrycupcake-983360__480.jpg" class="cupcake-image-size">
									<figcaption>ラズベリーカップケーキ</figcaption>
								</div>
							</figure>
							<figure>
								<div class="cupcake-image">
									<img src="./img/blueberrybaked-goods-1839259__480.jpg" class="cupcake-image-size">
									<figcaption>レーズンカップケーキ</figcaption>
								</div>
							</figure>
						</div>
					</div>
				</article>
				<aside>
	        <div class="section_aside">
	          <div class="section_sub_aside">
							カレンダー挿入
							floralwhite　#FFFAF0
						</div>
	          <div class="section_sub_aside"></div>
	        </div>
	      </aside>
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
