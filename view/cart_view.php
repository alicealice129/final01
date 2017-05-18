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
						</div>
						<div class="dummy-header"></div>
						<div class="search-header">
							<p>ようこそ<?php print h($login_user); ?></a>さん。<a href="./index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></p>
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
			<div class="box middle">
				<nav>
	        <section>

	        </section>
					<section>

					</section>
				</nav>
				<article>
<?php foreach($err_msg as $value){ ?>
      		<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><?php print $value; ?></p>
<?php } ?>
<?php foreach($msg as $value){ ?>
      		<p><span class="glyphicon glyphicon-cutlery" aria-hidden="true"></span><?php print $value; ?></p>
<?php } ?>
					<div class="row">
						<div class="col-sm-8">
<?php if(count($cart_list) > 0){ ?>
							<p>現在、ショッピングカートには下記の商品が入っています</p>
							<p>購入する場合は、購入ボタンを押してください。</p>
<?php 	foreach($cart_list as $item) { ?>
							<div class="panel panel-default">
								<div class="panel-heading"><?php print h($item['item_name']); ?></div>
								<div class="panel-body">
									<img class="img item_image cupcake-image-size" src="<?php print $img_dir.h($item['item_img']); ?>">
									<p>価格: <?php print h($item['item_price']); ?>円</p>
									<form method="post" action="cart.php">
										<label>数量:
											<p><input type="text" name="amount" value="<?php print h($item['amount']); ?>"></p>
										</label>
										<p><input type="submit" value="購入数更新" class="btn btn-warning"></p>
										<input type="hidden" name="item_id" value="<?php print h($item['item_id']); ?>">
										<input type="hidden" name="sql_kind" value="update_cart">
									</form>
<?php if($item['amount'] > $item['item_stock']) { ?>
									<p class="alert">在庫が不足しています。購入数量を減らしてください。購入可能数: <?php print h($item['item_stock']); ?></p>
<?php } ?>
									<form method="post" action="cart.php" class="delete">
										<input type="submit" value="この商品をカートから削除" class="btn btn-danger">
										<input type="hidden" name="item_id" value="<?php print h($item['item_id']); ?>">
										<input type="hidden" name="sql_kind" value="delete_cart">
									</form>
								</div>
							</div>
<?php } ?>
						</div>
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-body">
									<p>合計金額:<?php print h(number_format($total_price)); ?>円</p>
									<form method="post" action="result.php">
										<input  type="submit" class="btn btn-primary" value="購入する">
									</form>
								</div>
							</div>
						</div>
<?php } else { ?>
					  	<p>カートに商品がありません。</p>
<?php } ?>
					</div>
				</article>
				<aside>

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
