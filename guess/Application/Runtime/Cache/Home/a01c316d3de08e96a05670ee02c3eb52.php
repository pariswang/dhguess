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
			<ul class="invite-stat">
				<li>
					<h3><?php echo ($user["guess_count"]); ?></h3>
					<p>Remaining plays</p>
				</li>
				<li>
					<h3><?php echo ($question_count); ?></h3>
					<p>NO. of plays </p>
				</li>
			</ul>
			
			<div class="invite-list">
				<div class="invite-list-hd"> You've invited <?php echo ($invite_count); ?> people  </div>
				<ul class="invite-list-ul">
					<?php if(is_array($invites)): foreach($invites as $key=>$vo): ?><li>
							<span><?php echo ($vo["time_str"]); ?></span>
							<?php if($vo["newer_id"] > 0): echo ($vo["name"]); ?> accepts<?php else: ?>Not accept<?php endif; ?>
						</li><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
	</div>


	<div class="home-ft" style="padding-top: 20px">
		<p>
			Click 〝share〞to invite  more friends.<br>
			If your friend accepts your invitation, you'll get an
extra play.
		</p>

		<div class="btn-bar">
			<a class="btn" style="margin-bottom: 15px" href="<?php echo (C("app_path")); ?>/game/share">share</a>
			
			<a class="btn btn-blue" href="<?php echo (C("app_path")); ?>/game">Have another go</a>
		</div>

	</div>

</div>
</body>
</html>