<?php

class FckModel extends CommonModel {

    //数据库名称

    public function xiangJiao($Pid = 0, $DanShu = 1) {
        //========================================== 往上统计单数
        $where = array();
        $where['id'] = $Pid;
        $field = 'treeplace,father_id';
        $vo = $this->where($where)->field($field)->find();
        if ($vo) {
            $Fid = $vo['father_id'];
            $TPe = $vo['treeplace'];
            $table = $this->tablePrefix . 'fck';
            if ($TPe == 0 && $Fid > 0) {
                $this->execute("update " . $table . " Set `l`=l+$DanShu, `benqi_l`=benqi_l+$DanShu  where `id`=" . $Fid);
            } elseif ($TPe == 1 && $Fid > 0) {
                $this->execute("update " . $table . " Set `r`=r+$DanShu, `benqi_r`=benqi_r+$DanShu  where `id`=" . $Fid);
            } elseif ($TPe == 2 && $Fid > 0) {
                $this->execute("update " . $table . " Set `lr`=lr+$DanShu, `benqi_lr`=benqi_lr+$DanShu  where `id`=" . $Fid);
            }
            if ($Fid > 0)
                $this->xiangJiao($Fid, $DanShu);
        }
        unset($where, $field, $vo);
    }

    public function addencAdd($ID = 0, $inUserID = 0, $money = 0, $name = null, $UID = 0, $time = 0, $acttime = 0, $bz = "") {
        //添加 到数据表
        if ($UID > 0) {
            $where = array();
            $where['id'] = $UID;
            $frs = $this->where($where)->field('nickname')->find();
            $name_two = $name;
            $name = $frs['nickname'] . ' 开通会员 ' . $inUserID;
            $inUserID = $frs['nickname'];
        } else {
            $name_two = $name;
        }

        $data = array();
        $history = M('history');

        $data['user_id'] = $inUserID;
        $data['uid'] = $ID;
        $data['action_type'] = $name;
        if ($time > 0) {
            $data['pdt'] = $time;
        } else {
            $data['pdt'] = mktime();
        }
        $data['epoints'] = $money;
        if (!empty($bz)) {
            $data['bz'] = $bz;
        } else {
            $data['bz'] = $name;
        }
        $data['did'] = 0;
        $data['type'] = 1;
        $data['allp'] = 0;
        if ($acttime > 0) {
            $data['act_pdt'] = $acttime;
        }
        $history->add($data);
        unset($data, $history);
    }

    public function huikuiAdd($ID = 0, $tz = 0, $zk, $money = 0, $nowdate = null) {
        //添加 到数据表

        $data = array();
        $huikui = M('huikui');
        $data['uid'] = $ID;
        $data['touzi'] = $tz;
        $data['zhuangkuang'] = $zk;
        $data['hk'] = $money;
        $data['time_hk'] = $nowdate;
        $huikui->add($data);
        unset($data, $huikui);
    }

    //对碰1：1
    public function touch1to1(&$Encash, $xL = 0, $xR = 0, &$NumS = 0) {
        $xL = floor($xL);
        $xR = floor($xR);

        if ($xL > 0 && $xR > 0) {
            if ($xL > $xR) {
                $NumS = $xR;
                $xL = $xL - $NumS;
                $xR = $xR - $NumS;
                $Encash['0'] = $Encash['0'] + $NumS;
                $Encash['1'] = $Encash['1'] + $NumS;
            }
            if ($xL < $xR) {
                $NumS = $xL;
                $xL = $xL - $NumS;
                $xR = $xR - $NumS;
                $Encash['0'] = $Encash['0'] + $NumS;
                $Encash['1'] = $Encash['1'] + $NumS;
            }
            if ($xL == $xR) {
                $NumS = $xL;
                $xL = 0;
                $xR = 0;
                $Encash['0'] = $Encash['0'] + $NumS;
                $Encash['1'] = $Encash['1'] + $NumS;
            }
            $Encash['2'] = $NumS;
        } else {
            $NumS = 0;
            $Encash['0'] = 0;
            $Encash['1'] = 0;
        }
    }

