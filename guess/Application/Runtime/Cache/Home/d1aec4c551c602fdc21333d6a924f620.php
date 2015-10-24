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
		<div class="hd"><h1>How much is it?</h1></div>
		<div class="con">
			<div class=" img">
				<div class="img-con">
					<img src="<?php echo (C("app_path")); echo ($product["img"]); ?>" />
				</div>
			</div>
			<p>Buyers can receive a refund and keep the item(s) once the item(s) are not as described or possess any quality issues by negotiating directly with the seller.</p>
		</div>
	</div>
	
	<div class="btn-wp">
		<ul class="btn-list">
			<?php if(is_array($product["price"])): foreach($product["price"] as $key=>$p): ?><li><a href="javascript:;" val="<?php echo ($key); ?>"><?php echo ($p); ?></a></li><?php endforeach; endif; ?>
		</ul>
	</div>
	
	<div class="home-ft">
		<form id="form" method="POST" action="<?php echo (C("app_path")); ?>/game/result">
			<input type=hidden id="select" name="select" value=""/>
		</form>
		<div class="btn-bar" id="submit">
			<button class="btn">OK<?php echo ($product["right_price"]); ?>|<?php echo ($product["count"]); ?></button>
		</div>
		<p>
			<a href="javascript:;">You only have one chance for that!</a>
		</p>
		<p>
			<a href="javascript:;">Too hard? Try some other product</a>
		</p>
	</div>
	
</div>
<script>
$('.btn-list li a').click(function(){
	$('.btn-list li a').removeClass('select');
	$(this).addClass('select');
});
$('#submit').click(function(){
	var sel = $('.btn-list a.select').attr('val');
	if(sel){
		$('#select').val(sel);
		$('#form').submit();
		return;
	}
});
</script>
</body>
</html>