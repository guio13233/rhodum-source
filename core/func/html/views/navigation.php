<script src="/core/func/js/html/navigation.js?v=1010"></script>
<?php
    # $_SERVER['SCRIPT_NAME'];
	$addS = "";
	if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 1) $addS = "background-color:#333;border-color:#282828";
    $finobev2logo = array(
        '/core/html/img/Finoobv2.png',
        '/core/html/img/finob.png',
        '/core/html/img/basiclogo.png',
        '/core/html/img/newfinoob.png',
        //'/core/html/img/nobeliy.png',
    );
    $randlogo = array_rand($finobev2logo);
    if($_SERVER["HTTPS"] != "on"){
        exit('<meta http-equiv="refresh" content="0; URL=https://www.rhodum.xyz/" />');
    }
?>
<nav class="navbar navbar-inverse navbar-fixed-top navbar" style="background: #6a6aa7; background: linear-gradient(90deg,#265a7f,#545489); border-bottom: 0;box-shadow:0 1px 2px 0 rgba(34,36,38,.15);<?php echo $addS;?>">
	<div class="container">
		<div class="navbar-header">
			<?php if ($GLOBALS['loggedIn']): ?>
				<button type="button" class="navbar-toggle collapsed" id="navbarSideButton">
			<?php else: ?>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
			<?php endif; ?>
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a style="margin: 2px 0px 0px;" class="navbar-brand" href="/"><img width="50" height="50" src="<?php echo $finobev2logo[$randlogo]; ?>"></a>
		</div>
		<div class="collapse navbar-collapse" id="bs-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="/forum"><i class="fas fa-comments"></i> Forum</a></li>
				<li><a href="/games"><i class="fas fa-play"></i> Games</a></li>
				<li><a href="/catalog"><i class="fas fa-shopping-basket"></i> Catalog</a></li>
                <li><a href="/groups"><i class="fas fa-users"></i> Groups</a></li>
                <li><a href="/users"><i class="fas fa-user-friends"></i> Users</a></li>
				<li style="margin:3px 0px 0px;" class="dropdown">
					<a style="margin: -2px 0px 0px;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More <span class="caret"></span></a>
					<?php
						$addS2 = "margin-top:3px;";
						if ($GLOBALS['loggedIn'] && $GLOBALS['userTable']['themeChoice'] == 1) $addS2 = "margin-top:3px;color: #fff;border: 1px solid #282828;background-color: #333";
					?>
					<ul class="dropdown-menu" role="menu" style="<?php echo $addS2;?>">
						<?php
							if ($GLOBALS['loggedIn']) {
								if ($GLOBALS['userTable']['rank'] > 0) {
									$stmt = $GLOBALS['dbcon']->prepare("SELECT id FROM catalog WHERE approved = 0 AND declined = 0;");
									$stmt->execute();
									echo '<li><a href="/admin"><i class="fas fa-user-shield"></i> Admin <span class="badge" style="background-color: #f44336;font-size:10px;padding: 6px 6px;"> '.$stmt->rowCount().'</span></a></li><li class="divider"></li>';
								}
								echo '<li><a href="/catalog/upload"><i class="fas fa-plus-square"></i> Upload new Item</a></li>
								<li><a href="/games/new"><i class="fa f-btn fa-plus"></i> Add Server</a><li class="divider"></li>';
							}
						?>
						<li><a href="https://rhodum.xyz/blog"><i class="fas fa-blog"></i> Blog</a></li>
                        <li><a href="https://rhodum.xyz/Finobe/Clips"><i class="fas fa-archive"></i> Finobe Clips</a></li>
                        <li><a href="https://rhodum.xyz/ilmuro"><i class="far fa-laugh-squint"></i> Il muro</a></li>
                        <?php
                            if ($GLOBALS['loggedIn']) {
                                echo '<li><a href="https://discord.gg/D8WCAEbCvF"><i class="fab fa-discord"></i> Discord</a></li>';
                            }
                        ?>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
					if (!$GLOBALS['loggedIn']) {
						include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/html/views/navigation/loginPanel.php';
					}else{
						include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/html/views/navigation/rightNavigation.php';
					}
				?>
			</ul>
		</div>
	</div>
		<ul class="navbar-side navbarSide">
			<?php if ($GLOBALS['loggedIn']): ?>
				<li style="background-color:black">
				<div class="row" style="margin-right:0px">
					<div class="col-xs-4">
						<div style="margin-left:10px;position: relative;border:solid 1px #555555;height:50px;width:50px;height:50px;border-radius:50%;overflow: hidden" id="charImg" class="img-circle"><a style="margin-left:10px;color:#fff" href="/user/profile/<?php echo $GLOBALS['userTable']['username'];?>"><img style="position: absolute;clip: rect(0px, 75px, 50px, 0);left:-18px" src="<?php echo context::getUserImage($GLOBALS['userTable']);?>" height="100"></div> <?php echo $GLOBALS['userTable']['username']?></a>
					</div>
					<div class="col-xs-4">
						<p style="margin-top:15px"><a style="color:#fff" data-toggle="tooltip" data-placement="bottom" data-original-title="Posties, used to buy exclusive items, rewarded to you by Rhodum staff"><span class="fas fa-coins"></span> <span id="userPosties"><?php echo $GLOBALS['userTable']['posties'];?></span></a></p>
						<p><a style="color:#fff" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo context::humanTiming(strtotime($GLOBALS['userTable']['lastAward'])); ?> until next reward"><span class="fa fa-money"></span> <span id="userCoins"><?php echo $GLOBALS['userTable']['coins'];?></span></a></p>
					</div>
					<div class="col-xs-4">
						<?php
							$query = "SELECT id FROM `friendRequests` WHERE `recvuid` = :id;";
							$stmt = $GLOBALS['dbcon']->prepare($query);
							$stmt->bindParam(':id', $GLOBALS['userTable']['id'], PDO::PARAM_INT);
							$stmt->execute();
							$numRequests = $stmt->rowCount();
							
							if ($numRequests == 0) {
								echo '<p style="margin-top:15px"><a style="color:#fff" data-toggle="tooltip" data-placement="bottom" data-original-title="Friends" href="/friends"><span class="fa fa-users"></span></a></p>';
							}else{
								echo '<p style="margin-top:15px"><a style="color:#fff" data-toggle="tooltip" data-placement="bottom" data-original-title="Friends" href="/friends"><span class="fa fa-users"></span><span class="badge" style="background-color: #f44336;font-size:10px;padding: 6px 6px;"> '.$numRequests.'</span></a></p>';
							}
							
							$query = "SELECT id FROM `messages` WHERE `recv_uid` = :id AND `read` = 0";
							$stmt = $GLOBALS['dbcon']->prepare($query);
							$stmt->bindParam(':id', $GLOBALS['userTable']['id'], PDO::PARAM_INT);
							$stmt->execute();
							$numMessages = $stmt->rowCount();
							
							if ($numMessages == 0) {
								echo '<p><a style="color:#fff" data-toggle="tooltip" data-placement="bottom" data-original-title="Messages" href="/user/messages"><span class="fa fa-envelope-open-o"></span></a></p>';
							}else{
								echo '<p><a style="color:#fff" data-toggle="tooltip" data-placement="bottom" data-original-title="Messages" href="/user/messages"><span class="fa fa-envelope-open-o"></span><span class="badge" style="background-color: #f44336;font-size:10px;padding: 6px 6px;"> '.$numMessages.'</span></a></p>';
							}
						?>
					</div>
				</div>
				</li>
				<li class="navbar-side-item"><a style="color:#999" href="/">Dashboard</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/user/settings">Settings</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/user/character">Character</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/forum">Forum</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/games">Games</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/catalog">Catalog</a></li>
				<?php
					if ($GLOBALS['userTable']['rank'] > 0) {
						$stmt = $GLOBALS['dbcon']->prepare("SELECT id FROM catalog WHERE approved = 0 AND declined = 0;");
						$stmt->execute();
						echo '<li class="navbar-side-item"><a style="color:#999" href="/admin">Admin <span class="badge" style="background-color: #f44336;font-size:10px;padding: 6px 6px;"> '.$stmt->rowCount().'</span></a></li><li class="divider"></li>';
					}
				?>
				<li class="navbar-side-item"><a style="color:#999" href="/games/new">Add Server</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/groups">Groups</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/users">Users</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="http://discord.gg/YP7avBv">Discord</a></li>
				<li class="navbar-side-item"><a style="color:#999" href="/user/logout">Sign out</a></li>
			<?php endif; ?>
		</ul>
		<div class="overlay"></div>