    //对碰奖（市场奖）
    public function duipeng() {
        $fee = M('fee');

        $fee_rs = $fee->field('s1,s15,s5,s9,s7,s12')->find(1);
        $s1 = explode("|", $fee_rs['s1']);  //各级对碰比例
        $s9 = explode("|", $fee_rs['s9']);  //会员级别费用
        $s7 = explode("|", $fee_rs['s7']);  //
        $s5 = explode("|", $fee_rs['s5']);  //封顶
        $fbl = $fee_rs['s11'] / 100;
        $fck_array = 'is_pay>=1 and ((shangqi_l+benqi_l)>0 or (shangqi_r+benqi_r)>0)';
        $field = 'id,user_id,shangqi_l,shangqi_r,benqi_l,benqi_r,re_path,re_level,re_nums,nickname,u_level,re_id,day_feng,peng_num';
        $frs = $this->where($fck_array)->field($field)->select();
        //BenQiL  BenQiR  ShangQiL  ShangQiR
        foreach ($frs as $vo) {
            $L = 0;
            $R = 0;
            $L = $vo['shangqi_l'] + $vo['benqi_l'];
            $R = $vo['shangqi_r'] + $vo['benqi_r'];
            $Encash = array();
            $NumS = 0; //碰数
            $money = 0; //对碰奖金额
            $Ls = 0; //左剩余
            $Rs = 0; //右剩余
            $this->touch1to1($Encash, $L, $R, $NumS);
            $Ls = $L - $Encash['0'];
            $Rs = $R - $Encash['1'];
            $ss = $vo['u_level'] - 1;
            $feng = $vo['day_feng'];
            $re_nums = $vo['re_nums'];
            $peng_n = $vo['peng_num'];
            $ul = $s1[$ss] / 100;   //s1市场奖比例   
//            $pri = $ul * $s9[$ss]; //s9投资金额  pri:当前的市场奖
            $money = $NumS * 3000 * $ul; //对碰奖 奖金
            if ($feng >= $s5[$ss]) {   //检测封顶
                $money = 0;
            } else {
                $jfeng = $feng + $money;
                if ($jfeng > $s5[$ss]) {
                    $money = $s5[$ss] - $feng;
                }
            }

            $this->query('UPDATE __TABLE__ SET `shangqi_l`=' . $Ls . ',`shangqi_r`=' . $Rs . ',`benqi_l`=0,`benqi_r`=0,peng_num=peng_num+' . $NumS . ' where `id`=' . $vo['id']);

            if ($money > 0) {
                $this->query("UPDATE __TABLE__ SET `b2`=b2+" . $money . ",day_feng=day_feng+" . $money . " where `id`=" . $vo['id']);
                $this->addencAdd($vo['id'], $vo['user_id'], $money, 2); //添加奖金和记录(市场奖)
                $this->guanli($vo['re_path'], $vo['user_id'], $money, $vo['u_level']);
                $this->xinren($vo['id'], $vo['user_id'], $money, $vo['u_level']);
                //培育+互助
//           		$this->lingdao($vo['id'],$vo['re_path'],$vo['user_id'],$money,$vo['re_level']);
            }
        }
    }

    //管理奖
    public function guanli($re_path, $inUserID = 0, $Money = 0, $u_level) {
        $fee = M('fee');
        $fee_rs = $fee->field("s12,s6")->find(1);
        $s12 = explode("|", $fee_rs['s12']);    //管理奖层数
        $s6 = explode("|", $fee_rs['s6']);      //管理奖比例
        $limit = $s12[$u_level - 1];            //获取当前获得市场奖的人的管理层数
        $fck_rs = $this->where("id in(0{$re_path}0)")->field("*")->limit("0," . $limit)->order("id desc")->select();
        $i=0;
        foreach ($fck_rs as $rs) {
            $end_money = $Money * $s6[$i]/100;
            $this->execute("update __TABLE__ set b3=b3+{$end_money} where id={$rs['id']}");
            $this->addencAdd($rs['id'], $inUserID, $end_money, 3);
            $i++;
        }
    }

