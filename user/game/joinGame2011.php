<?php
	// Check user agent and assign userID
	// if ($_SERVER['HTTP_USER_AGENT'] != "Rhodum3") exit;
	if (!isset($_GET['userID'])) exit;
	if (is_array($_GET['userID'])) exit;
	if (strlen($_GET['userID']) == 0) exit;
	if (!is_numeric($_GET['userID'])) exit;
	$uid = $_GET['userID'];
	
	// Check if key exists and validate it
	if (!isset($_GET['key'])) exit;
	if (is_array($_GET['key'])) exit;
	$key = $_GET['key'];
	
	//Check if gameID exists and validate it
	if (!isset($_GET['gameID'])) exit;
	if (strlen($_GET['gameID']) == 0) exit;
	if (is_array($_GET['gameID'])) exit;
	if (!is_numeric($_GET['gameID'])) exit;
	$gameId = $_GET['gameID'];
	
	// Assign random string function
	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; ++$i) {
			$str .= $keyspace[random_int(0, $max)];
		}
		return $str;
	}
	
	include_once $_SERVER['DOCUMENT_ROOT'].'/user/enc.php';
	$script = file_get_contents('http://labs.rhodum.xyz/user/game/getScript2011.php?userID='.$uid.'&gameID='.$gameId.'&key=9cBOle3VIeU0wBfZmkL92qNU63xk8Y90&pkey='.$key);
	$number = intnum::fromString($script);
	$finalScript = 'join=loadstring("'.$number.'") join()';
?>