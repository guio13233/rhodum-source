<?php
    error_reporting(0);
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/includes.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo config::getName();?> | Il muro</title>
        <?php html::buildHead();?>
        <link href="https://vjs.zencdn.net/7.11.4/video-js.css" rel="stylesheet" />
    </head>
	<body>
        <style>
        /* Solid border */
        hr.solid {
          border-top: 3px solid #bbb;
        }
        </style>
		<?php html::getNavigation();?>
		<div class="container">
		<h1 style="text-align: center;">Il Muro</h1>
        <h3 style="text-align: center;">Il posto dove puoi trovare informazione su XlXi, il coglione di merda</h3>
        </div>
        <hr class="solid">
        <div class="col-xs-12 col-sm-4 col-md-6 col-sm-offset-2 col-md-offset-3col-xs-12 col-sm-4 col-md-6 col-sm-offset-2 col-md-offset-3">
            <h2>XlXi is racist</h2>
            <img src="/html/img/muro/xlxiracist.jpg" alt="XlXi is racist">
            <h2>XlXi pretends to commit suicide to shutdown a revival.</h2>
            <img src="/html/img/muro/fakesuicide.png" alt="XlXi fakes a suicide">
            <h2>XlXi leaks Epiculy's ip adress, and ddoses him later.</h2>
            <img src="/html/img/muro/leaksip.png" alt="XlXi fakes a suicide">
        </div>
		</div>
		<?php html::buildFooter();?>
	</body>
</html>