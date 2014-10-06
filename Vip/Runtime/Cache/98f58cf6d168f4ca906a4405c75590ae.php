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
<div class="accounttitle"><h1>交易列表 </h1></div>&nbsp;
<!-- 列表显示区域  -->

<h2>出售金币</h2>
<table width="100%" cellpadding=3 border=0 cellspacing="1" id="tb1" bgcolor="#b9c8d0" class="tab3">
<thead>
    <tr class="content_td" align="center" style="color:#1d7901;">
        <th nowrap ><span>交易编号</span></th>
        <th nowrap ><span>会员编号</span></th>
        <th nowrap ><span>出售金币</span></th>
        <th nowrap ><span>出售总价</span></th>
        <th nowrap ><span>剩余金币</span></th>
        <th nowrap ><span>出售时间</span></th>
        <th nowrap ><span>交易状态</span></th>
        <th nowrap ><span>操作</span></th>

    </tr>
</thead>
<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="content_td" align="center">
	<td><?php echo ($vo['id']); ?></td>
	<td><?php echo ($vo['user_id']); ?></td>
	<td><b><font color='green'><?php echo ($vo['nums']); ?></font></b></td>
	<td><b><font color='red'><?php echo ($vo['price']); ?></font></b></td>
        <td><b><font color='blue'><?php echo ($vo['end_nums']); ?></font></b></td>
	<td><?php echo (date("Y-m-d H:i:s",$vo['time'])); ?></td>
	<td><?php echo (status($vo['status'])); ?></td>
        <td><?php if(($vo["status"] == 0) and ($vo["user_id"] == $user_id)): ?><input type="button" class="button_text" value='取消' onclick='if(confirm("真的取消交易号 <?php echo ($vo["id"]); ?>?")) location.href="__URL__/xiajia/id/<?php echo ($vo["id"]); ?>";else return false;'/><?php elseif($vo["status"] == 0): ?><input type="button" class="button_text" onclick="open_black(<?php echo ($vo['id']); ?>,<?php echo ($vo['end_nums']); ?>,<?php echo ($vo['danjia']); ?>)" value="购买"/><?php else: ?>已结束<?php endif; ?></td>
</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td><?php echo ($page); ?></td>
    </tr>
</table>
<div style='height:50px;'></div>
<h2>买入金币</h2>

<table width="100%" cellpadding=3 border=0 cellspacing="1" id="tb2" bgcolor="#b9c8d0" class="tab3">
<thead>
    <tr class="content_td" align="center" style="color:#1d7901;">
        <th nowrap ><span>交易编号</span></th>
        <th nowrap ><span>会员编号</span></th>
        <th nowrap ><span>买入金币</span></th>
        <th nowrap ><span>买入价格</span></th>
        <th nowrap ><span>买入时间</span></th>
        <th nowrap ><span>交易状态</span></th>
        <!--<th nowrap ><span>操作</span></th>-->

    </tr>
</thead>
<?php if(is_array($list1)): $i = 0; $__LIST__ = $list1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="content_td" align="center">
	<td><?php echo ($vo['id']); ?></td>
	<td><?php echo ($vo['user_id']); ?></td>
	<td><font color='blue'><?php echo ($vo['nums']); ?></font></td>
	<td><font color='red'><?php echo ($vo['price']); ?></font></td>
	<td><?php echo (date("Y-m-d H:i:s",$vo['time'])); ?></td>
	<td><?php echo (statuss($vo['status'])); ?></td>

</tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>
<table width="100%" class="tab3_bottom" border="0" cellpadding="0" cellspacing="1">
    <tr>
        <td><?php echo ($page1); ?></td>
    </tr>
</table>
</div>

<div id="black">
    
    
</div>
<div id="white">
    <form method='post' id="myform" action="__URL__/mairuAC" >
        <table width="100%" cellpadding=3 border=0 cellspacing="1" id="tb2" bgcolor="#b9c8d0" class="tab3">
            <tr>
                <td align='right'>交易编号：</td><td align='left' style='padding-left:10px; height: 40px;'><input style='background-color:#ddd;' readonly type="text" id='id' name='id'/></td></tr><tr>
                <td align='right' style='color:red'>剩余金币：</td><td align='left' style='padding-left:10px; height: 40px;'><font color='blue' id='end_nums' name='end_nums'></font></td></tr>
                <td align='right' style='color:red'>购买金币：</td><td align='left' style='padding-left:10px; height: 40px;'><input type="text" name='nums' id="nums" onclick='check_null(this)' onkeyup="onkey();" value="0" onblur='check_end(this.value)'/></td></tr>
             <tr>   <td align='right' style='color:blue'>购买价格：</td><td align='left' style='padding-left:10px;height: 40px;'><input type="text" name='price' id="price" style='background-color:#ddd;' value="0" readonly/></td></tr>
             <tr>   <td align='right'>&nbsp;</td><td align='left' style='padding-left:10px;height: 40px;'><input type="hidden" name="danjia" id="danjia" value=""><input type="submit" name='submit' value='抢购' onclick="if(confirm('确定购买?')) return true;else return false;" class='button_text'/>&nbsp;&nbsp;&nbsp;<input type="reset" name='reset' onclick='close1();' value='取消' class='button_text'/></td>
            </tr>
        </table>
    </form>
    </div>
</body>
</html>
<script>
    function check_end(e){
        var s=document.getElementById('end_nums').innerHTML;
        var ss=parseFloat(s);
        if(e>ss){
            alert("购买数量错误!");
            document.getElementById('nums').value='0';
            document.getElementById('price').value='0';
        }
    }
    function onkey(){
        var d=document.getElementById('danjia').value;
        var nums=document.getElementById('nums').value;
        document.getElementById('price').value=nums*d;
    }
    function check_null(e){
        if(e.value==0){
            e.value='';
        }
    }
    function open_black(e,v,d){
        document.getElementById('black').style.display='block';
        document.getElementById('white').style.display='block';
        document.getElementById('id').value=e;
        document.getElementById('end_nums').innerHTML=v;
        document.getElementById('danjia').value=d;
    }
    function close1(){
        document.getElementById('black').style.display='none';
        document.getElementById('white').style.display='none';
    }
</script>
<style>
    h2{text-align: center; font-family:'黑体'}
    #black{ background-color: black; position:fixed; left:0;top:0;opacity:0.5; width:100%; height:100%; display: none}
    #white{ padding:5px; padding-top: 20px;border-radius:5px;box-shadow: 10px 10px 14px #737373;background-color: white; position:fixed; left:0;top:0;width: 300px;height:50%; margin-top:30px; margin-left: 300px;opacity:1; display: none}
</style>
<script>new TableSorter("tb1");new TableSorter("tb2");</script>