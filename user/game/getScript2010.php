<?php
    if ($_SERVER['HTTP_USER_AGENT'] != "Rhodum/WinInet") exit;
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
	

    //Check if gear is allowed
    if ($rGame['gearallowed'] == 0){
        $gearallowed = '&dgear';
    }else{
        $gearallowed = '';
    }


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
local server = "<?php echo $rGame['ip'];?>" 
local serverport = <?php echo $rGame['port'];?> 
local clientport = 0 
local playername = "<?php echo $rUser['username'];?>" 
game:SetMessage("Connecting to server...") 
function dieerror(errmsg) 
game:SetMessage(errmsg) 
wait(math.huge) 
end 
local suc, err = pcall(function() 
client = game:GetService("NetworkClient") 
local player = game:GetService("Players"):CreateLocalPlayer(<?php echo $rUser['id'];?>) 
player.CharacterAppearance = "http://labs.rhodum.xyz/user/getCharacter.php?uid=<?php echo $rUser['id'];?>&key=D869593BF742A42F79915993EF1DB<?php echo $gearallowed; ?>&tick=<?php echo time();?>"
player:SetSuperSafeChat(false) 
pcall(function() game:GetService("Players"):SetChatStyle(Enum.ChatStyle.ClassicAndBubble) end) 
game:GetService("Visit") 
player.Name = playername 
game:ClearMessage() 
game:SetMessageBrickCount()
end) 
client.ConnectionAccepted:connect(function(peer, repl)
    local mkr = repl:SendMarker()
    mkr.Received:connect(function()
    game:ClearMessage()
end)
end)
if not suc then 
dieerror(err) 
end 
function connected(url, replicator) 
local suc, err = pcall(function() 
local marker = replicator:SendMarker() 
end) 
if not suc then 
dieerror(err) 
end 
marker.Recieved:wait() 
local suc, err = pcall(function() 
game:ClearMessage() 
end) 
if not suc then 
dieerror(err) 
end 
end 
function rejected() 
dieerror("Connection failed: Rejected by server.") 
end 
function failed(peer, errcode, why) 
dieerror("Failed [".. peer.. "], ".. errcode.. ": ".. why) 
end 
local suc, err = pcall(function() 
client.ConnectionAccepted:connect(connected) 
client.ConnectionRejected:connect(rejected) 
client.ConnectionFailed:connect(failed) 
client:Connect(server, serverport, clientport, 20) 
end) 
if not suc then 
local x = Instance.new("Message") 
x.Text = err 
x.Parent = workspace 
wait(math.huge) 
end 
while true do 
wait(0.001) 
replicator:SendMarker() 
end 
