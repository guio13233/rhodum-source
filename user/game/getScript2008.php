<?php
	// Check if key exists and validate it
	if (!isset($_GET['key'])) exit;
	if (is_array($_GET['key'])) exit;
	if ($_GET['key'] != "9cBOle3VIeU0wBfZmkL92qNU63xk8Y90") die("Not being called from an authenticated server.");
	
	// Check if userID exists and assign it
	if (!isset($_GET['userID'])) exit;
	if (is_array($_GET['userID'])) exit;
	if (!is_numeric($_GET['userID'])) exit;
	$userID = $_GET['userID'];
	
	// Check if gameID exists and assign it
	if (!isset($_GET['gameID'])) exit;
	if (is_array($_GET['gameID'])) exit;
	if (!is_numeric($_GET['gameID'])) exit;
	$gameID = $_GET['gameID'];
	
	// Check if player key exists and assign it
	if (!isset($_GET['pkey'])) exit;
	if (is_array($_GET['pkey'])) exit;
	$pkey = $_GET['pkey'];
	
	// Create the database connection
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		exit;
	}
	
	// User row
	$stmtU = $dbcon->prepare("SELECT * FROM users WHERE id=:id;");
	$stmtU->bindParam(':id', $userID, PDO::PARAM_INT);
	$stmtU->execute();
	$rUser = $stmtU->fetch(PDO::FETCH_ASSOC);
	
	// Game row
	$stmtG = $dbcon->prepare("SELECT * FROM games WHERE id=:id;");
	$stmtG->bindParam(':id', $gameID, PDO::PARAM_INT);
	$stmtG->execute();
	$rGame = $stmtG->fetch(PDO::FETCH_ASSOC);
	
	// Throw an error on the client if the game does not exist
	if ($stmtU->rowCount() == 0 or $stmtG->rowCount() == 0) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") game:SetMessage("Server not found!");');
	
	// Throw an error on the client if the user is not authorized to join the game
	if ($rGame['public'] == 0) {
		$gameKey = $rGame['key'];
		$stmtU = $dbcon->prepare("SELECT * FROM gameKeys WHERE userid=:id AND `key` = :key;");
		$stmtU->bindParam(':id', $userID, PDO::PARAM_INT);
		$stmtU->bindParam(':key', $gameKey, PDO::PARAM_STR);
		$stmtU->execute();
		if ($stmtU->rowCount() == 0 and $rGame['creator_uid'] != $userID and $rUser['rank'] == 0) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") game:SetMessage("You are not authorized to join this server.");');
	}
	
	// If a special ban is enabled, it will "fail to connect".
	if ($rUser['publicBan'] == 1) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") game:SetMessage("Unable to connect to Rhodum");');
	
	// Throw an error if the authentication keys do not match
	if ($pkey != $rUser['gameKey']) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") game:SetMessage("Authentication has failed.");');
?>
-- functions --------------------------
function onPlayerAdded(player)
	-- override
end

-- MultiplayerSharedScript.lua inserted here ------ Prepended to Join.lua --

pcall(function() settings().Physics.Is30FpsThrottleEnabled = true end)
pcall(function() settings()["Task Scheduler"].PriorityMethod = Enum.PriorityMethod.AccumulatedError end)

-- arguments ---------------------------------------
local threadSleepTime = ...

if threadSleepTime==nil then
	threadSleepTime = 15
end

local test = true
print("! Joining game '' place -1 at localhost")

game:GetService("ChangeHistoryService"):SetEnabled(false)

local waitingForCharacter = false
pcall( function()
	if settings().Network.MtuOverride == 0 then
	  settings().Network.MtuOverride = 1400
	end
end)


-- globals -----------------------------------------

client = game:GetService("NetworkClient")
game.GuiRoot.MainMenu.Tools:remove()
game.GuiRoot.MainMenu["Insert"]:remove()
visit = game:GetService("Visit")

-- functions ---------------------------------------
function reportError(err)
	print("***ERROR*** " .. err)
	if not test then visit:SetUploadUrl("") end
	client:Disconnect()
	wait(4)
	game:SetMessage("Error: " .. err)
