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
<div class="main home">
	<div class="motif-bg"></div>
	<div class="home-ft">
		<?php if($user["guess_count"] > 0): ?><p><span><?php echo ($user["guess_count"]); ?></span> more chances remaining</p><?php endif; ?>
		<div class="btn-bar">
			<button class="btn">START!</button>
		</div>
		<p>
			<a href="<?php echo (C("app_path")); ?>/my/invite">Invitation sent</a><span class="line"> | </span><a href="<?php echo (C("app_path")); ?>/my/coupon">My coupons</a>
			<span class="line"> | </span>
			<a href="<?php echo (C("app_path")); ?>/my/prize">My prizes</a>
		</p>
	</div>
</div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '150753891946509',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<script>
$('.btn').click(function(){
<?php if($logined): if($user['guess_count'] < 0): ?>alert('You have no more chance, invite your friends to earn chance.');
	<?php else: ?>
	location.href = '<?php echo (C("app_path")); ?>/game';<?php endif; ?>
<?php else: ?>
FB.login(function(response){
	FB.api('/me', function(response) {
		console.log(JSON.stringify(response));
		response.name
		$.post('<?php echo (C("app_path")); ?>/index/fb',response,function(d){
			if(d.ok){
			location.href = '<?php echo (C("app_path")); ?>/game';
			}
		},'json');
	});
});<?php endif; ?>
});
</script>
<script>document.body.addEventListener('touchstart', function () {});</script>
</body>
</html>