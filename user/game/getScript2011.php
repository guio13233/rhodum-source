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
	if ($stmtU->rowCount() == 0 or $stmtG->rowCount() == 0) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") setMessage("Server not found!");');
	
	// Throw an error on the client if the user is not authorized to join the game
	if ($rGame['public'] == 0) {
		$gameKey = $rGame['key'];
		$stmtU = $dbcon->prepare("SELECT * FROM gameKeys WHERE userid=:id AND `key` = :key;");
		$stmtU->bindParam(':id', $userID, PDO::PARAM_INT);
		$stmtU->bindParam(':key', $gameKey, PDO::PARAM_STR);
		$stmtU->execute();
		if ($stmtU->rowCount() == 0 and $rGame['creator_uid'] != $userID and $rUser['rank'] == 0) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") setMessage("You are not authorized to join this server.");');
	}
	
	// If a special ban is enabled, it will "fail to connect".
	if ($rUser['publicBan'] == 1) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") setMessage("Unable to connect to Rhodum");');
	
	// Throw an error if the authentication keys do not match
	if ($pkey != $rUser['gameKey']) die('game:GetService("NetworkClient") game:GetService("Visit"):SetUploadUrl("") setMessage("Authentication has failed.");');
	
	$dbcon = null; // We're done with the database.
?>
--This is a joinscript that works in 2013 and back, etc. 
-- functions -------------------------- 
function onPlayerAdded(player) 
	-- override 
end 
pcall(function() game:SetPlaceID(-1, false) end) 
local startTime = tick() 
local connectResolved = false 
local loadResolved = false 
local joinResolved = false 
local playResolved = true 
local playStartTime = 0 
local cdnSuccess = 0 
local cdnFailure = 0 
settings()["Game Options"].CollisionSoundEnabled = true 
pcall(function() settings().Rendering.EnableFRM = true end) 
pcall(function() settings().Physics.Is30FpsThrottleEnabled = false end) 
pcall(function() settings()["Task Scheduler"].PriorityMethod = Enum.PriorityMethod.AccumulatedError end) 
pcall(function() settings().Physics.PhysicsEnvironmentalThrottle = Enum.EnviromentalPhysicsThrottle.DefaultAuto end) 
local threadSleepTime = ...  
if threadSleepTime==nil then  
	threadSleepTime = 15  
end  
local test = true  
local closeConnection = game.Close:connect(function()   
	if 0 then  
		if not connectResolved then  
			local duration = tick() - startTime;  
		elseif (not loadResolved) or (not joinResolved) then  
			local duration = tick() - startTime;  
			if not loadResolved then  
				loadResolved = true  
			end  
			if not joinResolved then  
				joinResolved = true  
			end  
		elseif not playResolved then  
			playResolved = true  
		end  
	end  
end)  
game:GetService("ChangeHistoryService"):SetEnabled(false)  
game:GetService("ContentProvider"):SetThreadPool(16)  
game:GetService("InsertService"):SetBaseSetsUrl("http://www.roblox.com/Game/Tools/InsertAsset.ashx?nsets=10&type=base")  
game:GetService("InsertService"):SetUserSetsUrl("http://www.roblox.com/Game/Tools/InsertAsset.ashx?nsets=20&type=user&userid=d")  
game:GetService("InsertService"):SetCollectionUrl("http://www.roblox.com/Game/Tools/InsertAsset.ashx?sid=d")  
game:GetService("InsertService"):SetAssetUrl("http://www.roblox.com/Asset/?id=d")  
game:GetService("InsertService"):SetAssetVersionUrl("http://www.roblox.com/Asset/?assetversionid=d")  
pcall(function() game:GetService("SocialService"):SetFriendUrl("http://www.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=IsFriendsWith&playerid=d") end)  
pcall(function() game:GetService("SocialService"):SetBestFriendUrl("http://www.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=IsBestFriendsWith&playerid=d") end)  
pcall(function() game:GetService("SocialService"):SetGroupUrl("http://www.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=IsInGroup&playerid=d") end)  
pcall(function() game:GetService("SocialService"):SetGroupRankUrl("http://www.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=GetGroupRank&playerid=d") end)  
pcall(function() game:GetService("SocialService"):SetGroupRoleUrl("http://www.roblox.com/Game/LuaWebService/HandleSocialRequest.ashx?method=GetGroupRole&playerid=d") end)  
pcall(function() game:GetService("GamePassService"):SetPlayerHasPassUrl("http://www.roblox.com/Game/GamePass/GamePassHandler.ashx?Action=HasPass&UserID=d") end)  
pcall(function() game:GetService("MarketplaceService"):SetProductInfoUrl("https://api.roblox.com/marketplace/productinfo?assetId=d") end)  
pcall(function() game:GetService("MarketplaceService"):SetPlayerOwnsAssetUrl("https://api.roblox.com/ownership/hasasset?userId=d") end)  
pcall(function() game:SetCreatorID(0, Enum.CreatorType.User) end)  
pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble)  
end)  
local waitingForCharacter = false  
pcall( function()  
	if settings().Network.MtuOverride == 0 then  
	  settings().Network.MtuOverride = 1400  
	end  
end)  
client = game:GetService("NetworkClient")  
visit = game:GetService("Visit")  
function setMessage(message)  
	-- todo: animated "..."  
	if not false then  
		game:SetMessage(message)  
	else  
		-- hack, good enought for now  
		game:SetMessage("Teleporting ...")  
	end  