</nav>
<?php
    error_reporting(0);
    $news_on = false;
    $httpison = "true";
    if($_SERVER["HTTPS"] != "on")
    {
    $httpison = "false";
    echo '<div style="margin-bottom:54px"></div>';
    echo '<div class="alert alert-danger center">You are using an unsecure version of the site, click <a href="https://www.rhodum.xyz">here</a> to go to the secure version.</div>';
    exit('<meta http-equiv="refresh" content="0; URL=https://www.rhodum.xyz/" />');
    } elseif ($news_on == "true") {
        
    }else{
        echo '<div style="margin-bottom:79px"></div>';
    }
	if ($news_on) {
        if ($httpison == "false") {
            
        } else {
            echo '<div style="margin-bottom:54px"></div>';
        }
		echo '<div class="alert alert-danger center">Website got redesigned</div>';
	}else{
		echo '<div style="margin-bottom:79px"></div>';
	}
?>

<div class="modal globalModal" tabindex="-1" role="dialog" aria-labelledby="modalglobal" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content center gModalContent">
			<h4 class="modal-title" id="modalUsername"></h4>
			<div class="modal-body" id="miniProfileContent">
				<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="globalModal2" tabindex="-1" role="dialog" aria-labelledby="globalModal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header" id="gModalHeader">
				<h5 class="modal-title" id="gModalTitle">Modal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="gModalErrorContainer"></div>
			<div class="modal-body" id="gModalBody">
			</div>
		</div>
	</div>
</div>

<?php
	$appear = false;
	if ($GLOBALS['loggedIn']) {
		if ($GLOBALS['userTable']['banned'] == 0 && $GLOBALS['userTable']['emailverified'] == 1) {
			if ($GLOBALS['sessionTable']['factorFinish'] == 1 && $GLOBALS['userTable']['2faEnabled'] == 1) {
				$appear = true;
			}else{
				if ($GLOBALS['userTable']['2faEnabled'] == 0) {
					$appear = true;
				}
			}
		}
	}

	if ($appear): ?>
	<script src="/core/func/js/chat.js?tick=1099"></script>
	<div id="desktopChat" class="desktopView">
		<div class="chatOpener">Chat</div>
		<div class="chatOptions"></div>
		<div class="chatOpenbackground">
			<button class="btn btn-success addChatBtn fullWidth" style="border-radius: 0px" onclick="renderChatChoices();">Add Chat</button>
			<div class="chatContainer"></div>
		</div>
	</div>
<?php endif; ?>