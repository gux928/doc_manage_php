<?php
	session_start();
	//print_r($_POST);
	if(isset($_POST["uName"])&&isset($_POST["uPass"]))
	{
		include "config.php";
		$rs=checkusr($_POST["uName"],$_POST["uPass"]);
		$uid=$rs['uId'];
		if($uid>0)
		{
			$_SESSION["username"]=$rs['rname'];
			$_SESSION["uid"]=$uid;
			$_SESSION["isLogin"]=true;
			 echo 1;
		}
		else echo 0;	
	}
	
?>
 