<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title><?php echo ($System_namex); ?></title>
<link href="__PUBLIC__/other/Css/body.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/other/Css/menu.css" rel="stylesheet" media="screen" type="text/css" />
<link href="__PUBLIC__/other/Css/main.css" rel="stylesheet" media="all" type="text/css" />
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/other/Js/jquery-1.7.2.js\"></sc"+"ript>")</script>
<script type="text/javascript">document.write("<scr"+"ipt src=\"__PUBLIC__/other/Js/jquery.blockUI.js\"></sc"+"ript>")</script>
<script type="text/javascript">
var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;
var jq = jQuery.noConflict();
function jsddm_open()
{	jsddm_canceltimer();
	jsddm_close();
	ddmenuitem = jq(this).find('ul').eq(0).css('visibility', 'visible');}

function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{	if(closetimer)
	{	window.clearTimeout(closetimer);
		closetimer = null;}}

jq(document).ready(function()
{	jq('#jsddm > li').bind('mouseover', jsddm_open);
	jq('#jsddm > li').bind('mouseout',  jsddm_timer);});

document.onclick = jsddm_close;
  </script>
<script type="text/javascript">
function setPrice(data1,data2,data3){
	data = parseInt(data1) * parseInt(jq("#num"+data2+"").val());
	jq ("#price"+data3).html(data);
	var zprice = 0;
	for (i=0;i<30;i++){
	   if (jq ("#price"+i).html()){
		   zprice += parseInt(jq ("#price"+i).html());
	   }
	}
	jq ("#zprice").html(zprice);
}
</script>
</head>
<body class="indexbg">
<div class="header_bg">
    
</div>

<div id="container" >
<div id="maincont">

<div id="header">
<div class="top_title" style="color:#fff">
	<div id="nihao"></div>  
</div>
	<div class="top_user">欢迎您：<?php echo ($fck_rs['user_id']); ?><br>
    </div>
    <div id="menu_all">
                        <ul id="jsddm">
                            <li><a href="__APP__/">首页</a>
                            </li>

                            <li><a href="#">个人管理</a>
                                <ul>
                                    <li><a href="__APP__/Public/cody/c_id/1" target="main">修改资料</a></li>
                                    <li><a href="__APP__/Public/cody/c_id/2" target="main">修改密码</a></li>
                                </ul>
                            </li>

                            <li><a href="#">财务管理</a>
                                <ul>
                                    <li><a href="__APP__/Public/cody/c_id/3" target="main">账户查询</a></li>
                                    <li><a href="__APP__/Fck/cody/c_id/9" target="main">奖金明细</a></li>
                                    <li><a href="__APP__/Fck/cody/c_id/6" target="main">账户转账</a></li>
                                    <li><a href="__APP__/Fck/cody/c_id/7" target="main">货币提现</a></li>
                                    <li><a href="__APP__/Fck/cody/c_id/10" target="main">充值申请</a></li>
                                    <!--<li><a href="__APP__/Fck/cody/c_id/18" target="main">晋级申请</a></li>-->
                                    <!--<li><a href="__APP__/Recharge/cody/c_id/3" target="main">在线充值</a></li>-->
                                    <!--<li><a href="__APP__/Phonecard/cody/c_id/2" target="main">电话卡记录</a></li>-->
                                </ul>
                            </li>

                            <li><a href="#">市场管理</a>
                                <ul>
                                    
                                    <li><a href="__APP__/Fck/users" target="main">注册会员</a></li>
                                    <!--<li><a href="__APP__/Tree/cody/c_id/5" target="main">系统架构图</a></li>-->
                                    <?php if(($fck_rs['is_boss']) >= "1"): ?><li><a href="__APP__/Tree/cody/c_id/6" target="main">推荐关系图</a></li>
                                    <li><a href="__APP__/Fck/cody/c_id/3" target="main">查看推荐关系</a></li><?php endif; ?>
                                    <!--<li><a href="__APP__/Tree/cody/c_id/8" target="main">公排网络图</a></li>-->
                                    <li><a href="__APP__/Fck/cody/c_id/4" target="main">申请报单中心</a></li>
                                    <li><a href="__APP__/Fck/cody/c_id/1" target="main">未开通会员</a></li>
                                    <li><a href="__APP__/Fck/list_new" target="main">新增账户管理</a></li>
                                    <!--<li><a href="__APP__/Agent/cody/c_id/3" target="main">已开通会员</a></li>-->
                                </ul>
                            </li>
                            
                            <li><a href="#">交易市场</a>
                                <ul>
                                    
                                    <li><a href="__APP__/Fck/list_jinbi" target="main">交易列表</a></li>
                                    <li><a href="__APP__/Fck/sell_jinbi" target="main">出售金币</a></li>
                                </ul>
                            </li>
                            
                            <li style="display: none"><a href="#">交易市场</a>
                                <ul>
                                    <!--<li><a href="__APP__/Gupiao/trade" target="main">实时走势</a></li>-->
                                    <li><a href="__APP__/Gupiao/cody/c_id/9" target="main">股票走势图</a></li>
                                    <li><a href="__APP__/Gupiao/cody/c_id/1" target="main">电子股买入</a></li>
                                    <li><a href="__APP__/Gupiao/cody/c_id/3" target="main">电子股卖出</a></li>
                                    <li><a href="__APP__/Gupiao/cody/c_id/4" target="main">电子股行情</a></li>
                                    <?php if(($fck_rs['is_boss']) >= "1"): ?><li><a href="__APP__/Gupiao/cody/c_id/3" target="main">公司卖出电子股</a></li>
                                        <li><a href="__APP__/Gupiao/cody/c_id/5" target="main">电子股参数设置</a></li>
                                        <li><a href="__APP__/Gupiao/cody/c_id/7" target="main">购买列表</a></li>
                                        <li><a href="__APP__/Gupiao/cody/c_id/8" target="main">出售列表</a></li><?php endif; ?>
                                </ul>
                            </li>

                            <!--<li><a href="#">EP交易市场</a>
                            <ul>
                            <li><a href="__APP__/Cash/eb_sell/" target="main">卖出货币</a></li>
                            <li><a href="__APP__/Cash/eb_buy/" target="main">买入货币</a></li>
                            <li><a href="__APP__/Cash/cody/c_id/3/" target="main">买入记录</a></li>
                            <li><a href="__APP__/Cash/cody/c_id/4/" target="main">卖出记录</a></li>
                            <li><a href="__APP__/Cash/cody/c_id/5/" target="main">历史查询</a></li>
                            </ul>
                            </li>-->

                            <li><a href="#">信息交流</a>
                                <ul>
                                    <li><a href="__APP__/News/index/" target="main">新闻中心</a></li>
                                    <li><a href="__APP__/Public/plan" target="main">市场计划</a></li>
                                    <!--<li><a href="__APP__/Down/Down/" target="main">下载中心</a></li>-->
                                    <li><a href="__APP__/Fck/inMessages/" target="main">收件箱</a></li>
                                    <li><a href="__APP__/Fck/outMessages/" target="main">发件箱</a></li>
                                    <li><a href="__APP__/Fck/messages/" target="main">写邮件</a></li>
                                </ul>
                            </li>

                            <?php if(($fck_rs['is_boss']) >= "1"): ?><li><a href="#">后台管理</a>
                                    <ul>
                                         <li><a target="main" onclick="if(confirm('确定分红吗?')) this.href='__APP__/Test/xxx';else return false;">日分红模拟</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/5" target="main">当期出纳</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/8" target="main">奖金查询</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/1" target="main">会员审核</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/2" target="main">会员管理</a></li>
                                        <!--<li><a href="__APP__/YouZi/cody/c_id/24" target="main">物流管理</a></li>-->
                                        <!--<li><a href="__APP__/YouZi/cody/c_id/26" target="main">产品管理</a></li>-->
                                        <li><a href="__APP__/YouZi/cody/c_id/10" target="main">服务中心管理</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/18" target="main">货币流向</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/6" target="main">提现管理</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/12" target="main">充值管理</a></li>
                                        <!--<li><a href="__APP__/YouZi/cody/c_id/28" target="main">重复消费清单</a></li>-->
                                        <li><a href="__APP__/News/index/" target="main">新闻公告管理</a></li>
                                        <li><a href="__APP__/News/plan/" target="main">奖励计划设置</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/7" target="main">数据库备份</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/3" target="main">参数设置</a></li>
                                        <li><a href="__APP__/YouZi/cody/c_id/9" target="main">清空数据</a></li>
                                    </ul>
                                </li><?php endif; ?>
                            <li>
                                <a href="__APP__/Public/LogOut" onClick="{
                            if (confirm('确定安全退出吗?')) {
                                return true;
                            }
                            return false;
                        }" target="_top">退　出</a>
                            </li>
                        </ul>
                    </div>

