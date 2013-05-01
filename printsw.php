<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="./css/print.css">
  <style media="print">
  .diss {display:none;}
</style>
</head>
<?php
  include "config.php";
  $rs=getContent($_GET['lx'],$_GET['id']);
  if($rs['from_no']=="无") $rs['from_no']="";

?>
<body>
  <div class="tab-div" align="center">
    <table >
       <tr>
    <th colspan="2">扬州市直管公房管理处办公室收文单
    </th>
      </tr>
    <tr>
      <td colspan="2" class="noborder gao1 right"> 收文编号:<?php echo "收文（".$rs['year'].")".$rs['nbbh']."号"?></td>
    </tr>
   
    <tr>
      <td rowspan="2" class="lwdw"> 来文单位:<br> <?php echo $rs['lwdw'] ?></td>
      <td class="left gao2 top"> 收文日期: <?php echo $rs['riqi'] ?></td>
    </tr>
    
    <tr>
      <td class="gao3 top left"> 文件编号: <br> <?php echo $rs['from_no'] ?></td>
    </tr>
    <tr>
      <td  class="gao4 top left" colspan="2" > 文件内容:<br><br><span class="wz"><?php echo $rs['wjnr'] ?></span></td>
    </tr>
    <tr>
      <td  class="gao4 top left" colspan="2" > 拟办意见:</td>
    </tr>
    <tr>
      <td class="gao4 top left" colspan="2" > 领导批示和会办意见：</td>
    </tr>
  </table>

    <div class="button-div diss" align="center">
    <input type="button" value="关闭窗口" class="button diss" onclick="javascript:window.close();"/>
    <input type="button" value="打印" class="button diss" onclick="javascript:window.print();"/>    
    </div>
  </form>
  </div>
</body>

</html>