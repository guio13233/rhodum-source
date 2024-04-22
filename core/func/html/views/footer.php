<style>
	@media only screen and (max-width: 500px) {
		.footer {
			height:95px
		}
	}
</style>
<div style="margin-bottom:150px"></div>
<?php
	if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 0 || $GLOBALS['loggedIn'] == false) {
		echo '<footer class="footer container center" style="box-shadow:0 1px 50px 0 rgba(34,36,38,.15);">';
	}else{
		echo '<footer class="footer container center">';
	}

    $finobev2 = array(
    'Финодум',
    'Rhodum',
    //'Nobelium',
    //'Нобелий',
    );
    $randname = array_rand($finobev2);
?>
	<h5 style="color:grey;font-size:22px;margin-bottom:0px"><?php echo $finobev2[$randname]; ?></h5>
	<p style="margin-bottom:0px">Copyright © <?php echo $finobev2[$randname]; ?> 2021 | Random number: <?php echo rand(0, 1000000); ?></p>
	<a href="/Legal/rules">Rules</a> | <a href="/Legal/privacy">Privacy Policy</a> | <a href="/Legal/terms">Terms of service</a> | <a onclick="showDMCA();">DMCA</a> | Renders: <?php echo context::getUserCount(); ?> | Router Requests : <?php echo context::getRouterCount();?> | Image Requests : <?php echo context::getrenderimageCount();?>
</footer>