<?php


class WxCourseController extends BaseController
{

    //输出JSON数据   第一个数组用于附加res.data 第二个数组附加res.data.data
    public function DataToWx($tmp,$s,$msg,$arr=array(),$arr2=array()){
        $data = toIoArray($tmp,$s,$arr2);
        put_msg($data);
        $total=is_array($tmp)?count($tmp):1;
        $rs=array('data'=>$data,'total'=>$total,'code'=>'200','msg'=>$msg,'time' => time());
        $rs=array_merge($rs,$arr);
        put_msg($rs);
        echo CJSON::encode($rs);
    }

    public function actionTest(){
//        $s = ClubNews::model()->safeField();
        $s = ClubNews::model()->WxField();
        $modelName = "ClubNews";
        $model = $modelName::model();
//        echo CJSON::encode($model);
        $data = array();
        $data=ClubNews::model()->findAll();
//        echo CJSON::encode($data);

        foreach ($data as $item){

//            echo CJSON::encode($item['id']);
            $time = strtotime($item['sign_date_end'])-strtotime($item['sign_date_start']);
            $day = (int)($time/(3600*24));
            echo CJSON::encode($day);
            $item['activity_days']=$day;
            $model->save();
            echo '<br>';
        }


        echo "今天:",date("Y-m-d",time()),"\n";
    }
    //列表搜索
    public function actionGetList($s='id',$w1='1'){
        $limit=DecodeAsk('limit','10');
        $offset=DecodeAsk('offset','0');
        $order_by=DecodeAsk('order','id');
        $order_rule=DecodeAsk('order_rule','ASC');
        $key=DecodeAsk('keywords','');
        $key=(!$key)?' ':" and news_title like '%".$key."%' ";
        $tmp =ClubNews::model()->findAll($w1.$key.' order by '.$order_by.' '.$order_rule.' limit '.$offset.','.$limit);
        $this->DataToWX($tmp,$s,'获取列表信息成功',array('isHideLoadMore'=>count($tmp)==$limit?false:true),array());
    }

    public function actionGetHotList(){
        $s = ClubNews::model()->WxField();
        $this->actionGetList($s);
    }

    public function actionGetHistoryList(){
        $s = ClubNews::model()->WxField();
        $this->actionGetList($s);
    }



    //详情
    public function actionGetDetail(){
        $id=DecodeAsk('id',0);
        $tmp = ClubNews::model()->findAll('id='.$id);
        $s = ClubNews::model()->WxField();
        put_msg($s);
        $tmp[0]->content = str_replace('<img src="','<img src="'.BasePath::model()->getParentPath(), $tmp[0]->content);
        $this->DataToWx($tmp,$s,'获取详情信息成功');
    }

    //基本信息



}