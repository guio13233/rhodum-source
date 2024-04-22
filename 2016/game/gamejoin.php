<?php
    error_reporting(0);
    require_once("poo/thesigerthingyfor2016.php");
    header("Content-Type: text/plain");
    $GAMEID = addslashes($_GET["gameid"]);
    $id = addslashes($_GET["id"]);
    $mship = addslashes($_GET["mship"]);
    $charapp = "h";
    //$user = file_get_contents('http://labs.rhodum.xyz/api/idtouser.php?key=xFk5AhcdxOZyokDW&uid='.$id);
    $user = addslashes($_GET["username"]);
    
    //$getjson = file_get_contents('http://labs.rhodum.xyz/api/2016gameapi.php?key=sUPSxdraP3WsjDMC&uid='.$GAMEID);
    //$jsonadresses = $getjson;
    //$joinips = json_decode($jsonadresses);
    
    $ip = addslashes($_GET["ip"]);
    $port = addslashes($_GET["port"]);

    if(preg_match("/[a-z]/i", $id)){
        $id = "1";
    }
    if(preg_match("/[a-z]/i", $port)){
        $port = "53640";
    }

    // Construct joinscript
    $joinscript = array(
        "ClientPort" => 0,
        "MachineAddress" => $ip,
        "ServerPort" => $port,
        "PingUrl" => "",
        "PingInterval" => 20,
        "UserName" => $user,
        "SeleniumTestMode" => false,
        "UserId" => $id,
        "SuperSafeChat" => false,
        "CharacterAppearance" => "$charapp",
        "ClientTicket" => "",
        "GameId" => 3,
        "PlaceId" => 1818,
        "MeasurementUrl" => "", // No telemetry here :)
        "WaitingForCharacterGuid" => "26eb3e21-aa80-475b-a777-b43c3ea5f7d2",
        "BaseUrl" => "my revival domain was here lol",
        "ChatStyle" => "ClassicAndBubble",
        "VendorId" => "0",
        "ScreenShotInfo" => "",
        "VideoInfo" => "",
        "CreatorId" => "3333",
        "CreatorTypeEnum" => "User",
        "MembershipType" => "OutrageousBuildersClub",
        "AccountAge" => "3000000",
        "CookieStoreFirstTimePlayKey" => "rbx_evt_ftp",
        "CookieStoreFiveMinutePlayKey" => "rbx_evt_fmp",
        "CookieStoreEnabled" => true,
        "IsRobloxPlace" => true,
        "GenerateTeleportJoin" => false,
        "IsUnknownOrUnder13" => false,
        "SessionId" => "39412c34-2f9b-436f-b19d-b8db90c2e186|00000000-0000-0000-0000-000000000000|0|190.23.103.228|8|2021-03-03T17:04:47+01:00|0|null|null",
        "DataCenterId" => 0,
        "UniverseId" => 3,
        "BrowserTrackerId" => 0,
        "UsePortraitMode" => false,
        "FollowUserId" => 0,
        "characterAppearanceId" => 1
    );

    // Encode it!
    $data = json_encode($joinscript, JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);

    // Sign joinscript
    $signature = get_signature("\r\n" . $data);

    // exit
    exit("--rbxsig%". $signature . "%\r\n" . $data);
?>