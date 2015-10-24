<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>Guess It, Get It - DHGate.com</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo (C("app_path")); ?>/css/style.css" rel="stylesheet" type="text/css"/>
		<script src="<?php echo (C("app_path")); ?>/js/zepto.min.js" type="text/javascript"></script>
        <script src="<?php echo (C("app_path")); ?>/js/fun.js" type="text/javascript"></script>
    </head>
    <body>
<div class="bg"></div>
<div class="main">
	<div class="box-issue">
		<div class="hd"></div>
		<div class="con">
			<div class="title">Oops, you didn’t get the prize, but lucky for you, you won a US $XX coupon!</div>
			
			<div class="btn-bar">
				<a class="btn btn-sm" href="<?php echo ($product["link2"]); ?>">Use my coupon</a>
			</div>
			<p style="text-align: center">You now have <?php echo ($coupons_count); ?> coupons in total</p>
			
		</div>
	</div>

	<div class="home-ft" style="padding-top: 20px">
		<p>
			Click 〝share〞to invite  more friends<br>
			If your friend accepts your invitation, you'll get an
extra play.
		</p>
		<div class="btn-bar">
			<a class="btn btn-green" style="margin-bottom: 15px" href="<?php echo (C("app_path")); ?>/game/share">Share</a>
			<a class="btn btn-blue" href="<?php echo (C("app_path")); ?>/game">Have another go</a>
		</div>
	</div>
</div>
</body>
</html>