<?php
	if (!$GLOBALS['loggedIn']) {
		exit;
	}
?>
<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="Posties, used to buy exclusive items, rewarded to you by Rhodum staff"><span class="fas fa-coins"></span> <span id="userPosties"><?php echo $GLOBALS['userTable']['posties'];?></span></a></li>
<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo context::humanTiming(strtotime($GLOBALS['userTable']['lastAward'])); ?> until next reward"><span class="fa fa-money"></span> <span id="userCoins"><?php echo $GLOBALS['userTable']['coins'];?></span></a></li>
<?php
	$query = "SELECT id FROM `friendRequests` WHERE `recvuid` = :id;";
	$stmt = $GLOBALS['dbcon']->prepare($query);
	$stmt->bindParam(':id', $GLOBALS['userTable']['id'], PDO::PARAM_INT);
	$stmt->execute();
	$numRequests = $stmt->rowCount();
	
	if ($numRequests == 0) {
		echo '<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="Friends" href="/friends"><span class="fa fa-users"></span></a></li>';
	}else{
		echo '<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="Friends" href="/friends"><span class="fa fa-users"></span><span class="badge" style="background-color: #f44336;font-size:10px;padding: 6px 6px;"> '.$numRequests.'</span></a></li>';
	}
	
	$query = "SELECT id FROM `messages` WHERE `recv_uid` = :id AND `read` = 0";
	$stmt = $GLOBALS['dbcon']->prepare($query);
	$stmt->bindParam(':id', $GLOBALS['userTable']['id'], PDO::PARAM_INT);
	$stmt->execute();
	$numMessages = $stmt->rowCount();
	
	if ($numMessages == 0) {
		echo '<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="Messages" href="/user/messages"><span class="fas fa-envelope"></span></a></li>';
	}else{
		echo '<li><a data-toggle="tooltip" data-placement="bottom" data-original-title="Messages" href="/user/messages"><span class="fa fa-envelope-open-o"></span><span class="badge" style="background-color: #f44336;font-size:10px;padding: 6px 6px;"> '.$numMessages.'</span></a></li>';
	}
?>
<li style="margin:3px 0px 0px;" class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="far fa-user-circle"></i> <?php echo $GLOBALS['userTable']['username']; ?><span class="caret"></span></a>
		<?php
			$addS2 = "margin-top:1px;";
			if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 1) $addS2 = "margin-top:1px;color: #fff;border: 1px solid rgb(40, 40, 40);background-color: #333";
		?>
	<ul class="dropdown-menu" role="menu" style="<?php echo $addS2;?>">
		<li><a href="/user/profile/<?php echo $GLOBALS['userTable']['username']; ?>"><i class="far fa-id-card"></i> Profile</a></li>
		<li><a href="/user/settings"><i class="fa f-btn fa-wrench"></i> Settings</a></li>
		<li><a href="/user/character"><i class="fa f-btn fa-user"></i> Character</a></li>
		<li class="divider"></li>
		<li><a href="/user/logout"><i class="fa f-btn fa-sign-out"></i> Sign out</i></a></li>
	</ul>
</li>