<?php

// function searchKey($lx,$keyw)
// {
// 	$dsn='mysql:host=localhost;dbname=mydoc;';
// 	$usr='mydoc';
// 	$key='mydoc';
// 	switch ($lx) {
// 		case 'sw':
// 			$sql_where="select * from sw where lwdw like binary  '%".$keyw."%'
// 						or from_no like binary '%".$keyw."%'				
// 						or wjnr like binary '%".$keyw."%'
// 						or nbbh like binary '%".$keyw."%'
// 						ORDER BY  `id` DESC "; 					
// 			break;
// 		case 'fw':
// 			$sql_where="select * from fw where wjnr like binary '%".$keyw."%' 
// 						or nbbh like binary '%".$keyw."%'
// 						ORDER BY  `id` DESC "; 		
// 			break;
// 		case 'xf':
// 			$sql_where="select * from xf where wjnr like binary '%".$keyw."%'
// 						or xfren like binary '%".$keyw."%'
// 						or nbbh like binary '%".$keyw."%'
// 						ORDER BY  `id` DESC "; 		 
// 			break;
// 		case 'yb':
// 			$sql_where="select * from yb where wjnr like binary '%".$keyw."%'
// 						or wjbt like binary '%".$keyw."%'
// 						ORDER BY  `id` DESC "; 		
// 			break;
		
// 		default:
// 			# code...
// 			break;
// 	}
	
// 	try
// 	{
// 		$rs="";
// 		$dbn=new pdo($dsn,$usr,$key);
// 		$dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
// 		$dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
// 		$dbn->query("set names utf8");
// 		$sth=$dbn->prepare($sql_where);
// 		$sth->execute();
// 		$rs=$sth->fetchall();
// 		$jgts=$sth->rowCount();
// 		$html="";
// 		foreach($rs as $row)
// 		{
// 			$html.=formatOne($lx,$row);
// 		}
// 		$dbn =  null;
// 		$restr="<span class='keyw'>".$keyw."</span>";
// 		$html=str_replace($keyw, $restr, $html);
// 		return array($html,$jgts);
// 	}
// 	catch(PDOException $e)
// 	{
// 		echo "connect faild".$e->getMessage();
// 	}	
// }
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
function formatOne($arr)
{
	switch ($arr['lx']) {
		case 'sw':
			$str="<table class=dtnr border=0 width=80%><tr><td  colspan=4 margin=10px><a href='./show.html?lx=sw&id=".$arr["id"]."'>【收文】".$arr["wjnr"]."</a></td></tr>";
			$str=$str."<tr><td width=10%>内部编号：</td><td width=20%>收文（".$arr["year"].")".$arr["nbbh"]."号</td>";
			$str=$str."<td width=10%>文号：</td><td width=20%>".$arr["from_no"]." </td></tr>";
			$str=$str."<tr><td width=10%>来文单位：</td><td width=20%>".$arr["lwdw"]."</td>";
			$str=$str."<td width=10%>收文日期：</td><td width=20%>".$arr["riqi"]." </td></tr></table>";
			return $str;
			break;
		case 'fw':
			$str="<table class=dtnr border=0 width=80%><tr><td  colspan=4 margin=10px><a href='./show.html?lx=fw&id=".$arr["id"]."'>【发文】".$arr["wjnr"]."</a></td></tr>";
			$str=$str."<tr><td width=10%>内部编号：</td><td width=20%>扬公房发（".$arr["year"].")".$arr["nbbh"]."号</td>";
			$str=$str."<td width=10%>发文科室：</td><td width=20%>".$arr["fwks"]." </td></tr>";
			$str=$str."<tr><td width=10%>拟稿人：</td><td width=20%>".$arr["nigaoren"]."</td>";
			$str=$str."<td width=10%>收文日期：</td><td width=20%>".$arr["riqi"]." </td></tr></table>";
			return $str;
			break;
		case 'xf':
			$str="<table class=dtnr border=0 width=80%><tr><td  colspan=4 margin=10px><a href='./show.html?lx=xf&id=".$arr["id"]."'>【信访】".$arr["wjnr"]."</a></td></tr>";
			$str=$str."<tr><td width=10%>内部编号：</td><td width=20%>信访（".$arr["year"].")".$arr["nbbh"]."号</td>";
			$str=$str."<td width=10%>信访人：</td><td width=20%>".$arr["xfren"]." </td></tr>";
			$str=$str."<tr><td width=10%>来文单位：</td><td width=20%>".$arr["lwdw"]."</td>";
			$str=$str."<td width=10%>收文日期：</td><td width=20%>".$arr["riqi"]." </td></tr></table>";
			return $str;
			break;
		case 'yb':
			$str="<table class=dtnr border=0 width=80%><tr><td  colspan=4 margin=10px><a href='./show.html?lx=yb&id=".$arr["id"]."'>【其他】".$arr["wjnr"]."</a></td></tr>";
			$str=$str."<tr><td width=10%>文件标题：</td><td width=20%>".$arr["wjbt"]."</td>";
			$str=$str."<td width=10%>登记日期：</td><td width=20%>".$arr["riqi"]." </td></tr></table>";
			return $str;
			break;

		
		default:
			# code...
			break;
	}
}

