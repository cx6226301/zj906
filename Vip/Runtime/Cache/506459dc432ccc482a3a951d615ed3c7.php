<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($System_namex); ?></title>
<link href="__PUBLIC__/Css/body.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/Css/menu.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/Css/main.css" rel="stylesheet" media="all" type="text/css" />
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Base.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/prototype.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/mootools.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Ajax/ThinkAjax.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Form/CheckForm.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/common.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/Util/ImageLoader.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/myfocus-1.0.4.min.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/Js/all.js\"></sc"+"ript>")</script>
<script language="JavaScript">
ifcheck = true;
function CheckAll(form)
{
	for (var i=0;i<form.elements.length-2;i++)
	{
		var e = form.elements[i];
		e.checked = ifcheck;
	}
	ifcheck = ifcheck == true ? false : true;
}
</script>
</head>
<body onLoad="loadBar(0)">

<style>
.tu_box{width:100px;background-color:#aaa;color:#000;}
.tu_box td{text-align:center;line-height:24px; height:24px;}
.tu_ko{ height:40px;line-height:40px !important;background-color:#FFF; }
.tu_l{ width:35%;}
.tu_z{ width:30%;}
.tu_r{ width:35%;}
</style>
<div class="ncenter_box">
<div class="accounttitle"><h1>网络结构图 </h1></div>

    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <form method='post' action="__URL__/Tree2">
      <tr>
        <td><?php echo ($User_namex); ?>：
            <input type="text" name="UserID" title="帐号查询"  >
            <input type="submit" name="Submit" value="查询" class="btn1"/>

            <select name='level' onChange="window.location.href='__URL__/Tree2/ID/<?php echo ($FatherID); ?>/uLev/'+this.value;">
            <option value="<?php echo ($uLev); ?>">第 <?php echo ($uLev+1); ?> 层</option>
            <option value="2">第 3 层</option>
            <option value="3">第 4 层</option>
            <option value="4">第 5 层</option>
            <option value="5">第 6 层</option>
            <option value="6">第 7 层</option>
            <option value="7">第 8 层</option>
            <option value="8">第 9 层</option>
            <option value="9">第 10 层</option>
            </select>
            　　<a href="__URL__/Tree2/uLev/<?php echo ($uLev); ?>">顶层</a>　　<a href="__URL__/Tree2/ID/<?php echo ($FatherID); ?>/uLev/<?php echo ($uLev); ?>">上一层</a></td>
      </tr>
      </form>
      <tr>
        <td><?php echo ($wop); ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
				<table border="0" cellspacing="1" cellpadding="0" bgcolor="#66CC99">
             <tr align="center" style="color:#000;">
                <td bgcolor="#FFFFFF" width="80" height="30">上层</td>
                <?php if(is_array($ColorUA)): $i = 0; $__LIST__ = $ColorUA;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td style="background:<?php echo ($ColorUA[$key]); ?>;" width="100"><?php echo ($AC_Color[$key]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
              </tr>
            </table>
              <!--<table width="90%" border="0" cellspacing="1" cellpadding="0" bgcolor="#66CC99">
              <tr align="center" style="color:#000;">
                <td bgcolor="#FFFFFF">上层</td>
                <?php if(is_array($Level)): $i = 0; $__LIST__ = $Level;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td style="background:<?php echo ($ColorUA[$key+1]); ?>;"><?php echo ($Level[$key]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
              </tr>
            </table>-->

            </td>
            <td align="center">

            <table border="0" cellspacing="1" cellpadding="0" bgcolor="#66CC99">
             <tr align="center" style="color:#000;">
                <td bgcolor="#FFFFFF" width="80" height="30">下层</td>
                <?php if(is_array($TU_MiCheng)): $i = 0; $__LIST__ = $TU_MiCheng;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td style="background:<?php echo ($TU_Color[$key]); ?>;" width="100"><?php echo ($TU_MiCheng[$key]); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
              </tr>
            </table></td>
          </tr>
        </table>

        </td>
      </tr>
    </table>

</div>
</body>
</html>