    //信任奖
    public function xinren($re_id, $inUserID = 0, $Money = 0, $u_level) {
        $fee = M('fee');
        $fee_rs = $fee->field("s15,s20")->find(1);
        $s15 = explode("|", $fee_rs['s15']); //信任奖层数
        $s20 = explode("|", $fee_rs['s20']); //信任奖比例
        $fck_rs = $this->where("re_id=" . $re_id)->field('id')->select();
        $count = count($fck_rs);
        $end = $Money * $s20[0]/100 / $count;
        $end_money = round($end, 2);
        if ($fck_rs) {

            foreach ($fck_rs as $rs) {

                $this->query("update __TABLE__ set b4=b4+{$end_money} where id=" . $rs['id']);
                $this->addencAdd($rs['id'], $inUserID, $end_money, 4);
                if ($u_level != 1) {  //一星不给第二代拿
                    $fck_rs1 = $this->where("re_id=" . $rs['id'])->field('id')->select();
                    $count1 = count($fck_rs1);
                    $end_money1 = $Money * $s20[1]/100 / $count1;
                    foreach ($fck_rs1 as $rs1) {
                        $this->query("update __TABLE__ set b4=b4+{$end_money1} where id=" . $rs1['id']);
                        $this->addencAdd($rs1['id'], $inUserID, $end_money1, 4);
                    }
                }
            }
        }
    }

    //招商分红
    public function fenhong($p_path, $inUserID = 0, $u_level) {
        $fee = M('fee');
        $fee_rs = $fee->field("s7,str8")->find(1);
        $s7 = explode("|", $fee_rs['s7']); //招商分红期数
        $limit = $s7[$u_level - 1];
        $fenhong = $fee_rs['str8']; //分红奖（见点）
        $fck_rs = $this->where("id in(0{$p_path}0)")->limit("0," . $limit)->order("id desc")->select();
        foreach ($fck_rs as $rs) {
            $this->query("update __TABLE__ set b5=b5+{$fenhong} where id=" . $rs['id']);
            $this->addencAdd($rs['id'], $inUserID, $fenhong, 5);
        }
    }

    //培育+互助
    public function lingdao($nid, $repath = 0, $user_id = 0, $money = 0, $relv = 0) {
        $fee = M('fee');
        $fee_rs = $fee->field('s15,s12')->find();
        $s12 = explode("|", $fee_rs['s12']); //培育奖比例
        $s15 = $fee_rs['s15'] / 100;          //互助奖比例
        //培育
        $mrs = $this->where('id in (0' . $repath . '0) and is_pay>0')->field('id,u_level')->order('re_level desc')->limit(6)->select();
        $i = 1;
        foreach ($mrs as $vo) {
            $getmon = 0;              //培育奖
            $myid = $vo['id'];
            $mylv = $vo['u_level'];   //等级
            $prii = $s12[$i - 1] / 100;   //培育依次顺序
            if ($i > 3) {                 //第4次循环
                if ($mylv == 4) {
                    $getmon = $money * $prii;
                }
            } elseif ($i > 1) {
                if ($mylv >= 3) {
                    $getmon = $money * $prii;
                }
            } else {
                if ($mylv >= 2) {
                    $getmon = $money * $prii;
                }
            }
            if ($getmon > 0) {
                $this->query("UPDATE __TABLE__ SET `b4`=b4+" . $getmon . " where `id`=" . $myid);
                $this->addencAdd($myid, $user_id, $getmon, 4); //添加奖金和记录
            }
            $i++;
        }
        unset($mrs, $vo, $myid);

        //互助一代
        $where = "re_id=" . $nid . " and is_pay>0 and u_level>=3";
        $a_nn = $this->where($where)->count();
        if ($a_nn > 0) {
            $one_mm_a = $money * $s15 / $a_nn;  //平均一个等级获得的互助金
            $lirs = $this->where($where)->field('id')->order('id asc')->select();
            foreach ($lirs as $lrs) {
                $myid = $lrs['id'];
                if ($one_mm_a > 0) {
                    $this->query("UPDATE __TABLE__ SET `b5`=b5+" . $one_mm_a . " where `id`=" . $myid);
                    $this->addencAdd($myid, $user_id, $one_mm_a, 5); //添加奖金和记录
                }
            }
            unset($lirs, $lrs);
        }
        unset($where);

        //互助二代
        $cha_relv = $relv + 2;  //相对于
        $where = "re_path like '%," . $nid . ",%' and re_level=" . $cha_relv . " and is_pay>0 and u_level=4";  //推荐路径含有$nid,
        $b_nn = $this->where($where)->count();
        if ($b_nn > 0) {
            $one_mm_b = $money * $s15 / $b_nn;  //互助奖平均值
            $lirs = $this->where($where)->field('id')->order('id asc')->select();
            foreach ($lirs as $lrs) {
                $myid = $lrs['id'];
                if ($one_mm_b > 0) {
                    $this->query("UPDATE __TABLE__ SET `b5`=b5+" . $one_mm_b . " where `id`=" . $myid);
                    $this->addencAdd($myid, $user_id, $one_mm_b, 5); //添加奖金和记录
                }
            }
            unset($lirs, $lrs);
        }
        unset($where);

        unset($fee, $fee_rs, $mrs, $vo);
    }

