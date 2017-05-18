<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>EatFruitCupcake</title>
		<link rel="shortcut icon" href="img/icon/cupcakeicon10.ico">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link href="css/fullcalendar.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="./css/index.css">
		<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/sunny/jquery-ui.css" >
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- <script type="text/javascript" src="js/jquery-ui.custom.min.js"></script> -->
	</head>
	<body>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/ZoomPic.js"></script>
		<script src="js/datepicker-ja.js" ></script>
		<script>
			$(document).ready(function(){
				$(".item-list").ZoomPic();
			});
			$(function() {
				$("#datepicker").datepicker();
			})
		</script>
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
								ようこそ<?php print h($login_user); ?>さん。
								<a href="./index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a>
							</p>
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
      <!-- <div id="body"> -->
			<!-- <div class="box">
				<img class="main-picture img-rounded" src="img/top262NR62GT4W.jpg">
			</div> -->
			<div class="box">
				<div class="carousel slide" id="sampleCarousel" data-ride="carousel">
					<ol class="carousel-indicators">
						<li class="active" data-target="#sampleCarousel" data-slide-to="0"></li>
						<li data-target="#sampleCarousel" data-slide-to="1"></li>
						<li data-target="#sampleCarousel" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="./img/top262NR62GT4W.jpg" class="main-picture img-rounded" alt="First slide">
						</div>
						<div class="item">
							<img src="./img/top_cupcake-1966693__480.jpg" class="main-picture img-rounded" alt="Second slide">
						</div>
						<div class="item">
							<img src="./img/cupcake-791117__480.jpg" class="main-picture img-rounded" alt="Third slide">
						</div>
					</div>
					<a class="left carousel-control" href="#sampleCarousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">前へ</span>
					</a>
					<a class="right carousel-control" href="#sampleCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">次へ</span>
					</a>
				</div>
			</div>
			<div class="box middle">
				<nav>
	        <section>

	        </section>
					<section>

					</section>
				</nav>
				<article>
					<div class="text-align-center">
						<p>当サイトは、フルーツに特化した、甘さ控えめのカップケーキ専門店です。</p>
						<p>商品一覧より、お選びください。</p>
						<h3>商品一覧</h3>
<?php if($sql_kind === 'add_cart') { ?>
<?php //foreach($msg as $value){ ?>
						<p><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span><?php print $msg; ?></p>
<?php //} ?>
<?php } ?>
						<form action="index.php" method="post">
							<div class="item-list">
<?php foreach($item_list as $item){ ?>
								<figure>
									<div class="cupcake-image">
										<label for="img-name">
										<img src="<?php print $img_dir. h($item['item_img']); ?>" class="cupcake-image-size img-rounded"></label>
										<figcaption><?php print h($item['item_name']); ?></figcaption>
										<span><?php print h($item['item_price']); ?>円</span>
<?php if($item['item_stock'] > 0) { ?>
										<input type="radio" name="item_id" value="<?php print $item['item_id']; ?>">
<?php } else { ?>
										<span class="label label-danger">売り切れ</span>
<?php } ?>
									</div>
								</figure>
<?php } ?>
							</div>
							<div class="cart-button">
								<img class="icon-cart" src="img/icon/iconmonstr-shopping-cart_brown-28-240.png">
								<input type="submit" class="btn btn-warning" value="カートに入れる">
								<input type="hidden" name="sql_kind" value="add_cart">
								<!-- <input type="hidden" name="item_id" value="
								<?php //print h($item['item_id']);?>"> -->
								<input type="hidden" name="amount" value="1">
								<a class="btn btn-default" href="./cart.php" role="button">カートを見る</a>
							</div>
						</form>
					</div>
				</article>
				<aside>
	        <div class="section_aside">
	          <div class="section_sub_aside">
							<p>
							今日は<?php print $now_year; ?>年<?php print $now_month; ?>月<?php print $now_day; ?>日です
							</p>
							<div id="datepicker"></div>
						</div>
						<section>
							<div class="panel panel-default">
								<div class="panel-heading">
										<h3>生地別カップケーキ</h3>
								</div>
								<div class="panel-body">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span><a href="./category.php">カテゴリ検索</a>より検索
								</div>
								<ul class="list-group nav-list-cupcake">
									<li class="list-group-item"><img class="icon-list" src="img/icon/cupcakeicon1.jpeg">プレーン</li>
									<li class="list-group-item"><img class="icon-list" src="img/icon/cupcakeicon1.jpeg">チョコ</li>
									<li class="list-group-item"><img class="icon-list" src="img/icon/cupcakeicon1.jpeg">タルト</li>
								</ul>
							</div>
						</section>
	          <div class="section_sub_aside">
							<div id="coupon">
								<div id="coupon-btn">今日の運勢は?</div>
							</div>
						</div>
						<script type="text/javascript">
							(function() {
								// 'use strict';
								var coupon_btn = document.getElementById('coupon-btn');
								coupon_btn.addEventListener('click', function(){
									var i;
									var rand = Math.floor(Math.random() * 10);
									// this.textContent = rand;
									if(rand === 0){
										// i = '10%OFF';
										i = '大吉';
									} else if(rand === 1 || rand === 2) {
										// i = '5%OFF';
										i = '中吉';
									} else {
										// i = '割引なし';
										i = '吉';
									}
									this.textContent = i;
								});
								coupon_btn.addEventListener('mousedown', function(){
									this.className = 'pushed';
								});
								coupon_btn.addEventListener('mouseup', function(){
									this.className = '';
								});
							})();
						</script>
	        </div>
	      </aside>
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
