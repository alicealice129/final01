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
				$('.add_cart').on('submit', function(){
					return window.confirm('本当にこの商品をカートに追加しますか？');
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
			<div class="box box-category">
				<div class="category">
<?php foreach ($err_msg as $value) { ?>
								<p><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><?php print $value; ?></p>
<?php } ?>
					<div class="input-group">
						<form method="post" action="category.php" class="form-inline">
							<input type="text" class="" name="keyword" placeholder="検索キーワード">
							<input type="submit" class="btn btn-default" value="商品名より検索">
							<input type="hidden" name="sql_kind" value="search_word">
						</form>
					</div>
					<div class="input-group">
						<form method="post" action="category.php">
							<label for="category_name">商品カテゴリ: </label>
							<!-- <select name="category_name" id="category_name" class="form-control"> -->
							<select name="category_name" id="category_name" class="">
								<option value="その他">カテゴリを選択してください</option>
								<option value="プレーン">プレーン</option>
								<option value="チョコ">チョコ</option>
								<option value="タルト">タルト</option>
							</select>
							<input type="submit" class="btn btn-default" value="カテゴリより検索">
							<input type="hidden" name="sql_kind" value="search_category">
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<h4>商品一覧</h4>
						<p><?php print $cart_msg; ?></p>
						<div class="tool-section panel panel-danger">
							<!-- <h5>商品情報変更</h5> -->
							<div class="panel-heading">
								検索結果商品一覧
							</div>
							<div class="table-responsive">
								<!-- <div class="">商品一覧</div> -->
								<table class="table table-bordered table-hover">
									<!-- <caption>商品一覧</caption> -->
									<tr class="danger">
										<th>カテゴリ</th>
										<th>商品画像</th>
										<th>商品名</th>
										<th>価格　</th>
										<th>カートに追加しますか？</th>
									</tr>
				<?php foreach ($item_list as $value) { ?>
									<tr <?php if ($value['status'] === 1){print 'class="warning"';}?>>
										<td><?php print h($value['category_name']); ?></td>
										<td><img src="<?php print $img_dir. h($value['item_img']); ?>" class="cupcake-image-size"></td>
										<td class="item-name-width"><?php print h($value['item_name']); ?></td>
										<td class="text-align-right"><?php print h($value['item_price']); ?>円</td>
										<td>
											<form method="post" action="category.php" class="add_cart">
												<input type="submit"  class="btn btn-default" value="カートに追加">
												<input type="hidden" name="item_id" value="<?php print h($value['item_id']); ?>">
												<input type="hidden" name="amount" value="1">
												<input type="hidden" name="sql_kind" value="add_cart">
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
