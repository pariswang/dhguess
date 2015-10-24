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
			<div class="title">Congrats! You won it.</div>
			<div class=" img">
				<div class="img-con">
					<img src="<?php echo (C("app_path")); echo ($product["img"]); ?>" />
				</div>
			</div>
		</div>
	</div>

	<div class="issue-form">
		<div class="form-hd">Fill in your contact information to proceed</div>
		<div class="form-con">
			<div class="ui-form ui-border-t">
				<form action="<?php echo (C("app_path")); ?>/game/draw" method="POST">
					<div class="ui-form-item ui-form-item-pure ui-border-b">
						<input id="username" name="username" type="text" placeholder="Name">
						<a class="ui-icon-close"></a>
					</div>
					<div class="ui-form-item ui-form-item-pure ui-border-b">
						<input id="email" name="email" type="text" placeholder="Email">
						<a class="ui-icon-close"></a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="home-ft">
		<div class="btn-bar" id="submit">
			<button class="btn">submit</button>
		</div>
	</div>

</div>
<script>
$('#submit').click(function(){
	$('form a').text('');
	var u = $('#username').val();
	if(!u){
		$('#username').next().text('Please input your name!');
		return;
	}
	var e = $('#email').val();
	var Regex = /^([0-9A-Za-z-_\.]+)@([0-9a-z]+\.[a-z]{2,3}(\.[a-z]{2})?)$/;
	if(!e){
		$('#email').next().text('Please input your email address!');
		return;
	}
	if( !Regex.test(e) ){
		$('#email').next().text('Email INCORRECT!');
		return;
	}
	$('form').submit();
});
$('form input').focus(function(){
	$('form a').text('');
});
</script>
</body>
</html>