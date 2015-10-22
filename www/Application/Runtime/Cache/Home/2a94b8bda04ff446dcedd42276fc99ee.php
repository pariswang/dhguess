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
<div class="main home">
	<div class="motif-bg"></div>
	<div class="home-ft">
		<p><span>5</span> more chances remaining</p>
		<div class="btn-bar">
			<button class="btn">START!</button>
		</div>
		<p>
			<a href="<?php echo (C("app_path")); ?>/my/invite">Invitation sent</a><span class="line"> | </span><a href="<?php echo (C("app_path")); ?>/my/coupon">My coupons</a>
			<span class="line"> | </span>
			<a href="<?php echo (C("app_path")); ?>/my/prize">My prizes</a>
		</p>
	</div>
</div>
<script>
$('.btn').click(function(){
	location.href = '<?php echo (C("app_path")); ?>/game';
});
</script>
</body>
</html>