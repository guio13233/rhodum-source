function waitForChild(parent, childName)
	while true do
		local child = parent:findFirstChild(childName)
		if child then
			return child
		end
		parent.ChildAdded:wait()
	end
end
function getKillerOfHumanoidIfStillInGame(humanoid)
	local tag = humanoid:findFirstChild("creator")
	if tag then
		local killer = tag.Value
		if killer.Parent then
			return killer
		end
	end
	return nil
end
function onDied(victim, humanoid)
	local killer = getKillerOfHumanoidIfStillInGame(humanoid)

	local victorId = 0
	if killer then
		victorId = killer.userId
	end
end
function createDeathMonitor(player)
	if player.Character then
		local humanoid = waitForChild(player.Character, "Humanoid")
		humanoid.Died:connect(
			function ()
				onDied(player, humanoid)
			end
		)
	end
end
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
function characterRessurection(player)
	if player.Character then
		local humanoid = player.Character.Humanoid
		humanoid.Died:connect(function() wait(5) player:LoadCharacter() end)
	end
end
game:service("Players").PlayerAdded:connect(function(player)
	characterRessurection(player)
	player.Changed:connect(function(name)
		if name=="Character" then
			characterRessurection(player)
		end
	end)
end)
game:getService("Players"):CreateLocalPlayer(0)
game.Players.Player:SetSuperSafeChat(false);
game.Players.Player:LoadCharacter()
game:service("RunService"):run()
