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
<div class="accounttitle"><h1>奖金明细 </h1></div>
<table width="100%" class="tab3" border="0" cellpadding="3" cellspacing="1" id="tb1" bgcolor="#b9c8d0">
	<thead>
		<tr>
			<th><span>结算时间</span></th>
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
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
		<td><?php echo (date('Y-m-d',$vo['e_date'])); ?></td>
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
		<td <?php echo ($c_b[0]); ?>><?php echo ($vo['b1']+$vo['b2']+$vo['b3']+$vo['b4']+$vo['b6']+$vo['b7']+$vo['b8']+$vo['b9']+$vo['b10']); ?></td>
		<td <?php echo ($c_b[12]); ?>><a href="__URL__/financeShow/RDT/<?php echo ($vo['s_date']); ?>/PDT/<?php echo ($vo['e_date']); ?>/cid/<?php echo ($cid); ?>" title="这一期明细">明细</a></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
	<tr align="center">
		<td>总计：</td>
		<td <?php echo ($c_b[1]); ?>><?php echo ($count[1]); ?></td>
		<td <?php echo ($c_b[2]); ?>><?php echo ($count[2]); ?></td>
		<td <?php echo ($c_b[3]); ?>><?php echo ($count[3]); ?></td>
		<td <?php echo ($c_b[4]); ?>><?php echo ($count[4]); ?></td>
		<td <?php echo ($c_b[5]); ?>><?php echo ($count[5]); ?></td>
		<td <?php echo ($c_b[11]); ?>><?php echo ($count[1]+$count[2]+$count[3]+$count[4]+$count[6]+$count[7]+$count[8]+$count[9]+$count[10]); ?></td>
		<td <?php echo ($c_b[6]); ?>><?php echo ($count[6]); ?></td>
		<td <?php echo ($c_b[7]); ?>><?php echo ($count[7]); ?></td>
		<td <?php echo ($c_b[8]); ?>><?php echo ($count[8]); ?></td>
		<td <?php echo ($c_b[9]); ?>><?php echo ($count[9]); ?></td>
		<td <?php echo ($c_b[10]); ?>><?php echo ($count[10]); ?></td>
		<td <?php echo ($c_b[0]); ?>><?php echo ($count[1]+$count[2]+$count[3]+$count[4]+$count[6]+$count[7]+$count[8]+$count[9]+$count[10]); ?></td>
		<td <?php echo ($c_b[12]); ?>>&nbsp;</td>
	</tr>
</table>
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
    <tr>
    	<td width="50%"><form id="form1" name="form1" method="post" action="__URL__/financeTable">日期：<input name="FanNowDate" type="text" id="FanNowDate" onFocus="showCalendar(this)" readonly /> <input type="submit" name="Submit" value="查询" class="button_text" /></form></td>
        <td width="50%"><?php echo ($page); ?></td>
  </tr>
</table>
</div>
</body>
</html>
<script>new TableSorter("tb1");</script>