<?php
include "config.php";
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
     
$rs=findContent($_GET['lx'],$_GET['id']);

        
?>  
            <div class="slides" >
             <? echojpg($rs['path']); ?> 
           
            </div>
            <span class="control left bg-color-blue" >‹</span>
            <span class="control right bg-color-blue">›</span> 
            <div class='func-button offset4 bottom'>
                 <a class="button bg-color-blue" id='rot'>旋转</a>
            </div>
               