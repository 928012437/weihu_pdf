<?php

defined('IN_IA') or exit('Access Denied');

class Weihu_pdfModuleSite extends WeModuleSite {

    public function doWeblist()
    {
        global $_W, $_GPC;

        $uniacid=$_W['uniacid'];

        if(!empty($_GPC['del'])){
            pdo_delete('weihu_pdf_list',array('id'=>$_GPC['id']));
            message('删除成功',$this->createWebUrl('list'),'success');die;
        }

        if($_W['ispost']&&empty($_GPC['search'])){

            $pdfurl=$_GPC['pdfurl'];

            if(!empty($_FILES["pdffile"]["tmp_name"])){
                $time=time();
                $sjtext1=rand(10,99);
                move_uploaded_file($_FILES["pdffile"]["tmp_name"],dirname(__FILE__)."/pdffile/if1" . $sjtext1.$time .'.pdf');
                $pdfurl=$_W['siteroot'].'addons/weihu_pdf/pdffile/if1'. $sjtext1.$time .'.pdf';
            }

            $data=array(
                'uniacid'=>$uniacid,
                'xmname'=>$_GPC['xmname'],
                'name'=>$_GPC['name'],
                'mobile'=>$_GPC['mobile'],
                'sex'=>$_GPC['sex'],
                'age'=>$_GPC['age'],
                'idcard'=>$_GPC['idcard'],
                'pdfurl'=>$pdfurl,
            );
            if(empty($_GPC['id'])){
                pdo_insert('weihu_pdf_list',$data);
            }else{
                pdo_update('weihu_pdf_list',$data,array('id'=>$_GPC['id']));
            }
            message('操作成功',$this->createWebUrl('list'),'success');
        }

        $where='';

        if(!empty($_GPC['keyword'])){
            $where.=" and (name like '%{$_GPC['keyword']}%' or mobile like '%{$_GPC['keyword']}%' or age like '%{$_GPC['keyword']}%')";
        }

        if(!empty($_GPC['sex_s'])){
            $where.=" and sex=".($_GPC['sex_s']-1);
        }

        $list=pdo_fetchall("select * from ".tablename('weihu_pdf_list')." where uniacid=:uniacid $where ",array(':uniacid'=>$uniacid));

        include $this->template('pdflist');
    }

    public function doWebset()
    {
        global $_W, $_GPC;

        $uniacid = $_W['uniacid'];
        $set=pdo_get('weihu_pdf_set',array('uniacid'=>$uniacid));

        if($_W['ispost']){
            $data=array(
                'uniacid'=>$uniacid,
                'check1'=>$_GPC['check1'],
                'check2'=>$_GPC['check2'],
                'check3'=>$_GPC['check3'],
            );

            if(empty($set)){
                pdo_insert('weihu_pdf_set',$data);
            }else{
                pdo_update('weihu_pdf_set',$data,array('id'=>$set['id']));
            }
            message('操作成功',$this->createWebUrl('set'),'success');
        }

        include $this->template('set');
    }

    public function doMobileindex() {
        global $_W,$_GPC;
        $uniacid=$_W['uniacid'];
        $set=pdo_get('weihu_pdf_set',array('uniacid'=>$uniacid));

        if(empty($_GPC['mobile'])&&empty($_GPC['name'])&&empty($_GPC['idcard'])){

            include $this->template('search');
        }else{
            if(empty($_GPC['name'])){
                message('姓名未填写');
            }
            if(empty($_GPC['mobile'])&&empty($_GPC['idcard'])){
                message('温馨提示：<br/>手机号与身份证号至少填写一个');
            }
            $where='';

            if($set['check1']==1&&!empty($_GPC['name'])){
                $where.=" and name='".$_GPC['name']."' ";
            }
            if($set['check2']==1&&!empty($_GPC['mobile'])){
                $where.=" and mobile='".$_GPC['mobile']."' ";
            }
            if($set['check3']==1&&!empty($_GPC['idcard'])){
                $where.=" and idcard='".$_GPC['idcard']."' ";
            }

            $pdflist=pdo_fetchall("select * from ".tablename('weihu_pdf_list')." where uniacid=:uniacid  $where",array(':uniacid'=>$uniacid));

            if(empty($pdflist)){
                message('未查找到记录！');
            }

            include $this->template('index');
        }

    }

    public function doMobiledetail() {
        global $_W,$_GPC;

        $pdf=pdo_get('weihu_pdf_list',array('id'=>$_GPC['id']));

        include $this->template('detail');
    }

}