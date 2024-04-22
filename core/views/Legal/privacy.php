<?php
    error_reporting(0);
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo config::getName();?> | Terms</title>
        <?php html::buildHead();?>
    </head>
	<body>
		<?php html::getNavigation();?>
		<div class="container">
		<h3>Privacy Policy</h3>
		<ul>
			<li><b>We store your IP address and e-mail address.</b> We might use it as a unique identifier. We won't give it away.</li>
			<li><b>Your password is hashed. No, we don't give it away.</b> DES is cool.</li>	
			<li><b>We use cookies.</b> If you disable them, the site will break in half. So don't. <small>I mean, you can, but the site won't work.</small></li>
			<li><b>We use Google Analytics and ads.</b> We send the Google people your user ID whenever you visit the site, unless if you have an ad blocker.</li>
			<li>Our server location varies, if that matters at all. It could be hosted in Europe one day, and a random country like Romania the next day. We aren't a (registered) corporation. This is considered a side-project of the creator.</li>
			<li>In the event of a data breach, we'll have a notice up. We also might send out an e-mail if we have the funds for that (because bulk e-mails are expensive).</li>
			<li>In the event we <i>do</i> show something that contains your e-mail or IP address in public, it will be fully or partially blurred.</li>
			<li>We don't sell your info to third-parties.</li>
			<li>Many actions on the Rhodum website are logged. For example, selling a item. They may be visible to staff members, and may contain information like your IP address and username.</li>
			<li>We use Cloudflare! That means everything you do goes through them.</li>
		</ul>
		<p>This page (and its contents) may change without any notice, at any time.</p>
	    </div>
		</div>
		<?php html::buildFooter();?>
	</body>
</html>