end  
function showErrorWindow(message, errorType, errorCategory)  
	game:SetMessage(message)  
end  
-- called when the client connection closes  
function onDisconnection(peer, lostConnection)  
	if lostConnection then  
		showErrorWindow("You have lost connection", "LostConnection", "LostConnection")  
	else  
		showErrorWindow("This game has been shutdown", "Kick", "Kick")  
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
			if 0 then  
				if not joinResolved then  
					local duration = tick() - startTime;  
					joinResolved = true  
					playStartTime = tick()  
					playResolved = false  
				end  
			end  
		end  
	end) 	 
	setMessage("Requesting character")  	
	local success, err = pcall(function()  
		replicator:RequestCharacter()  
		setMessage("Waiting for character")  
		waitingForCharacter = true  
	end)  
end  
function onConnectionAccepted(url, replicator)  
	connectResolved = true  
	local waitingForMarker = true 	 
	local success, err = pcall(function()  
		if not test then  
		    visit:SetPing("", 300)  
		end 	 
		if not false then  
			game:SetMessageBrickCount()  
		else  
			setMessage("Teleporting ...")  
		end  
		replicator.Disconnection:connect(onDisconnection)  		
		local marker = replicator:SendMarker()  		
		marker.Received:connect(function()  
			waitingForMarker = false  
			requestCharacter(replicator)  
		end)  
	end) 	 
	if not success then  
		return  
	end 	 
	while waitingForMarker do  
		workspace:ZoomToExtents()  
		wait(0.5)  
	end  
end  
-- called when the client connection fails  
function onConnectionFailed(_, error)  
	showErrorWindow("Failed to connect to the Game. (ID=" .. error .. ")", "ID" .. error, "Other")  
end  
-- called when the client connection is rejected  
function onConnectionRejected()  
	connectionFailed:disconnect()  
	showErrorWindow("This game is not available. Please try another", "WrongVersion", "WrongVersion")  
end  
pcall(function() settings().Diagnostics:LegacyScriptMode() end)  
local success, err = pcall(function()	  
	game:SetRemoteBuildMode(true) 	 
	setMessage("Connecting to Server")  
	client.ConnectionAccepted:connect(onConnectionAccepted)  
	client.ConnectionRejected:connect(onConnectionRejected)  
	connectionFailed = client.ConnectionFailed:connect(onConnectionFailed)  
	client.Ticket = "" 	 
	playerConnectSucces, player = pcall(function() return client:PlayerConnect(<?php echo $rUser['id'];?>, "<?php echo $rGame['ip'];?>", <?php echo $rGame['port'];?>, 0, threadSleepTime) end)  
	player.Name = "<?php echo $rUser['username'];?>"
    player.CharacterAppearance = "http://labs.rhodum.xyz/user/getCharacter.php?uid=<?php echo $rUser['id'];?>&key=D869593BF742A42F79915993EF1DB&tick=<?php echo time();?>"  
	player:SetSuperSafeChat(false)  
	pcall(function() player:SetUnder13(false) end)  
	pcall(function() player:SetMembershipType(Enum.MembershipType.NonBuildersClub) end)  
	pcall(function() player:SetAccountAge(365) end)  
	player.Idled:connect(onPlayerIdled)  
	-- Overriden  
	onPlayerAdded(player)  
	--player.CharacterAppearance = ""  
	if not test then visit:SetUploadUrl("")end  	
end)  
pcall(function() game:SetScreenshotInfo("") end)  

