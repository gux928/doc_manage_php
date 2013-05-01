<?php
	header("Content-Type: text/html; charset=utf-8");
	include "config.php";
	function upLoadFile($path){		
			if ($_FILES["path"]["error"] > 0) 	//上传失败
			{
		    	$_POST['path']=null;
		    	return false;
			}
			else
			{
			    echo "Upload: " . $_FILES["path"]["name"] . "<br />";
			    echo "Type: " . $_FILES["path"]["type"] . "<br />";
			    echo "Size: " . ($_FILES["path"]["size"] / 1024) . " Kb<br />";
			    echo "Stored in: " . $_FILES["path"]["tmp_name"];
			    echo  $_FILES["path"]["name"];
				echo "*******************<br>";
				$filename=time().$_FILES["path"]["name"];
				$uppath = "./up/".$filename;
				move_uploaded_file($_FILES["path"]["tmp_name"],$uppath);
				$_POST['path']=$filename;
				return true;
			}
	}
	function insertArray($neirong){	
		switch ($neirong['lx']) 	{
			case "yb":
				$sql_insert="
							INSERT INTO  yb (`riqi`,`wjbt`,`wjnr`,`path`,`docpath`)
							VALUES('".$neirong['riqi']."','".$neirong['wjbt']."','".$neirong['wjnr']."', '".$neirong['path']."','".$neirong['docpath']."')
							";
				break;
			case "xf":
				$sql_insert="
							INSERT INTO  xf (`riqi`,`nbbh`,`lwdw`,`xfren`,`wjnr`,`jiezhiriqi`,`path`,`year`,`docpath`)
							VALUES('".$neirong['riqi']."','".$neirong['nbbh']."','".$neirong['lwdw']."','".$neirong['xfren']."','".$neirong['wjnr']."','".$neirong['jiezhiriqi']."', '".$neirong['path']."', '".$neirong['year']."', '".$neirong['docpath']."')
							";
				break;	
			case "sw":
				$sql_insert="
							INSERT INTO  sw (`nbbh`,`riqi`,`from_no`,`lwdw`,`wjnr`,`path`,`year`)
							VALUES('".$neirong['nbbh']."','".$neirong['riqi']."','".$neirong['wenhao']."','".$neirong['lwdw']."','".$neirong['wjnr']."', '".$neirong['path']."', '".$neirong['year']."')
							";
				break;
			case "fw":
				$sql_insert="
							INSERT INTO  fw (`riqi`,`nbbh`,`fwks`,`nigaoren`,`wjbt`,`wjnr`,`path`,`year`,`docpath`)
							VALUES('".$neirong['riqi']."','".$neirong['nbbh']."','".$neirong['fwks']."','".$neirong['nigaoren']."','".$neirong['wjbt']."','".$neirong['wjnr']."', '".$neirong['path']."', '".$neirong['year']."', '".$neirong['docpath']."')
							";
				break;			
			default:
				# code...
				break;
		}
		try	{
			$dbn=conDb();
			// echo $sql_insert;
			// print_r($neirong);
			//$neirong['wjnr']=trim($neirong['wjnr']);
			// echo "<br>";
			$sth=$dbn->prepare($sql_insert);
			$sth->execute();
			$mbym="show.html?lx=".$neirong['lx']."&id=".$dbn->lastInsertId();
			header("Location:".$mbym);
		}
		catch(PDOException $e)	{
			echo "connect faild  ".$e->getMessage();
			return;
		}	
	}
	function updateArray($neirong){	
		print_r($neirong);
		echo "<br/>";
		switch ($neirong['lx']){
			case "yb":
				$sql_update="
				UPDATE yb 	set 	riqi= 	'".$neirong['riqi']."',
									wjbt= 	'".$neirong['wjbt']."',
									wjnr = 	'".$neirong['wjnr']."',
									docpath =	'".$neirong['docpath']."',
									path= 	'".$neirong['path']."' 
							where 	id ='".$neirong['id']."'
							";
				break;
			case "xf":
				$sql_update="
				UPDATE xf 	SET 	riqi	= '".$neirong['riqi']."',
									year =	'".$neirong['year']."',
									nbbh =	'".$neirong['nbbh']."',
									lwdw =	'".$neirong['lwdw']."',
									xfren =	'".$neirong['xfren']."',
									wjnr =	'".$neirong['wjnr']."',
									jiezhiriqi =	'".$neirong['jiezhiriqi']."',
									path =	'".$neirong['path']."',
									docpath =	'".$neirong['docpath']."'
							where 	id = '".$neirong['id']."'
							";
				break;	
			case "sw":
				$sql_update="
				UPDATE sw 	SET 	riqi = '".$neirong['riqi']."' , 
									year ='".$neirong['year']."' , 
									nbbh='".$neirong['nbbh']."' ,
									lwdw= '".$neirong['lwdw']."',
									from_no = '".$neirong['wenhao']."',
									wjnr='".$neirong['wjnr']."',
									path= '".$neirong['path']."',
									year= '".$neirong['year']."'
							where 	id = '".$neirong['id']."'
							";			
				break;
			case "fw":
				$sql_update='
				UPDATE fw SET riqi = binary ? , nbbh= binary ? ,lwdw= binary ?,from_no = binary ?,wjnr= binary ?,path= binary ?
				where id = binary ?
				';
				break;			
			default:
				# code...
				break;
		}
		try{
			$dbn=conDb();
			$sth=$dbn->prepare($sql_update);
			echo "有".$sth->execute()."条数据被修改";
			$mbym="show.html?id=".$neirong['id']."&lx=".$lx;
			header("Location:".$mbym);

		}
		catch(PDOException $e)		{
			echo "connect faild  ".$e->getMessage();
			return;
		}	
	}
	echo '<br>post:';
	print_r($_POST);
	echo '<br>get:';
	print_r($_GET);
	echo '<br>file:';
	print_r($_FILES);
	
	if(isset($_FILES['path'])) 		upLoadFile($_FILES['path']); //上传扫描件
	else   $_FILES['path']='';  	
	if(isset($_FILES['docpath'])) 	upLoadFile($_FILES['docpath']);	//上传doc
	else   $_FILES['docpath']='';  
	
		


	if(!isset($_POST["id"]) ) //判断修改还是添加
	{
		insertArray($_POST);
	}
	else 
	{
		updateArray($_GET["form"],$_POST);
	}
?>