    public function getusjj($uid, $type = 0) {

        $mrs = $this->where('id=' . $uid)->find();
        if ($mrs) {
            //推荐奖
            $this->tuijianjiang($mrs['re_id'], $mrs['user_id'], $mrs['cpzj'], $mrs['p_path']);
            $this->fenhong($mrs['p_path'], $mrs['user_id'], $mrs['u_level']);
            //对碰奖
            $this->addcpzj($mrs['cpzj']);
            $this->duipeng();

            if ($type == 1) {
                //报单奖
//                $this->baodanfei($mrs['shop_id'], $mrs['user_id'], $mrs['cpzj']);
            }
        }
        unset($mrs);
    }

    //重消分红
    public function cxfh($p_path, $inUserID = 0,$s19=0,$ceng=0) {
        $fck_rs = $this->where("id in (0{$p_path}0)")->limit("0,".$ceng)->order("id desc")->select();
        foreach ($fck_rs as $rs) {
            $this->query("update __TABLE__ set b7=b7+{$s19} where id={$rs['id']}");
            $this->addencAdd($rs['id'], $inUserID, $s19,7);
        }
    }

    public function addcpzj($cpzj) {
        $fee = M('fee1');
        $fee->query("update __TABLE__ set zcpzj=zcpzj+{$cpzj} where id=1");
        unset($fee);
    }

    //直推奖+极差
    public function tuijianjiang($re_id = 0, $inUserID = 0, $money = 0, $p_path) {
        
        $fee = M('fee');
        $fee_rs = $fee->field('s3')->find(1);
        $fck_rs = $this->where("id={$re_id}")->field("u_level")->find();
        $u_level = $fck_rs['u_level'];
        $s3 = explode("|", $fee_rs['s3']);
        $s3 = $s3[$u_level - 1] / 100;               //当前销售奖比例
        $end_money = $money * $s3;
        if ($end_money > 0) {
            $this->execute("update __TABLE__ set b1=b1+{$end_money} where id={$re_id}");
            $this->addencAdd($re_id, $inUserID, $end_money, 1);
            
        }
    }

    //重复消费
    public function repeat($re_id, $inUserID = 0, $money) {
        $fee = M('fee');
        $fee_rs = $fee->field('str2')->find(1);
        $str2 = $fee_rs['str2'] / 100; //重复消费比例
        $end_money = $str2 * $money;

        $this->query("update __TABLE__ set b8=b8-{$end_money},repeats=repeats+{$end_money} where id={$re_id}"); //扣除重消 至 重消积累（repeat）
        $this->addencAdd($re_id, $inUserID, -$end_money, 8);
    }

    //见点奖
    public function jiandianjiang($ppath, $inUserID = 0, $plv = 0) {

        $fee = M('fee');
        $fee_rs = $fee->field('s12')->find(1);
        $prii = $fee_rs['s12'];

        $lirs = $this->where('id in (0' . $ppath . '0)')->field('id,user_id,p_level')->order('p_level desc')->select();
        $i = 0;
        foreach ($lirs as $lrs) {
            $money_count = 0;
            $myid = $lrs['id'];
            $myplv = $lrs['p_level'];
            $cha_nn = $plv - $myplv;
            if ($cha_nn % 2 == 0) {
                $money_count = $prii;
                if ($money_count > 0) {
                    $this->query("UPDATE __TABLE__ SET `b2`=b2+" . $money_count . " where `id`=" . $myid);
                    $this->addencAdd($myid, $inUserID, $money_count, 2);
                }
            }
            $i++;
        }
        unset($fee, $fee_rs, $lirs, $lrs);
    }

    //报单费
    public function baodanfei($uid, $user_id = 0, $money = 0) {

        $fee = M('fee');
        $fee_rs = $fee->field('s14')->find();
        $s14 = $fee_rs['s14'] / 100;
        $money_count = $money * $s14;

        if ($money_count > 0) {
            $this->query("UPDATE __TABLE__ SET `b6`=b6+" . $money_count . " where `id`=" . $uid);
            $this->addencAdd($uid, $user_id, $money_count, 6);
        }
        unset($fee, $fee_rs);
    }

