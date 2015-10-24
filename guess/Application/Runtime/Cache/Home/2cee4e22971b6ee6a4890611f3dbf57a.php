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
			<p>
				<label>分享链接: </label> http://<?php echo ($_SERVER['SERVER_NAME']); echo (C("app_path")); ?>/invite/<?php echo ($code); ?>
			</p>
			<p>
				Copy and paste the above invitation code to invite
your friend . If your friend accepts your invitation, 
you'll get an extra play. 
			</p>
		</div>
	</div>

	<div class="home-ft">
		<div class="btn-bar">
			<a class="btn" style="margin-bottom: 15px" href="<?php echo (C("app_path")); ?>/my/invite"><?php echo ($invite_count); ?> invitations sent</a>
			<a class="btn btn-blue" href="<?php echo (C("app_path")); ?>/game">在玩一次</a>
		</div>
	</div>
</div>
</body>
</html>