function strsToArray($strs)  //
{ 
	$result = array(); 
	$array = array(); 
	$strs = str_replace('，', ',', $strs); 
	$strs = str_replace("n", ',', $strs); 
	$strs = str_replace("rn", ',', $strs); 
	$strs = str_replace(' ', ',', $strs); 
	$array = explode(',', $strs); 
	foreach ($array as $key => $value) 
	{ 
		if ('' != ($value = trim($value))) 
		{ 
			$result[] = $value; 
		} 
	} 
	return $result; 
} 

function getContent($lx,$id)
{
	switch ($lx) 
	{
		case 'sw':
			$sql_where="select * from sw where id = ?"; 
			break;
		case 'xf':
			$sql_where="select * from xf where id = ?"; 
			break;
		case 'fw':
			$sql_where="select * from fw where id = ?"; 
			break;
		case 'yb':
			$sql_where="select * from yb where id = ?"; 
			break;		
		default:
			# code...
			break;
	}	
	try
	{
		$rs="";
		$dbn=conDb();
		$sth=$dbn->prepare($sql_where);
		$sth->execute(array($id));
		$rs=$sth->fetch();
		return $rs;
	}
	catch(PDOException $e)
	{
		echo "connect faild".$e->getMessage();
	}	
}

function echoallow($uid)
{
	//print_r($_SESSION);
	echo "<div class=nav>
		<p>欢迎你：".$_SESSION['username']."
		<a href='index.php'>首页</a>
		<a href='dj.php'>录入文件</a>
		<a href='logout.php'>退出登入</a></p>
	</div>";
}

function echologin($isLogin)
{
	if($isLogin)
	{
		echo "<div class=nav>
		<p>欢迎你：".$_SESSION['username']."
		<a class='button bg-color-blue span2' href='index.php'>首页</a>
		<a class='button bg-color-blue span2' href='dj.php'>录入</a>
		<a class='button bg-color-blue span2' href='logout.php'>退出</a></p>
		</div>";
	}
	else
	{
		echo "<div class='nav'>
		<div class='navii'><form action='login.php' method='post' name='login'>
			用户名：<input type='text' name='uname'/>
			密码：<input type='password' name='upass'/>
			<input type='submit' name='login' value='登入'/>
		</form></div>		
		</div>";		
	}
}

function checkusr($uname,$upass)
{
	$sql_where="select * from mydoc.users where uname = ? and upassword = ?"; 
	try
	{
		$rs="";
		$dbn=conDb();
		$sth=$dbn->prepare($sql_where);
		$upass=md5($upass);
		$sth->execute(array($uname,$upass));
		$rs=$sth->fetch();
		return $rs;
	}
	catch(PDOException $e)
	{
		echo "connect faild".$e->getMessage();
	}	
	return 0;

}

