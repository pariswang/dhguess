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
	
	<div class="box-issue off-hd">
		<div class="con">
			<div class="title">What’s this?</div>
			<div class=" img">
				<div class="img-con">
					<img src="<?php echo (C("app_path")); echo ($product["img"]); ?>" />
				</div>
			</div>
			<p>Buyers can receive a refund and keep the item(s) once the item(s) are not as described or possess any quality issues by negotiating directly with the seller.</p>
		</div>
	</div>
	
	<form id="form" method="POST" action="<?php echo (C("app_path")); ?>/game/result">
		<div class="btn-wp">
			<input type="text" class="input-text" name="name" value=""/>
		</div>
		
		<div class="home-ft" id="submit">
			<div class="btn-bar">
				<button class="btn">OK</button>
			</div>
			<p>
				<a href="">You only have one chance for that!</a>
			</p>
			<p>
				<a href="">Too hard? Try some other product</a>
			</p>
		</div>
	</form>
</div>
<script>
$('#submit').click(function(){
	var val = $('input[name=name]').val();
	if(val){
		$('#form').submit();
		return;
	}
	return false;
});
</script>
</body>
</html>