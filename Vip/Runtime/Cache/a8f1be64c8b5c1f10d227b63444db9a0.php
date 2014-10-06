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

<script type="text/javascript" src="__PUBLIC__/Js/Ajax/ThinkAjax-1.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/UserJs.js"></script>
<script language='javascript'>
 function CheckForm(){
	if(confirm('您确定提现金额 '+document.form1.ePoints.value+' 吗？'))
	{
	  return true;
	}else{
       return false;
    }
}
function yhServer(Ful){
	str = $F(Ful).replace(/^\s+|\s+$/g,"");
	ThinkAjax.send('__URL__/check_CCuser/','ajax=1&userid='+str,'',Ful+'1');
}
</script>
<div class="ncenter_box">
<div class="accounttitle"><h1>提现申请 </h1></div>
  <table width="100%" border="0" cellpadding="3" cellspacing="0">
    <form name="form1" method="post" action="__URL__/frontCurrencyConfirm" onSubmit="{return CheckForm();}">
      <tr>
        <td>&nbsp;</td>
        <td width="15%">&nbsp;</td>
        <td width="61%">&nbsp;</td>
      </tr>
      
          
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">奖金账户：<span class="hong"><?php echo ($rs['agent_use']); ?></span></td>
      </tr>
      <tr>
        <td width="24%">&nbsp;</td>
        <td colspan="2"><span style="color:red;">提现手续费 <?php echo ($menber); ?> %，最低提现金额为 <?php echo ($minn); ?> 元</span></td>
        </tr>
        
        <tr>
            <td align="right"><span class="zc_hong">*</span> 开户银行：</td>
            <td><select name="BankName" onChange="javasctip:bank_us(this.value);">
              <?php if(is_array($bank)): $i = 0; $__LIST__ = $bank;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($bank[$key]); ?>"><?php echo ($bank[$key]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right"><span class="zc_hong">*</span> <span id="bank_id"><?php if(($bank[0]) == "财付通"): ?>财付通号<?php else: ?>银行卡号<?php endif; ?></span>：</td>
            <td><input name="BankCard" type="text" class="ipt" id="BankCard" onFocus="notice('8','')"  onblur="notice('8','none')" onKeyUp="javascript:Null_Int(this.name)" value="" maxlength="19" /></td>
            <td><div id="BankCard1" class="info"><div id="8" class="focus_r" style="display:none;"><div class="msg_tip">请输入您的号码。</div></div></div></td>
          </tr>
          <tr>
            <td align="right"><span class="zc_hong">*</span> 开户姓名：</td>
            <td><input name="UserName" type="text" class="ipt"  id="UserName" onFocus="notice('9','')"  onblur="notice('9','none')" onKeyUp="javascript:Null_Full(this.name)" value="" maxlength="10" /></td>
            <td><div id="UserName1" class="info"><div id="9" class="focus_r" style="display:none;"><div class="msg_tip">请输入您的姓名。</div></div></div></td>
          </tr>
          <tr>
            <td align="right">开户省份：</td>
            <td><select name="BankProvince" id="s1" >
                <option></option>
              </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">开户城市：</td>
            <td><select name="BankCity" id="s2" >
                <option></option>
              </select></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="right">详细开户地址：</td>
            <td><input name="BankAddress" type="text" class="ipt" id="BankAddress" value="" /></td>
            <td><div id="BankAddress1" class="info"><div id="10" class="focus_r" style="display:none;"><div class="msg_tip">请输入您的详细开户地址。</div></div></div></td>
          </tr>
      <tr>
          <tr>
            <td align="right">电话号码：</td>
            <td><input name="tel" type="text" class="ipt" id="tel" value="" /></td>
            <td><div id="tel" class="info"><div id="11" class="focus_r" style="display:none;"><div class="msg_tip">请输入您的详细开户地址。</div></div></div></td>
          </tr>
      <tr>
        <td align="right"><?php echo ($User_namex); ?>：</td>
        <td><?php if(($type) == "1"): ?><input name="UserID" id="UserID" type="text" value="<?php echo ($rs['user_id']); ?>" class="ipt" onkeyup="javascript:yhServer(this.name);" onfocus="notice('0','')"  onblur="notice('0','none')" />
          <?php else: ?>
          <input name="UserID" type="text" readonly="readonly" value="<?php echo ($rs['user_id']); ?>"/><?php endif; ?></td>
        <td><div id="UserID1" class="info"><div id="0" class="focus_r" style="display:none;"><div class="msg_tip">请输入要提现的<?php echo ($User_namex); ?>。</div></div></div></td>
      </tr>
      <script language = JavaScript>
            var s=["s1","s2"];
            var opt0 = ["请选择","请选择"];
            function setup()
            {
                for(i=0;i<s.length-1;i++)
                document.getElementById(s[i]).onchange=new Function("change("+(i+1)+")");
                change(0);
            }
            setup();
          </script>
      <tr>
        <td align="right"> 提现金额：</td>
        <td>
        <input name="ePoints" type="text" id="ePoints" value=""/></td>
        <td></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><input type="submit" name="Submit" value="确定提现" class="button_text" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </form>
  </table>
  <br />
<table width="100%" class="tab3" border="0" cellpadding="3" cellspacing="1" id="tb1" bgcolor="#b9c8d0">
  <thead>
		<tr>
			<th><span><?php echo ($User_namex); ?></span></th>
			<th><span>提现金额</span></th>
			<th><span>实发金额</span></th>
			<th><span>提现时间</span></th>
			<th><span>银行资料</span></th>
            <th><span>提现状态</span></th>
		</tr>
	</thead>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr align="center">
		<td><?php echo ($rs['user_id']); ?></td>
        <td><?php echo ($vo['money']); ?></td>
        <td><?php echo ($vo['money_two']); ?></td>
        <td><?php echo (date('Y-m-d H:i:s',$vo["rdt"])); ?></td>
        <td><a id="az<?php echo ($vo["id"]); ?>" href="javascript:void(0)" onclick="ziliao(<?php echo ($vo["id"]); ?>)">点击查看</a><a  id="azg<?php echo ($vo["id"]); ?>" href="javascript:void(0)" style="display:none" onclick="ziliaog(<?php echo ($vo["id"]); ?>)">关闭查看</a><div id="ziliao<?php echo ($vo["id"]); ?>" style="display: none">开户人:<?php echo ($vo["user_name"]); ?><br>开户银行:<?php echo ($vo["user_name"]); ?><br>银行账户:<?php echo ($vo["bank_card"]); ?><br>开户地区:<?php echo ($vo["bank_address"]); ?></div></td>
        <td><?php if(($vo['is_pay']) == "0"): ?><span style="color: #FF3300;">未确认</span><?php endif; ?>	<?php if(($vo['is_pay']) == "1"): ?>已确认<?php endif; ?></td>
	</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
  <script>
      function ziliao(e){
          document.getElementById('ziliao'+e).style.display='block';
          document.getElementById('az'+e).style.display='none';
          document.getElementById('azg'+e).style.display='block';
      }
      function ziliaog(e){
          document.getElementById('ziliao'+e).style.display='none';
          document.getElementById('az'+e).style.display='block';
          document.getElementById('azg'+e).style.display='none';
      }
  </script>
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td align="center"><?php echo ($page); ?></td>
    </tr>
</table>
</div>
</body>
</html>
<script>new TableSorter("tb1");</script>