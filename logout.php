<?php
	session_start();	
	include "config.php";
	print_r($_SESSION);
	if(!isset($_SESSION["isLogin"])) return;
	$username=$_SESSION["username"];
	$sid=session_id();
	$_SESSION=array();

	if(isset($_COOKIE[session_name()])){
		setCookie(session_name(), '', time()-3600, '/');
	}//彻底销毁session
	session_destroy();
?>