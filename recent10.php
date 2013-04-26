<?php
	function conDb()
	{
	    $dsn='mysql:host=127.0.0.1;dbname=mydoc;';
	    $usr='mydoc';
	    $key='mydoc'; 
	    $dbn=new pdo($dsn,$usr,$key);
	    $dbn->setAttribute(PDO::ATTR_PERSISTENT,true);
	    $dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    $dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);	    
		$dbn->query("set names utf8");
	    return $dbn;
	}
	include "config.php";
	try
	{
		$rs="";
		$dbn=conDb();
		$sql_select="
					SELECT `id` ,  `wjnr`  
					FROM  `sw` 
					ORDER BY  `id` DESC 
        			limit 0 ,10;
		";
		$sth=$dbn->prepare($sql_select);
		$sth->execute();
		$rs=$sth->fetchall();
		$jgts=$sth->rowCount();
		$html="";
		for ($i=0; $i < $jgts ; $i++) 
		{ 
			$html.="<li><a href='.\show.php?lx=sw&id=".$rs[$i]['id']."''>".$rs[$i]['wjnr']."</a></li>";
		}		
		$swhtml = $html;
		// $html="";
		// $sql_select="
		// 			SELECT  `id` ,  `wjnr` 
		// 			FROM  `fw` 
		// 			ORDER BY  id DESC 
		// 			LIMIT 0 , 10
		// ";
		// $sth=$dbn->prepare($sql_select);
		// $sth->execute();
		// $rs=$sth->fetchall();
		// $jgts=$sth->rowCount();
		// for ($i=0; $i < $jgts ; $i++) 
		// { 
		// 	$html.="<li><a href='.\show.php?lx=fw&id=".$rs[$i]['id']."''>".$rs[$i]['wjnr']."</a></li>";
		// }		
		// $fwhtml = $html;
		$html="";
		$sql_select="
					SELECT  `id` ,  `wjnr` 
					FROM  xf 
					ORDER BY  `id` DESC 
					LIMIT 0 , 10
		";
		$sth=$dbn->prepare($sql_select);
		$sth->execute();
		$rs=$sth->fetchall();
		$jgts=$sth->rowCount();
		for ($i=0; $i < $jgts ; $i++) 
		{ 
			$html.="<li><a href='.\show.php?lx=xf&id=".$rs[$i]['id']."''>".$rs[$i]['wjnr']."</a></li>";
		}	
		$xfhtml = $html;
		
	}
	catch(PDOException $e)
	{
		echo "connect faild".$e->getMessage();
	}
	echo "
		<div class='one-tab'><ul class='unstyled'>
		".$swhtml."</ul></div>
		<div class='one-tab hide'><ul class='unstyled'>
		".$xfhtml."</ul></div>";		
	
?>