function echognan($lx,$id)    //显示修改，删除等
{
	if(isset($_SESSION["isLogin"]))
	{
		$html="<div class='gnan'>";
		if($lx=="sw")
		{
			$html.="<a target='_blank' href='print.php?lx=".$lx."&id=".$id."'>打印办文单</a>";
					
		}
		if($lx=="xf")
		{
			$html.="<a target='_blank' href='printxf.php?lx=".$lx."&id=".$id."'>打印信访单</a>";
					
		}
		$html.="
			<a href='edit.php?lx=".$lx."&id=".$id."'>修改</a>
			<a href='del.php?lx=".$lx."&id=".$id."'>删除</a>
			</div>
		";
		return $html;
	}
}
function htmlContent($lx,$id) //显示文件内容
{
	$rs=getContent($lx,$id);	
	//print_r($rs);
	if(!$rs==null)
	{
		switch ($lx) 
		{
			case 'sw':
				echo $html="
						<div class='xsbg' id='sidebar-follow'>
						<p>收文信息</p>
						<span class='xm'>收文日期:</span><br/> ".$rs['riqi']."<br/>
						<span class='xm'>内部编号:</span><br/>收文(".$rs['year'].")".$rs['nbbh']."号<br/>
						<span class='xm'>来文单位:</span><br/>".$rs['lwdw']."<br/>
						<span class='xm'>文    号:</span><br/>".$rs['from_no']."<br/>
						<span class='xm'>文件内容:</span><br/>".$rs['wjnr']."<br/>
						".echognan($lx,$id)."
						</div>";
				htmlJpg($rs['path']);
				break;
			case 'fw':
				echo $html="
					<div class='xsbg' id='sidebar-follow'>
					<p>发文信息</p>
						<span class='xm'>发文日期:</span><br/>".$rs['riqi']."</br>
						<span class='xm'>内部编号:</span><br/> 扬公房(".$rs['year'].")".$rs['nbbh']."号<br/>
						<span class='xm'>发文科室:</span><br/>".$rs['fwks']." </br>
						<span class='xm'>拟稿人:</span><br/>".$rs['nigaoren']." </br>
						<span class='xm'>文件标题:</span><br/>".$rs['wjbt']."</br>
						<span class='xm'>文件内容:</span><br/>".$rs['wjnr']."</br>
						<span class='xm'>电子档下载:</span><br/><a href='./up/".$rs['docpath']."'>".$rs['docpath']."</a></br>
						".echognan($lx,$id)."
					</div>	
					";
				htmlJpg($rs['path']);
				break;
			case 'xf':
				echo $html="
					<div class='xsbg' id='sidebar-follow'>
					<p>发文登记</p>
						<span class='xm'>收文日期:</span><br/>".$rs['riqi']."<br>
						<span class='xm'>信访编号:</span><br/>信访(".$rs['year'].")".$rs['nbbh']."号<br/>
						<span class='xm'>来文单位:</span><br/>".$rs['lwdw']." <br>
						<span class='xm'>信访人: </span><br/>".$rs['xfren']." <br>
						<span class='xm'>信访内容:</span><br/>".$rs['wjnr']." <br>
						<span class='xm'>结束日期:</span><br/>".$rs['jiezhiriqi']."<br>
						<span class='xm'>答复文件:</span><br/><a href='./up/".$rs['docpath']."'>".$rs['docpath']."</a><br>
						".echognan($lx,$id)."
					</div>	
					";
				htmlJpg($rs['path']);
				break;
			case 'yb':
				echo $html="
				<div class='xsbg' id='sidebar-follow'>
				<p>其他文件登记</p>
						<span class='xm'>登记日期:</span><br/>".$rs['riqi']."</br>
						<span class='xm'>文件标题:</span><br/>".$rs['wjbt']."</br>
						<span class='xm'>文件内容:</span><br/>".$rs['wjnr']."</br>				
						<span class='xm'>电子档下载：</span><br/><a href='./up/".$rs['docpath']."'>".$rs['docpath']."</a></br>
						".echognan($lx,$id)."
				
				</div>				
				";
				htmlJpg($rs['path']);
				break;
			
			default:
				# code...
				break;
		}
	}
	else 
	{
		echo "无此文件！";
		echo "<a href='index.php'>返回首页<a>";
	}
}



