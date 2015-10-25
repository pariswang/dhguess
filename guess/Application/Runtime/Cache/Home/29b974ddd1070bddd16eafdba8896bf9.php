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
			<div class="title" style="padding: 12px 0">My Prize</div>
			<?php if($user["hit"] == 1): ?><div class=" img">
				<div class="img-con">
					<img src="<?php echo (C("app_path")); echo ($product["img"]); ?>" />
				</div>
			</div>
			<?php else: ?>
			<p>You have no prize.</p><?php endif; ?>
		</div>
	</div>
	<?php if($user["hit"] == 1): ?><div class="home-ft" style="padding-top: 20px">
		<div class="btn-bar">
			<a class="btn" style="margin-bottom: 15px" href="<?php echo ($product["link3"]); ?>">Collect my prize</a>
		</div>
				<p>Click ‘GO’ to place an order for this prize, 
				filing in your address without making the payment. </p>
				<p>We’ll take care of the payment part, and arrange 
				for the prize to be shipped to you.</p>
				<p>&nbsp;</p>
				<p>Name: <?php echo ($user["username"]); ?></p>
				<p>Email: <?php echo ($user["email"]); ?></p>
	</div><?php endif; ?>
</div>
<script>document.body.addEventListener('touchstart', function () {});</script>
</body>
</html>