    //扣税
    public function ap_koushui() {

        $fee = M('fee');
        $fee_rs = $fee->field('s13')->find();
        $s13 = $fee_rs['s13'] / 100; //税

        $where = array();
        $where['b0'] = array('gt', 0);
        $mrs = $this->where($where)->field('id,user_id,b0')->select();
        foreach ($mrs as $vo) {
            $inUserID = $vo['user_id'];
            $ccc = $vo['b0'] * $s13;
            $kb_mon = round($ccc, 2);
            $this->query("UPDATE __TABLE__ SET `b9`=b9-" . $kb_mon . " where `id`=" . $vo['id'] . " ");
            $this->addencAdd($vo['id'], $inUserID, -$kb_mon, 9);
        }
        unset($mrs);
    }

    //扣网络税
    public function ap_wlf() {

        $fee = M('fee');
        $fee_rs = $fee->field('str2')->find();
        $str2 = $fee_rs['str2'];

        $where = array();
        $where['wlf'] = array('eq', 0);
        $where['b0'] = array('gt', 0);
        $where['is_fenh'] = array('eq', 0);
        $lirs = $this->where($where)->field('id,b0,wlf,wlf_money')->select();
        foreach ($lirs as $mrs) {
            $myid = $mrs['id'];
            $get_mon = $mrs['b0'];
            $wlf_money = $mrs['wlf_money'];
            $all_mm = $wlf_money + $get_mon;
            $k_mon = 0;
            if ($all_mm >= $str2) {
                $k_mon = $str2 - $wlf_money;
                $this->execute("UPDATE __TABLE__ SET wlf=" . mktime() . " where `id`=" . $myid . " and wlf=0");
            } else {
                $k_mon = $get_mon;
            }
            if ($k_mon < 0) {
                $k_mon = 0;
            }
            if ($k_mon > 0) {
                $this->execute("UPDATE __TABLE__ SET `b7`=b7-" . $k_mon . ",wlf_money=wlf_money+" . $k_mon . " where `id`=" . $myid);
            }
        }
        unset($fee, $str2, $lirs, $mrs);
    }

    public function add_xf($uid, $user_id, $money = 0, $gnum = 0) {

        $fenhong = M('fenhong');
        $data = array();
        $data['uid'] = $uid;
        $data['user_id'] = $user_id;
        $data['f_num'] = $gnum;
        $data['f_money'] = $money;
        $data['pdt'] = mktime();
        $fenhong->add($data);

        unset($fenhong, $data);
    }

    //日封顶
    public function ap_rifengding() {

        $fee = M('fee');
        $fee_rs = $fee->field('s5')->find();
        $s5 = explode("|", $fee_rs['s5']);

        $where = array();
        $where['b0'] = array('gt', 0);
        $mrs = $this->where($where)->field('id,b0,day_feng,u_level')->select();
        foreach ($mrs as $vo) {
            $day_feng = $vo['day_feng'];
            $ss = $vo['u_level'] - 1;
            $bbb = $vo['b0'];
            $fedd = $s5[$ss]; //封顶
            $get_money = $bbb;
            $all_money = $bbb + $day_feng;
            if ($all_money > $fedd) {
                $get_money = $fedd - $day_feng;
            }
            if ($get_money < 0) {
                $get_money = 0;
            }
            if ($get_money >= 0) {
                $this->query("UPDATE __TABLE__ SET `b0`=" . $get_money . ",day_feng=day_feng+" . $get_money . " where `id`=" . $vo['id']);
            }
        }
        unset($mrs);
    }

    //总封顶
    public function ap_zongfengding() {

        $fee = M('fee');
        $fee_rs = $fee->field('s15')->find();
        $s15 = $fee_rs['s15'];

        $where = array();
        $where['b0'] = array('gt', 0);
        $where['_string'] = 'b0+zjj>' . $s15;
        $mrs = $this->where($where)->field('id,b0,zjj')->select();
        foreach ($mrs as $vo) {
            $zjj = $vo['zjj'];
            $bbb = $vo['b0'];
            $get_money = $s15 - $zjj;

            if ($get_money > 0) {
                $this->query("UPDATE __TABLE__ SET `b0`=" . $get_money . " where `id`=" . $vo['id']);
            }
        }
        unset($mrs);
    }

