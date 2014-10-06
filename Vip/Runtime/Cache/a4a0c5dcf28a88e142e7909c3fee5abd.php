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

<script language=javascript src="__PUBLIC__/Js/wpCalendar.js"></script>
<div class="ncenter_box">
<div class="accounttitle"><h1>详细奖金&nbsp;&nbsp;[<a href='javascript:history.back()'>返回列表</a>] </h1></div>
<table width="100%" cellpadding=3 cellspacing=0 border=0 class="tab3">
  <tr>
    <td align="center" class="content_td">结算时间：<?php echo (date('Y-m-d H:i:s',$confirm)); ?></td>
    </tr>
</table>
<table width="100%" cellpadding=3 border=0 cellspacing="1" id="tb1" bgcolor="#b9c8d0" class="tab3">
<thead>
  <tr align="center" class="content_td">
    <th nowrap ><span>会员编号</span></th>
    <th <?php echo ($c_b[1]); ?>><span><?php echo ($fee_s7[0]); ?></span></th>
			<th <?php echo ($c_b[2]); ?>><span><?php echo ($fee_s7[1]); ?></span></th>
			<th <?php echo ($c_b[3]); ?>><span><?php echo ($fee_s7[2]); ?></span></th>
			<th <?php echo ($c_b[4]); ?>><span><?php echo ($fee_s7[3]); ?></span></th>
			<th <?php echo ($c_b[5]); ?>><span><?php echo ($fee_s7[4]); ?></span></th>
			<th <?php echo ($c_b[11]); ?>><span><?php echo ($b_b[11]); ?></span></th>
			<th <?php echo ($c_b[6]); ?>><span><?php echo ($fee_s7[5]); ?></span></th>
			<th <?php echo ($c_b[7]); ?>><span><?php echo ($fee_s7[6]); ?></span></th>
			<th <?php echo ($c_b[8]); ?>><span><?php echo ($fee_s7[7]); ?></span></th>
			<th <?php echo ($c_b[9]); ?>><span><?php echo ($b_b[9]); ?></span></th>
			<th <?php echo ($c_b[10]); ?>><span><?php echo ($b_b[10]); ?></span></th>
			<th <?php echo ($c_b[0]); ?>><span><?php echo ($b_b[0]); ?></span></th>
			<th <?php echo ($c_b[12]); ?>><span><?php echo ($b_b[12]); ?></span></th>
    </tr>
</thead>
  <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center" class="content_td">
    <td><?php echo (user_id($vo['uid'])); ?></td>
    <td <?php echo ($c_b[1]); ?>><?php echo ($vo['b1']); ?></td>
		<td <?php echo ($c_b[2]); ?>><?php echo ($vo['b2']); ?></td>
		<td <?php echo ($c_b[3]); ?>><?php echo ($vo['b3']); ?></td>
		<td <?php echo ($c_b[4]); ?>><?php echo ($vo['b4']); ?></td>
		<td <?php echo ($c_b[5]); ?>><?php echo ($vo['b5']); ?></td>
		<td <?php echo ($c_b[11]); ?>><?php echo ($vo['b1']+$vo['b2']+$vo['b3']+$vo['b4']); ?></td>
		<td <?php echo ($c_b[6]); ?>><?php echo ($vo['b6']); ?></td>
		<td <?php echo ($c_b[7]); ?>><?php echo ($vo['b7']); ?></td>
		<td <?php echo ($c_b[8]); ?>><?php echo ($vo['b8']); ?></td>
		<td <?php echo ($c_b[9]); ?>><?php echo ($vo['b9']); ?></td>
		<td <?php echo ($c_b[10]); ?>><?php echo ($vo['b10']); ?></td>
		<td <?php echo ($c_b[0]); ?>><?php echo ($vo['b1']+$vo['b2']+$vo['b3']+$vo['b4']+$vo['b6']+$vo['b7']); ?></td>
	<td><a href="__URL__/adminFinanceTableList/did/<?php echo ($vo['did']); ?>/uid/<?php echo ($vo['uid']); ?>" title="查看会员得奖明细">明细</a></td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
   <tr align="center">
		<td>总计：</td>
		<td <?php echo ($c_b[1]); ?>><?php echo ($count[1]); ?></td>
		<td <?php echo ($c_b[2]); ?>><?php echo ($count[2]); ?></td>
		<td <?php echo ($c_b[3]); ?>><?php echo ($count[3]); ?></td>
		<td <?php echo ($c_b[4]); ?>><?php echo ($count[4]); ?></td>
		<td <?php echo ($c_b[5]); ?>><?php echo ($count[5]); ?></td>
		<td <?php echo ($c_b[11]); ?>><?php echo ($count[1]+$count[2]+$count[3]+$count[4]); ?></td>
		<td <?php echo ($c_b[6]); ?>><?php echo ($count[6]); ?></td>
		<td <?php echo ($c_b[7]); ?>><?php echo ($count[7]); ?></td>
		<td <?php echo ($c_b[8]); ?>><?php echo ($count[8]); ?></td>
		<td <?php echo ($c_b[9]); ?>><?php echo ($count[9]); ?></td>
		<td <?php echo ($c_b[10]); ?>><?php echo ($count[10]); ?></td>
		<td <?php echo ($c_b[0]); ?>><?php echo ($count[1]+$count[2]+$count[3]+$count[4]+$count[6]+$count[7]); ?></td>
		<td <?php echo ($c_b[12]); ?>>&nbsp;</td>
	</tr>
</table>
<tr align="center">
    <td colspan="26" align="left">
    <input name="button3" type="button" onclick="window.location.href='__URL__/financeDaoChu/did/<?php echo ($did); ?>'" value="导出Excel" class="button_text" />
    &nbsp;&nbsp;&nbsp;
    <input name="button4" type="button" onclick="window.location.href='__URL__/financeDaoChuTwo/did/<?php echo ($did); ?>'" value="导出WPS" class="button_text" />
    &nbsp;&nbsp;&nbsp;
    <input name="button4" type="button" onclick="window.location.href='__URL__/financeDaoChuTXT/did/<?php echo ($did); ?>'" value="导出TXT" class="button_text" />
    </td>
</tr>
<table width="100%" cellpadding=0 cellspacing=1 border=0>
   <tr align="center" class="content_td">
     <td colspan="10"><?php echo ($page); ?></td>
    </tr>
</table>
<table width="600" align="center">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
    <td align="center"><form method='post' action="__URL__/adminFinanceTableShow/">搜索会员：<input type="text" name="UserID" title="帐号查询">
    <input type="submit" name="Submit" value="查询"  class="button_text"/>
    <input name="did" type="hidden" id="did" value="<?php echo ($did); ?>" />
    </form></td>
    </tr>
</table>
</div>
</body>
</html>
<script>new TableSorter("tb1");</script>