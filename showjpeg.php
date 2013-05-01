<?php

    include "config.php";
    function showImg($url,$no) //html 格式化单张图片
    {
        $id="slide".$no;
        $html="<div class='slide image' id=".$id." style='display: none;'><img class='rot4' src=".$url."></div>";
        return $html;
    }
    function getJpg($tifpath) //获取tif转换jpg地址
    {
        $fileName   =   rtrim($tifpath,'.tif');
        $dir        =   "./jpg/".$fileName;
        if(!file_exists($dir)) {           
            mkdir($dir);
            $filepath   =   $_SERVER['DOCUMENT_ROOT']."/github/mydoc/up/".$tifpath;   
            $image = new Imagick($filepath);
            $image->writeImages($_SERVER['DOCUMENT_ROOT']."/github/mydoc/jpg/".$fileName."/pic.jpg",false);
        }
        return glob($dir.'/*');
    }
    function htmlJpg($tifpath) //html格式化图片显示
    {
        $filepath   =   $_SERVER['DOCUMENT_ROOT']."/github/mydoc/up/".$tifpath;
        if ((!$tifpath==null)&&(file_exists($filepath))) 
        { 
            $jpgs   =   getJpg($tifpath);
            $picNum =   count($jpgs);
            $html   =   "";
            //print_r($jpgs);
            if ($picNum==1)
            {
                $url    =   $jpgs[0];
                $html.=showImg($url,1);            
            }
            else
            {
                $html="<div class='slide image' id='slide1'><img class='rot4' src=".$jpgs[0]."></div>";
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

    

?>         
    <div class="carousel myspan" data-role="carousel" data-param-effect="fade" data-param-direction="left" data-param-duration="500" data-param-period="1000" >                             
            <div class="slides" >
                <? htmlJpg($_GET['tifpath']); ?>            
            </div>
            <span class="control left bg-color-blue" >‹</span>
            <span class="control right bg-color-blue">›</span> 
            <div class='func-button offset4 bottom'>
                 <a class="button bg-color-blue" id='rot'>旋转</a>
            </div>
        </div>
    </div>
               