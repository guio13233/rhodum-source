<?php
    error_reporting(0);
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo config::getName();?> | Event happening</title>
        <?php html::buildHead();?>
    </head>
	<body>
		<?php html::getNavigation();?>
		<div class="container">
		<h1>Game creation is temporarily disabled.</h1>
        <h2>There is an ongoing Event happening, and to improve server preformace creating games is disabled.</h2>
		</div>
		<?php html::buildFooter();?>
	</body>
</html>