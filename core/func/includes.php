<?php

    //die("Rhodum is undergoing fixing and other changes, we are currently unsure when it will come back. Bye.");

	//die("Rhodum is currently under maintenance. We expect to be back shortly.");
	// Cookie security
    error_reporting(0);
	ini_set("session.cookie_httponly", 1);
	
	
	define('IN_PHP', true);
	// This file will include everything required to run this project.
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/config/main.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/connectivity/main.php';
	connectivity::createDatabaseConnection();
	register_shutdown_function('connectivity::closeDatabaseConnection');
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/auth/main.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/user/main.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/context.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/security.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/libs/handlemail.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/auth/sessionHandler.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/core/func/html/main.php';
?>