    //奖金大汇总（包括扣税等）
    public function quanhuizong() {
        $this->execute('UPDATE __TABLE__ SET `b0`=b1+b2+b3+b4+b5+b6+b7+b8+b9');
        $this->execute('UPDATE __TABLE__ SET `repeat_all`=b1+b2+b3+b4+b5+b6'); //奖所以奖 集中
        $this->execute('UPDATE __TABLE__ SET `b0`=0,b1=0,b2=0,b3=0,b4=0,b5=0,b6=0,b7=0,b8=0,b9=0,b10=0 where is_fenh=1');
        $fck_rs = $this->where("b0<>0")->field("id,user_id,b0,repeat_all")->select();
        $fee = M('fee');
        $fee_rs = $fee->field('str2')->find();
        $str2 = $fee_rs['str2'] / 100;
        foreach ($fck_rs as $rs) {
            $money = $str2 * $rs['repeat_all'];
            $this->repeat($rs['id'], $rs['user_id'], $rs['repeat_all']);
            $fee->query("update __TABLE__ set zyj=zyj+{$money} where id=1");
        }
    }

    //清空时间
    public function emptyTime() {

        $nowdate = strtotime(date('Y-m-d'));

        $this->query("UPDATE `xt_fck` SET `day_feng`=0,_times=" . $nowdate . " WHERE _times !=" . $nowdate . "");
    }

    public function bobifengding() {

        $fee = M('fee');
        $bonus = M('bonus');
        $fee_rs = M('fee')->find();
        $table = $this->tablePrefix . 'fck';
        $z_money = 0; //总支出
        $z_money = $this->where('is_pay = 1')->sum('b2');
        $times = M('times');
        $trs = $times->order('id desc')->field('shangqi')->find();
        if ($trs) {
            $benqi = $trs['shangqi'];
        } else {
            $benqi = strtotime(date('Y-m-d'));
        }
        $zsr_money = 0; //总收入
        $zsr_money = $this->where('pdt>=' . $benqi . ' and is_pay=1')->sum('cpzj');
        $bl = $z_money / $zsr_money;
        $fbl = $fee_rs['s11'] / 100;
        if ($bl > $fbl) {
            //$bl = $fbl;
            //$xbl = $bl - $fbl;
            $z_o1 = $zsr_money * $fbl;
            $z_o2 = $z_o1 / $z_money;
            $this->query("UPDATE " . $table . " SET `b2`=b2*{$z_o2} where `is_pay`>=1 ");
        }
    }

    /*
      奖金开始=======================================================================
      ===============================================================================
     */

