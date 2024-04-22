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
		<h3>Rules</h3>
		<ul>
			<li>No uploading copyrighted content.</li>
			<li>No immaturity. Seems like a stupid rule but we actually <b>do</b> ban for this. This is subjective, of course, so it's up to the mod/admin.</li>
			<li>No drama. Or at least keep it to a minimum.</li>
			<li>No exploiting, hacking, or any other skiddy term you want to use to describe the act of exploiting. Yes, this includes IP trackers on the forum.</li>
			<li>No bullying.</li>
			<li>Use common sense.</li>
			<li>Go read our <a href="https://rhodum.xyz/Legal/terms">Terms of Service</a> and <a href="https://rhodum.xyz/Legal/privacy">Privacy Policy. It's in plain English, we swear.</a>
		</ul>
		<p>Note that just because something isn't listed here doesn't mean that it's not against the rules.</p>
	    </div>
		</div>
		<?php html::buildFooter();?>
	</body>
</html>