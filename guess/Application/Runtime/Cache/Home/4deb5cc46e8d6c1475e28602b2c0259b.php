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
			<h4 class="coupon-title">Coupon</h4>
			<div class="coupon-list">
				<ul class="coupon-list-ul">
					<?php if(is_array($coupons)): $i = 0; $__LIST__ = $coupons;if( count($__LIST__)==0 ) : echo "$empty" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><li>
						<h3 class="us">US$25</h3>
						<div class="coupon-code">
							<h6>Coupon Code</h6>
							<p><?php echo ($co["code"]); ?></p>
						</div>
						<p>
							Business: 商户名称<br>
							Address: 商户地址咯
						</p>
					</li><?php endforeach; endif; else: echo "$empty" ;endif; ?>
				</ul>
			</div>
		</div>
	</div>


	<div class="home-ft" style="padding-top: 20px">
	   
		<div class="btn-bar">
			<a class="btn" style="margin-bottom: 15px" href="http://www.dhgate.com?f=social|guessgame|mycoupon">Use coupon</a>
			
			<a class="btn btn-blue" href="<?php echo (C("app_path")); ?>/game">Have another go</a>
		</div>

	</div>

</div>
</body>
</html>