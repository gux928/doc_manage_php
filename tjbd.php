<?php
	session_start();
	header("Content-Type: text/html; charset=utf-8");
	include "config.php";
	if(!isset($_SESSION["isLogin"]))
	{
		tiaozhuan("index.php","请登入");
	}	
	print_r($_POST);
	print_r($_FILES);
	// print_r($_FILES['asdasd']);
	if(isset($_FILES['path'])) //如果有上传
	{
		if ($_FILES["path"]["error"] > 0) //上传失败
		{
	    	$_POST['path']=null;
		}
		else
		{
		 //    echo "Upload: " . $_FILES["path"]["name"] . "<br />";
		 //    echo "Type: " . $_FILES["path"]["type"] . "<br />";
		 //    echo "Size: " . ($_FILES["path"]["size"] / 1024) . " Kb<br />";
		 //    echo "Stored in: " . $_FILES["path"]["tmp_name"];
		 //    echo  $_FILES["path"]["name"];
			// echo "*******************<br>";
			$filename=time().$_FILES["path"]["name"];
			$uppath = "./up/".$filename;
			move_uploaded_file($_FILES["path"]["tmp_name"],$uppath);
			$_POST['path']=$filename;
		}
	}
	
	if(isset($_FILES['docpath'])) //如果有上传
	{
		if ($_FILES["docpath"]["error"] > 0)
			{
			    //echo "Error: " . $_FILES["path"]["error"] . "<br />";
			    $_POST['docpath']=null;
			}
			else
			{
			 //    echo "Upload: " . $_FILES["path"]["name"] . "<br />";
			 //    echo "Type: " . $_FILES["path"]["type"] . "<br />";
			 //    echo "Size: " . ($_FILES["path"]["size"] / 1024) . " Kb<br />";
			 //    echo "Stored in: " . $_FILES["path"]["tmp_name"];
			 //    echo  $_FILES["path"]["name"];
				// echo "*******************<br>";
				$filename=time().$_FILES["docpath"]["name"];
				$uppath = "./up/".$filename;
				move_uploaded_file($_FILES["docpath"]["tmp_name"],$uppath);
				$_POST['docpath']=$filename;
			}
	}
		


	if(!isset($_POST["id"]) ) //判断修改还是添加
	{
		insertArray($_GET['form'],$_POST);
	}
	else 
	{
		print_r($_POST);
		updateArray($_GET["form"],$_POST);
	}
?>
