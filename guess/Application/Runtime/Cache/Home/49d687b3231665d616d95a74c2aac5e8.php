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
		<div class="hd"><h1>Information submitted!</h1></div>
		<div class="con">
			<p>
				<label>Name: </label> <?php echo ($username); ?>
			</p>
			<p>
				<label>Email: </label> <?php echo ($email); ?>
			</p>
			<p>
				Click ‘GO’ to place an order for this prize, 
filing in your address without making the payment. 
We’ll take care of the payment part, and arrange 
for the prize to be shipped to you.
Or collect the prize by clicking on 〞My prize〞located 
on the home page after you have played all rounds .
			</p>
		</div>
	</div>

	<div class="home-ft">
		<div class="btn-bar">
			<a class="btn" style="margin-bottom: 15px" href="<?php echo ($product["link3"]); ?>">Go</a>
			<a class="btn btn-blue" href="<?php echo (C("app_path")); ?>/game">在玩一次</a>
		</div>
	</div>

</div>
</body>
</html>