function echoedit($lx,$id)
{	
	$sql_where="select * from ".$lx." where id =  ".$id;
	try
	{
		$dsn='mysql:host=localhost;dbname=mydoc;';
		$usr='mydoc';
		$key='mydoc';
		$dbn=new pdo($dsn,$usr,$key);
		$dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
		$dbn->query("set names utf8");
		$sth=$dbn->prepare($sql_where);
		$sth->execute();
		$rs=$sth->fetch();
		//print_r($rs);
	}
	catch(PDOException $e)
	{
		echo "connect faild  ".$e->getMessage();
		return;
	}
	switch ($lx) 
	{
		case "yb":
			echo $html="
				<script>
				$(function() 
				{
					$( '#datepicker' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
				});
				</script>
				<div class='bt'>
				文件修改
				</div>
				<div id='search'>
					<form action='' method='post'  enctype='multipart/form-data' id='yb' name='wenjianxinxi'>
						<span class='xm'>登记日期:</span> 
							<input type='text' name='riqi' size='30' id='datepicker' value='".$rs['riqi']."'><br/>
						<span class='xm'>文件标题:</span>
						 	<input type='textarea' name='wjbt' size='30' onclick='kkclear(this)' value='".$rs['wjbt']."'><br/>	
						<span class='xm'>文件内容:</span>
						 	<textarea name='wjnr'  wrap='virtual' onclick='kkclear(this)' rows='2' cols='27'/>
							 ".$rs['wjnr']."</textarea></br>				
						<span class='xm'>电子档：</span>
						<span id='doctidai'></span>
							<input type='text' name='docpath' id='docpath'  value='".$rs['docpath']."'/>
							<input type='button' id='docscan' value='上传文件' onclick=docreupclick() /><br/>
						<span class='xm'>扫描件：</span>
						<span id='tidai'></span>	
							<input type='text' name='path' id='path'  value='".$rs['path']."'/>
							<input type='button' id='scan' value='上传文件' onclick=reupclick() /><br/>
							<div class='anjz'>	
							<input type='button'  value='保存文档' onclick= \"return tijiao('yb',4)\">
							</div>
							<input type='hidden' name='id' value=".$rs['id'].">
					</form>
				</div>				
				";
				break;
		case "xf":
			echo $html="
				<script>
				$(function() 
				{
					$( '#datepicker' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
					$( '#datepicker2' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
				});
				</script>
				<div class='bt'>
				信访文件修改
				</div>
				<div class='djbg'>
					<form action='' method='post' name='wenjianxinxi' id='xf' enctype='multipart/form-data'>						
						<span class='xm'>来文日期:</span> 
							 	<input type='text' name='riqi' size='30' onclick='kkclear(this)' id='datepicker' value=".$rs['riqi']."><br>
						<span class='xm'>内部编号:</span> 
								信访(<input type='text' name='year' size='3' value=".$rs['year'].">)
								<input type='text' name='nbbh' size='2' onclick='kkclear(this)' value=".$rs['nbbh'].">号</br>
						<span class='xm'>来文单位:</span> 
							 	<input type='text' name='lwdw' size='30' onclick='kkclear(this)' value=".$rs['lwdw']."><br>
						<span class='xm'>信访人: </span> 
								<input type='text' name='xfren' size='30' onclick='kkclear(this)' value=".$rs['xfren']."><br>
						<span class='xm'>信访内容:</span> 
							 	<input type='text' name='wjnr' size='30' onclick='kkclear(this)' value=".$rs['wjnr']."><br>
						<span class='xm'>截止日期:</span> 
							 	<input type='text' name='jiezhiriqi' size='30' onclick='kkclear(this)' id='datepicker2' value=".$rs['jiezhiriqi']."><br>
						<span class='xm'>扫描件：</span>
						<span id='tidai'></span>	
							<input type='text' name='path' id='path'  value='".$rs['path']."'/>
							<input type='button' id='scan' value='上传文件' onclick=reupclick() /><br/>
						<span class='xm'>答复电子档：</span>
						<span id='doctidai'></span>
							<input type='text' name='docpath' id='docpath'  value='".$rs['docpath']."'/>
							<input type='button' id='docscan' value='上传文件' onclick=docreupclick() /><br/>
						
						<div class='anjz'>	
							<input type='button' value='保存文档' onclick=\"return tijiao('xf',6)\">
						</div>
							<input type='hidden' name='id' value=".$rs['id'].">
					</form>
				</div>				
			";
			break;	
		case "sw":
			echo $html="
				<script>
				$(function() 
				{
					$( '#datepicker' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
					$( '#datepicker2' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
				});
				</script>
				<div class='bt'>
				收文编辑
				</div>
				<div id='search'>
					<form action='' method='post' name='wenjianxinxi' enctype='multipart/form-data' id='sw'>							
						<span class='xm'>收文日期:</span> 
							<input type='text' name='riqi' size='30' onclick='kkclear(this)' id='datepicker' value='".$rs['riqi']."' ><br/>
						<span class='xm'>内部编号:</span>
						 	收文(<input type='text' name='year' size='3' value='".$rs['year']."' onclick='kkclear(this)'/>)
							<input type='text' name='nbbh' size='2' value='".$rs['nbbh']."' onclick='kkclear(this)'/>号</br>
						<span class='xm'>来文单位:</span>
						 	<input type='text' name='lwdw' size='30' onclick='kkclear(this)'value='".$rs['lwdw']."'><br/>
						<span class='xm'>文    号:</span>
						 	<input type='text' name='wenhao' size='30' onclick='kkclear(this)' value='".$rs['from_no']."'><br/>
						<span class='xm'>文件内容:</span>
							<textarea class='wbk' name='wjnr'  onclick='kkclear(this)'  cols='27'>
							 ".$rs['wjnr']."</textarea>
						<span class='xm'>扫描件：</span>
						<span id='tidai'></span>	
							<input type='text' name='path' id='path'  value='".$rs['path']."'/>
							<input type='button' id='scan' value='上传文件' onclick=reupclick() /><br/>
						

						<div class='anjz'><input type='button' value='保存文档' onclick= \"return tijiao('sw',5)\">
						</div>
							<input type='hidden' name='id' value=".$rs['id'].">
					</form>
				</div>
			";
			break;
		case "fw":
			echo $html="
				<script>
				$(function() 
				{
					$( '#datepicker' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
					$( '#datepicker2' ).datepicker
					(
						{
						changeMonth: true,
						changeYear: true
						}
					)
				});
				</script>
				<div class='bt'>
				发文编辑
				</div>
				<div id='search'>
					<form action='' method='post' name='wenjianxinxi' enctype='multipart/form-data' id='sw'>							
						<span class='xm'>发文日期:</span> 
							<input type='text' name='riqi' size='30' onclick='kkclear(this)' value='".$rs['riqi']."' id='datepicker'><br/>
						<span class='xm'>内部编号:</span>
						 	发文(<input type='text' name='year' size='3' value='".$rs['year']."' onclick='kkclear(this)'/>)
							<input type='text' name='nbbh' size='2' value='".$rs['nbbh']."' onclick='kkclear(this)'/>号</br>
						<span class='xm'>发文科室:</span>
						 	<input type='text' name='fwks' size='30' onclick='kkclear(this)'value='".$rs['fwks']."'><br/>
						<span class='xm'>拟稿人:</span>
						 	<input type='text' name='nigaoren' size='30' onclick='kkclear(this)' value='".$rs['nigaoren']."'><br/>
						<span class='xm'>文件标题:</span>
						 	<input type='text' name='wjbt' size='30' onclick='kkclear(this)' value='".$rs['wjbt']."'><br/>
						<span class='xm'>文件内容:</span>
							<textarea name='wjnr'  wrap='virtual' onclick='kkclear(this)' rows='2' cols='27'/>
							 ".$rs['wjnr']."</textarea></br>
						<span class='xm'>上传文件：</span>	
							<input type='text' name='path' id='path' value='".$rs['path']."' >
						<span id='tidai'></span>
							<input type='button' id='scan' value='上传文件' onclick=reupclick() /><br/>
						<div class='anjz'><input type='button' value='保存文档' onclick= \"return tijiao('sw',7)\">
						</div>
							<input type='hidden' name='id' value='".$rs['id']."'>
					</form>
				</div>
			";
			break;			
		default:
			break;
	}	
}

function tiaozhuan($url,$msg)
{

       echo $msg."</br>";
       echo "页面将在3秒后自动跳转...</br>";
       echo "<a href='".$url."'>如果没有跳转，请点这里跳转</a>";
       echo "<script language='javascript'>setTimeout(\"window.location.href='".$url."'\",3000)</script>";
}

function echopage($lx,$pageno)
{
	$dsn='mysql:host=localhost;dbname=mydoc;';
	$usr='mydoc';
	$key='mydoc';
	$limit=10;
	$offset=$limit*($pageno-1);
	$sql_select="
					SELECT * 
					FROM ".$_GET['lx']."
        			order by id desc
        			limit ".$offset.",".$limit."
		";
	try
	{
		$rs="";
		$dbn=new pdo($dsn,$usr,$key);
		$dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
		$dbn->query("set names utf8");
		$sth=$dbn->prepare($sql_select);
		$sth->execute();
		$rs=$sth->fetchall();
		$jgts=$sth->rowCount();
		$html="";
		foreach($rs as $row)
		{
			$html.=formatOne($_GET['lx'],$row);
		}
		//$restr="<span class='keyw'>".$keyw."</span>";
		return $html;
	}
	catch(PDOException $e)
	{
		echo "connect faild".$e->getMessage();
	}	
}
function jgts($lx)
{
	$dsn='mysql:host=localhost;dbname=mydoc;';
	$usr='mydoc';
	$key='mydoc';	
	$sql_select=	"SELECT * 
					FROM ".$_GET['lx'];
	try
	{
		$rs="";
		$dbn=new pdo($dsn,$usr,$key);
		$dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
		$dbn->query("set names utf8");
		$sth=$dbn->prepare($sql_select);
		$sth->execute();
		return $sth->rowCount();
	}
	catch(PDOException $e)
	{
		echo "connect faild".$e->getMessage();
	}	
}



function searchKeyall($keyw)
{
		$dsn='mysql:host=localhost;dbname=mydoc;';
		$usr='mydoc';
		$key='mydoc';
		$sql_sw="select * from sw where lwdw like binary  '%".$keyw."%'
							or from_no like binary '%".$keyw."%'				
							or wjnr like binary '%".$keyw."%'
							or nbbh like binary '%".$keyw."%'"; 					
		
		$sql_fw="select * from fw where wjnr like binary '%".$keyw."%' 
							or nbbh like binary '%".$keyw."%' "; 		
		$sql_xf="select * from xf where wjnr like binary '%".$keyw."%'
							or xfren like binary '%".$keyw."%'
							or nbbh like binary '%".$keyw."%'"; 		 
		$sql_yb="select * from yb where wjnr like binary '%".$keyw."%'
							or wjbt like binary '%".$keyw."%' "; 		
		try
		{
			$rs="";
			$dbn=new pdo($dsn,$usr,$key);
			$dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
			$dbn->query("set names utf8");
			$sth=$dbn->prepare($sql_sw);
			$sth->execute();
			$rs=$sth->fetchall();

			$sth=$dbn->prepare($sql_fw);
			$sth->execute();
			$rs2=$sth->fetchall();
			foreach ($rs2 as $v) {
				array_push($rs, $v);
			}

			$sth=$dbn->prepare($sql_xf);
			$sth->execute();
			$rs2=$sth->fetchall();
			foreach ($rs2 as $v) {
				array_push($rs, $v);
			}

			$sth=$dbn->prepare($sql_yb);
			$sth->execute();
			$rs2=$sth->fetchall();
			foreach ($rs2 as $v) {
				array_push($rs, $v);
			}
			if($rs==null) return $rs;
			foreach ($rs as $key => $row) { 
			$riqi[$key] = $row['riqi']; 
			} 
			array_multisort($riqi,SORT_DESC,$rs);
			return $rs;

			// $html="";
			// foreach($rs as $row)
			// {
			// 	$html.=formatOne($row);
			// }
			// echo $html;

			// foreach($a as &$val) 
			// {
	  //   	$val = call_user_func_array('array_merge',array_filter($val));
			// }
			//print_r($rs);
		// 	$jgts=$sth->rowCount();
		// 	$html="";
		// 	foreach($rs as $row)
		// 	{
		// 		$html.=formatOne($lx,$row);
		// 	}
		// 	$dbn =  null;
		// 	$restr="<span class='keyw'>".$keyw."</span>";
		// 	$html=str_replace($keyw, $restr, $html);
		// 	return array($html,$jgts);
		}
		catch(PDOException $e)
		{
			echo "connect faild".$e->getMessage();
		}	
}
	

?>