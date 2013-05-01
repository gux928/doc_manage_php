<?php

    include "config.php";
    $rs=getContent($_GET['lx'],$_GET['id']);

    switch ($rs['lx']) {
            case 'sw':
?>  
    
        <fieldset  name='riqi'>
            <legend>收文日期</legend>
            <?echo $rs['riqi']?>
        </fieldset>
        <fieldset>
            <legend>内部编号</legend>
            <?echo "收文（".$rs['year']."）".$rs['nbbh']."号"?>
        </fieldset>
        <fieldset>
            <legend>来文单位</legend>
            <?echo $rs['lwdw']?>
        </fieldset>
        <fieldset>
            <legend>文号</legend>
            <?echo $rs['from_no']?>
        </fieldset>
        <fieldset>
            <legend>文件内容</legend>
            <?echo $rs['wjnr']?>
        </fieldset>
        <input type="hidden" name="lx" value=<?echo $rs["lx"]?> >
        <input type="hidden" name="id" value=<?echo $rs["id"]?> >        
        <input type="hidden" name="path" value=<?echo $rs["path"]?> >
<?
    break;
    }
?>   <div id="gnan">
        <a href="#" class='button bg-color-blue default' id='jpg-btn'>查看扫描件</a>
        <a href="" target="_blank" class='button bg-color-blue default' id='print-btn'>打印办文单</a>
    </div>
               