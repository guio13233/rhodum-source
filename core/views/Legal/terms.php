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
		<h3>Terms of Service</h3>
		<p>None of us at Rhodum are lawyers, so we don't speak legalese. We don't have money to hire one, either. Let's make this clear and easy for the both of us.</p>
		<p>By using the Rhodum website, you agree to the following terms.</p>
		<ul>
			<li>You must be 13 years of age or older to use or register for Rhodum.</li>
			<li>Rhodum is not responsible for any user actions. A lot of content on the Rhodum website is user-generated.</li>
			<li>You must not excessively scrape the Rhodum website.</li>
			<li>You must not spam the website with invalid requests.</li>
			<li>You must not create a new account in the event you receive a moderation action (which includes, but is not exclusive to a warning, ban, or permanent ban).</li>
			<li>You must not link to or engage in the transmission of unlawful content to the Rhodum website.</li>
			<li>If your account gets compromised, you will not receive any compensation.</li>
			<li>If the Rhodum team receives payment for any goods or services (or any other monetary transaction), it is final.</li>
			<li>Don't sue us.</li>
			<li>We kinda own the stuff on the site, unless if it belongs to another person/corporation/object.</li>
			<li>These terms may change at any time, with or without notice.</li>
		</ul>
	    </div>
		</div>
		<?php html::buildFooter();?>
	</body>
</html>