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
Port = <?php echo htmlentities($serverPort, ENT_QUOTES, "UTF-8");?>  
Server =  game:GetService("NetworkServer") 
game:Load('http://labs.rhodum.xyz/CoreScripts/health.rbxm') 
game:FindFirstChild("Health-GUI").Parent = game.StarterGui 

coroutine.resume(coroutine.create(function()
	while (true) do
		wait(10)
        dofile("http://labs.rhodum.xyz/server/ping.php?apikey=Zeebobuxj8GhcdgpbgTpF&key=<?php echo $serverKey; ?>&players=" .. game.Players.NumPlayers .. "")
	end
end))

dofile('http://labs.rhodum.xyz/CoreScripts/assets.lua')

HostService = game:GetService("RunService")Server:Start(Port,20) 
game:GetService("RunService"):Run() 
print("Rhodum server started!") 


game:GetService("Players").PlayerAdded:connect(function(newPlayer)
   local verification = game:HttpGet("http://labs.rhodum.xyz/server/checkPlayer.php?apikey=Zeebobuxj8GhcdgpbgTpF&uname=" .. newPlayer.Name .. "&gameId=<?php echo $serverID;?>&uid=".. newPlayer.Name .."&tick=" .. tick(), true)
	if (verification ~= "yes") then
		local p = game:GetService("NetworkServer"):GetChildren()
		for i = 1, #p do
			if (p[i]:GetPlayer().Name == newPlayer.Name) then
				wait()
				p[i]:CloseConnection()
			end
		end
		print(newPlayer.Name .. " has failed to authenticate.")
	else
		print(newPlayer.Name .. " has authenticated successfully.")
	end
end)


function onJoined(NewPlayer) 
print("New player found: "..NewPlayer.Name.."") 
NewPlayer:LoadCharacter(true)
while wait() do
if NewPlayer.Character.Humanoid.Health == 0 then 
wait(5) 
NewPlayer:LoadCharacter(true)
elseif NewPlayer.Character.Parent  == nil then 
wait(5) 
NewPlayer:LoadCharacter(true) 
end 
end 
end 
game.Players.PlayerAdded:connect(onJoined) 