end

-- called when the client connection closes
function onDisconnection(peer, lostConnection)
	if lostConnection then
		game:SetMessage("You have lost the connection to the game")
	else
		game:SetMessage("This game has shut down")
	end
end

function requestCharacter(replicator)
	
	-- prepare code for when the Character appears
	local connection
	connection = player.Changed:connect(function (property)
		if property=="Character" then
			game:ClearMessage()
			waitingForCharacter = false
			
			connection:disconnect()
		end
	end)
	
	game:SetMessage("Requesting character")

	local success, err = pcall(function()	
		replicator:RequestCharacter()
		game:SetMessage("Waiting for character")
		waitingForCharacter = true
	end)
	if not success then
		reportError(err)
		return
	end
end

-- called when the client connection is established
function onConnectionAccepted(url, replicator)

	local waitingForMarker = true
	
	local success, err = pcall(function()	
		if not test then 
		    visit:SetPing("", 300) 
		end
		
		game:SetMessageBrickCount()

		replicator.Disconnection:connect(onDisconnection)
		
		-- Wait for a marker to return before creating the Player
		local marker = replicator:SendMarker()
		
		marker.Received:connect(function()
			waitingForMarker = false
			requestCharacter(replicator)
		end)
	end)
	
	if not success then
		reportError(err)
		return
	end
	
	-- TODO: report marker progress
	
	while waitingForMarker do
		workspace:ZoomToExtents()
		wait(0.5)
	end
end

-- called when the client connection fails
function onConnectionFailed(_, error)
	game:SetMessage("Failed to connect to the Game. (ID=" .. error .. ")")
end

-- called when the client connection is rejected
function onConnectionRejected()
	connectionFailed:disconnect()
	game:SetMessage("This game is not available. Please try another")
end

idled = false
function onPlayerIdled(time)
	if time > 20*60 then
		game:SetMessage(string.format("You were disconnected for being idle %d minutes", time/60))
		client:Disconnect()	
		if not idled then
			idled = true
		end
	end
end


-- main ------------------------------------------------------------

pcall(function() settings().Diagnostics:LegacyScriptMode() end)
local success, err = pcall(function()
	
	game:SetMessage("Connecting to Server")
	client.ConnectionAccepted:connect(onConnectionAccepted)
	client.ConnectionRejected:connect(onConnectionRejected)
	connectionFailed = client.ConnectionFailed:connect(onConnectionFailed)
	
	player = game:GetService("Players"):CreateLocalPlayer(<?php echo $rUser['id'];?>)
	client:Connect("<?php echo $rGame['ip'];?>", <?php echo $rGame['port'];?>, 0, threadSleepTime)

	player:SetSuperSafeChat(false)
	player.Idled:connect(onPlayerIdled)
	
	-- Overriden
	onPlayerAdded(player)
	
	pcall(function() player.Name = [========[<?php echo $rUser['username'];?>]========] end)
	player.CharacterAppearance = "<?php
	$stmt = $dbcon->prepare("SELECT * FROM wearing WHERE uid=:uid;");
	$stmt->bindParam(':uid', $userID, PDO::PARAM_INT);
	$stmt->execute();
	if ($stmt->rowCount() == 0) {
		echo 'http://labs.rhodum.xyz/user/getcolors.php?uid='.$userID;
	}else{
		echo 'http://labs.rhodum.xyz/user/getcolors.php?uid='.$userID.';';
	}
	$count = 0;
	foreach($stmt as $result) {
		if ($result['type'] == "gear") {
		}else{
			if ($count !== $stmt->rowCount()) {
				if (isset($_GET['mode'])) {
					echo $result['aprString'].';';
				}else{
					echo $result['aprString'].'?tick='.time().';';
				}
			}else{
				echo $result['aprString'];
				if (isset($_GET['mode'])) {
					echo $result['aprString'];
				}else{
					echo $result['aprString'].'?tick='.time();
				}
			}
		}
		$count++;
	}
	$dbcon = null;
?>"	
	if not test then visit:SetUploadUrl("") end
end)

if not success then
	reportError(err)
end