<?php
function cz($lx,$id)
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
    $dsn='mysql:host=localhost;dbname=mydoc;';
    $usr='mydoc';
    $key='mydoc';   
    try
    {
        $rs="";
        $dbn=new pdo($dsn,$usr,$key);
        $dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
        $dbn->query("set names utf8");
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
function showImg($url,$no)
{
    $id="slide".$no;
    $html="<div class='slide image' id=".$id." style='display: none;'><img class='rot4' src=".$url." width='906' height='1285'></div>";
    return $html;
}
function makeJpg($tifpath)
{
    $dir    =   "./jpg/".$tifpath;
    if(file_exists($dir))   return;
    $path   =   "./up/".$tifpath;
    mkdir($path);
    $image = new Imagick($path);
    $image->writeImages($path.$tifpath.".jpg",false);
    $page_no=$image->getNumberImages();


}
function echojpg($tifpath)
{
    $dir="./jpg/".$tifpath;
    echo $dir;
    mkdir($dir);
    $path = $_SERVER['DOCUMENT_ROOT']."/test/up/".$tifpath;
    if ((!$tifpath==null)&&(file_exists($path))) 
    { 
        $tempname=time();           
        $path = $_SERVER['DOCUMENT_ROOT']."/test/up/".$tifpath;
       
       
        if ($page_no==1)
        {
            $url="./temp/".$tempname.".jpg";
            $html.=showImg($url,1);            
        }
        else
        {

            $html="<div class='slide image' id='slide1'><img class='rot4' src='./temp/".$tempname."-0.jpg' width='906' height='1285'></div>";
            for($i=1;$i<$page_no;$i++)
            {
                $url="./temp/".$tempname."-".$i.".jpg";
                $html.=showImg($url,$i+1);
            }

        }
        echo $html;
    }
    else
    {
        echo "     
            <div class='slide image' id='slide1'><img class='rot4' src='./up/null.png' width='906' height='1285'></div>
            </div>      
            ";
    }
}
     
$rs=cz($_GET['lx'],$_GET['id']);

        
?>  
            <div class="slides" >
             <? echojpg($rs['path']); ?> 
           
            </div>
            <span class="control left bg-color-blue" >‹</span>
            <span class="control right bg-color-blue">›</span> 
            <div class='func-button offset4 bottom'>
                 <a class="button bg-color-blue" id='rot'>旋转</a>
            </div>
               