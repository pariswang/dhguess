<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title>Guess It, Get It - DHGate.com</title>
		<meta property="og:title" content="Guess It, Get It" />
		<meta property="og:site_name" content="DHGate.com"/>
		<meta property="og:url" content="http://campaign.dhgate.com/guess" />
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
			<div class="title">Your friend <?php echo ($inviter["name"]); ?> is now competing in a guessing price
game. He thinks the game  is amazing, and  he's suggesting
you have a try. Guess it , get it!</div>                   
		</div>
	</div>

	<div class="home-ft" style="padding-top: 20px">
		<p style="margin-bottom: 10px;font-size: 14px;">You just guessed right, it is possible to receive free goods</p>
		<div class="btn-bar">
			<button class="btn" style="margin-bottom: 15px">Accept</button>
			<a class="btn btn-blue" href="<?php echo (C("app_path")); ?>">Have another go</a>
		</div>
	</div>
</div>
<script>
$('.btn').click(function(){
<?php if(is_array($invite['help_info'])): ?>location.href = "<?php echo (C("app_path")); ?>/game/helpguess";
<?php else: ?>
location.href = "<?php echo (C("app_path")); ?>";<?php endif; ?>
});
</script>
<script>document.body.addEventListener('touchstart', function () {});</script>
</body>
</html>