    public function clearing($type1 = 0, $type2 = 0, $type3 = 0) {
        //========================奖金结算
        $times = M('times');
        $bonus = M('bonus');
        $nowdate = strtotime(date('Y-m-d'));
        $settime_two['benqi'] = $nowdate;
        $settime_two['type'] = 0;
        $trs = $times->where($settime_two)->find();
        if (!$trs) {
            $rs3 = $times->where('type=0')->order('id desc')->find();
            if ($rs3) {
                $data['shangqi'] = $rs3['benqi'];
                $data['benqi'] = $nowdate;
                $data['is_count'] = 0;
                $data['type'] = 0;
            } else {
                $data['shangqi'] = strtotime('2010-01-01');
                $data['benqi'] = $nowdate;
                $data['is_count'] = 0;
                $data['type'] = 0;
            }
            unset($rs3);
            $times->add($data);
        } else {
            $data['shangqi'] = $trs['shangqi'];
            $data['benqi'] = $trs['benqi'];
        }
        $this->bobifengding(); //奖金汇总
        $twhere = array();
        $twhere['type'] = 0;
        $trs_two = $times->where($twhere)->order('id desc')->field('id')->find();
        $where_two = array();
        $data2 = array();
        $where_two['did'] = $trs_two['id'];
        $fwhere = array();
        $fwhere['b0'] = array('neq', 0);
        $fwhere['is_pay'] = array('gt', 0);
        $rs = $this->where('is_pay>=1 AND (b0<>0 OR b6<>0)')->field('*')->order('id asc')->select();
        foreach ($rs as $rss) {
            $where_two['uid'] = $rss['id'];
            $bonus_rs = $bonus->where($where_two)->find();
            if (!$bonus_rs) {
                $data2['e_date'] = $data['benqi'];
                $data2['s_date'] = $data['shangqi'];
                $data2['user_id'] = $rss['user_id'];
                $data2['nickname'] = $rss['nickname'];
                $data2['did'] = $trs_two['id'];
                $data2['uid'] = $rss['id'];
                $data2['b0'] = $rss['b0'];
                $data2['b1'] = $rss['b1'];
                $data2['b2'] = $rss['b2'];
                $data2['b3'] = $rss['b3'];
                $data2['b4'] = $rss['b4'];
                $data2['b5'] = $rss['b5'];
                $data2['b6'] = $rss['b6'];
                $data2['b7'] = $rss['b7'];
                $data2['b8'] = $rss['b8'];
                $bonus->add($data2);
            } else {
                $sql = "`b0`=b0+{$rss['b0']},`b1`=b1+{$rss['b1']}";
                $sql .= ",`b2`=b2+{$rss['b2']},`b3`=b3+{$rss['b3']}";
                $sql .= ",`b4`=b4+{$rss['b4']},`b5`=b5+{$rss['b5']}";
                $sql .= ",`b6`=b6+{$rss['b6']},`b7`=b7+{$rss['b7']}";
                $sql .= ",`b8`=b8+{$rss['b8']}";
                $bonus->execute("UPDATE __TABLE__ SET " . $sql . " where `id`=" . $bonus_rs['id']);
            }
            $fck_sql = "`agent_use`=agent_use+b0,`zjj`=zjj+b0";
            $fck_sql .= ",`b0`=0,`b1`=0,`b2`=0,`b3`=0,`b4`=0,`b5`=0,`b6`=0,`b7`=0,`b8`=0";
            $this->execute("UPDATE `xt_fck` SET $fck_sql where `id`=" . $rss['id']);
        }
        unset($times, $trs, $settime_two, $bonus, $twhere, $data2, $fwhere, $rs, $data);
        $this->_addBonus($trs_two['id']);
    }

    public function _addBonus($DID = 0) {
        //统计总奖金 到 xt_times_bonus 表   奖金结算完后调用
        $times_bonus = M('times_bonus');
        $fee = M('fee');
        $rs = $fee->field('b0,b1,b2,b3,b4,b5,b6,b7,b8,b9,b10')->find();
        $times = M('times');
        $bonus = M('bonus');
        $trs = $times->field('*')->order('id desc')->find();
        $data = array();
        if ($trs) {
            $b0 = 0;
            $b1 = 0;
            $b2 = 0;
            $b3 = 0;
            $b4 = 0;
            $where['did'] = $trs['id'];
            $b0 = $bonus->where($where)->sum('b0');
            $b1 = $bonus->where($where)->sum('b1');
            $b2 = $bonus->where($where)->sum('b2');
            $b3 = $bonus->where($where)->sum('b3');
            $b4 = $bonus->where($where)->sum('b4');
            $b5 = $bonus->where($where)->sum('b5');
            $b6 = $bonus->where($where)->sum('b6');
            $b7 = $bonus->where($where)->sum('b7');
            $b8 = $bonus->where($where)->sum('b8');
            //=======汇总结束============
            $s_date = 0;
            $e_date = 0;
            $s_date = $trs['shangqi'];
            $e_date = $trs['benqi'];
            $data['b0'] = $b0;
            $data['b1'] = $b1;
            $data['b2'] = $b2;
            $data['b3'] = $b3;
            $data['b4'] = $b4;
            $data['b5'] = $b5;
            $data['b6'] = $b6;
            $data['b7'] = $b7;
            $data['b8'] = $b8;
            $data['did'] = $trs['id'];
            $data['s_date'] = $s_date;
            $data['e_date'] = $e_date;
            $times_bonus_rs = $times_bonus->where("did={$DID}")->find();
            if ($times_bonus_rs) {
                $data['id'] = $times_bonus_rs['id'];
                $times_bonus->save($data);
            } else {
                $times_bonus->add($data);
            }
        }
        unset($times_bonus, $fee, $rs, $times, $bonus, $trs, $data);
    }

    /*
      奖金结束===================================================================================================================
      ===========================================================================================================================
     */
}

?>