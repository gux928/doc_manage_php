<?php
// function conDb()
// {
//     $dsn='mysql:host=127.0.0.1;dbname=mydoc;';
//     $usr='mydoc';
//     $key='mydoc'; 
//     $dbn=new pdo($dsn,$usr,$key);
//     $dbn->setAttribute(PDO::ATTR_PERSISTENT,true);
//     $dbn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
//     $dbn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
//     return $dbn;
// }
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
      
    try
    {
        $begin = microtime(TRUE);

        $rs="";
        $dbn=conDb();
        $end = microtime(TRUE);
        $time = $end-$begin;
        echo "********************<br>";
        echo "time=".$time;
        echo "<br>********************<br>";
        
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
function getJpg($tifpath)
{
    $fileName   =   rtrim($tifpath,'.tif');
    $dir        =   "./jpg/".$fileName;
    if(!file_exists($dir)) {        
    // echo "tifpath=".$tifpath."</br>";
    // echo "************************";    
    mkdir($dir);
    // echo "dir=".$dir."</br>";
    // echo "************************";
    $filepath   =   $_SERVER['DOCUMENT_ROOT']."/github/mydoc/up/".$tifpath;
    // echo "filepath=".$filepath."</br>";
    // echo "************************";    
    $image = new Imagick($filepath);
    $image->writeImages($_SERVER['DOCUMENT_ROOT']."/github/mydoc/jpg/".$fileName."/pic.jpg",false);
    // echo $page_no=$image->getNumberImages();
    }
    return glob($dir.'/*');
}
function echoJpg($tifpath)
{
    $filepath   =   $_SERVER['DOCUMENT_ROOT']."/github/mydoc/up/".$tifpath;
    if ((!$filepath==null)&&(file_exists($filepath))) 
    { 
        $jpgs   =   getJpg($tifpath);
        $picNum =   count($jpgs);
        $html   =   "";
        print_r($jpgs);
        if ($picNum==1)
        {
            $url    =   $jpgs[0];
            $html.=showImg($url,1);            
        }
        else
        {
            $html="<div class='slide image' id='slide1'><img class='rot4' src=".$jpgs[0]." width='906' height='1285'></div>";
            for($i=1;$i<$picNum;$i++)
            {
                $html.=showImg($jpgs[$i],$i+1);
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
     
    $rs         =   cz($_GET['lx'],$_GET['id']);
    
    echoJpg($rs['path']);
    
        
?>  
            
               