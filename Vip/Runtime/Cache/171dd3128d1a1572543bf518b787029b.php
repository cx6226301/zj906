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

<script type="text/javascript" src="__PUBLIC__/Js/UserJs.js"></script>
<script language='javascript'>
function CheckForm(){
	if(document.form1.ePoints.value==""){
		alert("请输入金额！");
		document.form1.ePoints.focus();
		return false;
	}
	if(confirm('您确定充值金额 '+document.form1.ePoints.value+' 吗？'))
	{
		var Null_Name = document.form1._hour.value;
		if (Null_Name)
		{
			str = Null_Name.replace(/^\s+|\s+$/g,"");
			if (!str == "")//判断是否为空
			{
				if (!isNaN(Null_Name))
				{
					if(Null_Name >= 0 && Null_Name <=24){
						return true;
					}else{ alert('小时输入有误'); return false; }
				}else{ alert('请输入数字'); return false; }

			}
		}
	}else{
	alert('您取消了本次操作');
       return false;
    }
}

</script>
<div class="ncenter_box">
<div class="accounttitle"><h1>充值申请 </h1></div>
    <div class="c_p5"><div class="tips">汇款信息：<?php echo ($s17); ?></div></div>
  <table width="100%" border="0" cellpadding="3" cellspacing="0">
    <tr>
      <td colspan="4" style=" height:5px;"><hr></td>
      </tr>
    <tr>
      <td align="right">报单币账户余额：</td>
      <td colspan="2"><span class="hong"><?php echo ($frs['agent_cash']); ?></span></td>
      </tr>
	<tr style="display:none">
      <td align="right">开通币余额：</td>
      <td colspan="2"><span class="hong"><?php echo ($frs['agent_kt']); ?></span></td>
      </tr>
    <form name="form1" method="post" action="__URL__/currencyRechargeAC" onSubmit="{return CheckForm();}">
    <tr>
	  <td align="right">购买报单币数量：</td>
	  <td width="40%"><input name="ePoints" type="text" id="ePoints" maxlength="9" class="ipt" onkeyup="javascript:Null_Int(this.name)" onfocus="notice('0','')"  onblur="notice('0','none')"/></td>
	  <td width="40%"><div id="ePoints1" class="info"><div id="0" class="focus_r" style="display:none;"><div class="msg_tip">请输入你要购买的电子币数量。</div></div></div></td>
    </tr>
    <tr>
	  <td align="right">购买类型：</td>
	  <td>
      <select name="stype">
      <option value="0">充值报单币</option>
      <!--<option value="1">充值开通币</option>-->
      </select></td>
	  <td></td>
    </tr>
    <tr>
      <td align="right">已汇款数额：</td>
	  <td ><input name="_money" type="text" id="_money" class="ipt" onkeyup="javascript:Null_Int(this.name)" onfocus="notice('1','')"  onblur="notice('1','none')" />
      </td><td><div id="_money1" class="info"><div id="1" class="focus_r" style="display:none;"><div class="msg_tip">请输入你汇款数额。</div></div></div></td>
    </tr>
    <tr>
      <td align="right">已汇款到账号：</td>
	  <td ><input name="_num" type="text" id="_num" class="ipt" onkeyup="javascript:Null_Int(this.name)" onfocus="notice('2','')"  onblur="notice('2','none')" />
      </td><td><div id="_num1" class="info"><div id="2" class="focus_r" style="display:none;"><div class="msg_tip">请输入你要汇款到的账号。</div></div></div></td>
    </tr>
    <tr>
      <td align="right" width="20%">汇款时间：</td>
	  <td colspan="2" width="80%">
      	  <input name="_year" size="5" type="text" id="_year" value=<?php echo ($nowdate['0']); ?>  /> 年
      	  <input name="_month" size="5" type="text" id="_month" value=<?php echo ($nowdate['1']); ?> /> 月
          <input name="_date" size="5" type="text" id="_date" value=<?php echo ($nowdate['2']); ?>  /> 日
          <input name="_hour" size="5" type="text" id="_hour" /> 时&nbsp;<span class="hong">(请输入汇款时间)</span>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="确定充值" class="button_text" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	</form>
</table>
<br>
<table width="100%" class="tab3" border="0" cellpadding="3" cellspacing="1" id="tb1" bgcolor="#b9c8d0">
	<thead>
		<tr>
			<th><span><?php echo ($User_namex); ?></span></th>
			<th><span>购买报单币数量</span></th>
			<th><span>充值类型</span></th>
			<th><span>购买时间</span></th>
            <th><span>汇款数额</span></th>
            <th><span>汇到账号</span></th>
			<th><span>充值状态</span></th>
		</tr>
	</thead>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
        <td><?php echo ($vo['user_id']); ?></td>
        <td><?php echo ($vo['epoint']); ?></td>
        <td><?php if(($vo["stype"]) == "0"): ?>充入报单币<?php else: ?>充入开通币<?php endif; ?></td>
        <td><?php echo (date('Y-m-d H:i:s',$vo["rdt"])); ?></td>
        <td><?php echo ($vo['huikuan']); ?></td>
        <td><?php echo ($vo['zhuanghao']); ?></td>

        <td><?php if(($vo['is_pay']) == "0"): ?><span style="color: #FF3300;">未确认</span><?php endif; if(($vo['is_pay']) == "1"): ?>已确认<?php endif; ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
  <tr>
        <td align="center"><?php echo ($page); ?></td>
    </tr>
</table>
</div>
</body>
</html>
<script>new TableSorter("tb1");</script>