<div class="logo"></div>
</div>


<div id="center_layout" style="padding-top:0;">

<iframe id="main" style="z-index: 1; width:100%" name="main" src="__APP__/Public/main" frameborder="0" scrolling="auto"   onload="turnHeight('main');" target="self" allowtransparency="true"></iframe>

<div class="clear10"></div>
  
</div>
</div>
</div>
<div class="footer">Copyright © 2013-2023 <?php echo ($System_namex); ?> ,All Right Reserved.</div>
</body>
</html>
<script language="javascript">
function turnHeight(iframe)
{
	
    var frm = document.getElementById(iframe);
	frm.height = 500;
    var subWeb = document.frames ? document.frames[iframe].document : frm.contentDocument;
    if(frm != null && subWeb != null)
    {
	if (subWeb.body.scrollHeight<500){
	frm.height = 500;
	}else{
	frm.height = subWeb.body.scrollHeight + 20;
	}
	}
}
</script>
<script language="javascript">
	function settime()
		{
		var myyear,mymonth,myweek,myday,mytime,mymin,myhour,mysec;
		function initArray(){
			this.length=initArray.arguments.length;
			for(var i=0;i<this.length;i++){
				this[i+1]=initArray.arguments[i];
			}
		}
		var d=new initArray(" 星期日"," 星期一"," 星期二"," 星期三"," 星期四"," 星期五"," 星期六");
	    var mydate=new Date();
		myyear=mydate.getFullYear();
		mymonth=mydate.getMonth()+1;
		myday=mydate.getDate();
		myhour=mydate.getHours();
		mymin=mydate.getMinutes();
		mysec=mydate.getSeconds();
		mytime =   myyear+"年"+mymonth+"月"+myday+"日" + " " + d[mydate.getDay()+1] + " "+myhour+":"+mymin+":"+mysec;
		if(mytime.length<25){
			for(var i=mytime.length;i<=25;i++){
				mytime += "&nbsp;";
			}
		}
		document.getElementById("nihao").innerHTML =  "<img src=__PUBLIC__/other/Images/top_time.gif  style=float:left;padding-top:2px />" + "&nbsp;" + "" + mytime;
		setTimeout('settime()',1000);
	}
	settime();
</script>