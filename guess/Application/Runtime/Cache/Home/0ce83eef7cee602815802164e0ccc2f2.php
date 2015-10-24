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
		<div class="hd"><h1>Bingo！That’s correct!</h1></div>
		<div class="con">
			<p style="padding-top: 0;font-size: 14px;line-height:22px;text-align: center">Congratulations! You now have the chance to win It.</p>
		</div>
	</div>
	
	<div class="home-ft">
		<div class="btn-bar">
			<button class="btn" id="start">Play the lucky draw</button>
		</div>
	</div>
	
</div>
<script>
$('#start').click(function(){
	var self = this;
	function ani(n){
		$(self).text('DRAW'+(new Array(n+1).join('.')));
		if(n == 0){
			location.href='<?php echo (C("app_path")); ?>/game/draw';
			return;
		}
		setTimeout(function(){
			ani(n-1);
		}, 1000);
	}
	ani(3);
});
</script>
</body>
</html>