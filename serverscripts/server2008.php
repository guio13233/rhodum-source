<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
	if (isset($_GET['key'])) {
		$key = $_GET['key'];
	}else{
		$dbcon = null;
		exit;
	}
	
	$dedicatedServer = false; // Switch between user hosted server and a dedicated server
	if (isset($_GET['dedicated'])) $dedicatedServer = true;
	
	try{
		$dbcon = new PDO('mysql:host='.$db_host.';port='.$db_port.';dbname='.$db_name.'', $db_user, $db_passwd);
		$dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
		$dbcon->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch (PDOExpection $e){
		echo $e->getMessage();
	}
	$stmtU = $dbcon->prepare("SELECT * FROM games WHERE `privatekey`=:key;");
	$stmtU->bindParam(':key', $key, PDO::PARAM_STR);
	$stmtU->execute();
	$dbcon = null;
	if ($stmtU->rowCount() == 0) {
		exit;
	}
	$rGame = $stmtU->fetch(PDO::FETCH_ASSOC);
	$serverID = $rGame['id'];
	if (!isset($_GET['port'])) {
		$serverPort = $rGame['port'];
	}else{
		$serverPort = $_GET['port'];
	}
	$serverKey = $rGame['privatekey'];
	$gameVersion = $rGame['version'];
?>

<?php
	if (isset($_GET['placeURL'])) {
		if (is_array($_GET['placeURL'])) exit;
		echo 'game:Load("'.htmlentities($_GET['placeURL'], ENT_QUOTES, "UTF-8").'");';
	}
?>
-- declarations
local port = <?php echo htmlentities($serverPort, ENT_QUOTES, "UTF-8");?> 
local sleepTime = 10

coroutine.resume(coroutine.create(function()
	while (true) do
		wait(10)
        dofile("http://labs.rhodum.xyz/server/ping.php?key=<?php echo $serverKey; ?>&players=" .. game.Players.NumPlayers .. "")
	end
end))

-- establish this peer as the Server
local ns = game:service("NetworkServer")

-- utility
function waitForChild(parent, childName)
	while true do
		local child = parent:findFirstChild(childName)
		if child then
			return child
		end
		parent.ChildAdded:wait()
	end
end

-- returns the player object that killed this humanoid
-- returns nil if the killer is no longer in the game
function getKillerOfHumanoidIfStillInGame(humanoid)

	-- check for kill tag on humanoid - may be more than one - todo: deal with this
	local tag = humanoid:findFirstChild("creator")

	-- find player with name on tag
	if tag then
		local killer = tag.Value
		if killer.Parent then -- killer still in game
			return killer
		end
	end

	return nil
end

-- listen for the death of a Player
function createDeathMonitor(player)
	-- we don't need to clean up old monitors or connections since the Character will be destroyed soon
	if player.Character then
		local humanoid = waitForChild(player.Character, "Humanoid")
		humanoid.Died:connect(
			function ()
				onDied(player, humanoid)
			end
		)
	end
end

-- listen to all Players' Characters
game:service("Players").ChildAdded:connect(
	function (player)
		createDeathMonitor(player)
		player.Changed:connect(
			function (property)
				if property=="Character" then
					createDeathMonitor(player)
				end
			end
		)
	end
)

-- This code might move to C++
function characterRessurection(player)
	if player.Character then
		local humanoid = player.Character.Humanoid
		humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)
	end
end
game:service("Players").PlayerAdded:connect(function(player)
	print("Player " .. player.userId .. " added")
	characterRessurection(player)
	player.Changed:connect(function(name)
		if name=="Character" then
			characterRessurection(player)
		end
	end)
end)

if port>0 then
	-- Now start the connection
	ns:start(port, sleepTime) 
end

game:service("RunService"):run() 