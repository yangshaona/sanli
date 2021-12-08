<?php

class ClubNewsController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    public function actionIndex($styear="",$sterm="") {
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $modelName = $this->model;
    $model = $modelName::model();
    $criteria = new CDbCriteria;
    $w1=get_where('1=1',$styear,'f_year',$styear,'"');
    $criteria->condition=get_where($w1,$sterm,'f_term',$sterm,'"');
    $criteria->order = 'registrationstartdate desc';
    $data = array();
    parent::_list($model, $criteria, 'index', $data,20);
    }

   public function actionCreate() {
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
        if(Yii::app()->request->isPostRequest && isset($_POST[$modelName]))
        {
            $temp=$_POST[$modelName];
            $model->content=$temp["news_content_temp"];
        }
        parent::_create($model, 'update', $data, get_cookie('_currentUrl_'));
    }

    public function actionUpdate($id) {
        $modelName = $this->model;
        $model = $this->loadModel($id, $modelName);
        if (!Yii::app()->request->isPostRequest) {
           $data = array();
           $data['model'] = $model;
           $this->render('update', $data);
        } else {
            $temp=$_POST[$modelName];
           $this-> saveData($model,$temp);
        }
    }


    public function actionDelete($id) {
        parent::_clear($id);
    }
    
    function saveData($model,$post) {
          $model->attributes =$post;
           $model->content=$post["news_content_temp"];
           $temp=ClubList::model()->find("id=".$model->club_id);
           if($temp)
            $model->news_club_name=$temp->club_name;
           show_status($model->save(),'保存成功', get_cookie('_currentUrl_'),'保存失败');  
           
     }

     private function DeleteImage($id)
    {
        $imagePath=ROOT_PATH.'/uploads/image/column/';
        $array = explode(",", $id);
        foreach ($array as $v) {
          $model=NewsColumn::model()->find('id='.$v); 
          if($model->image!=''&&file_exists($imagePath.$model->image))
          {
            unlink($imagePath.$model->image);
          }
        }
        
    }


    //获取活动相关信息
    public function actionGetClubNews(){
        $news_code=DecodeAsk('news_code','测试');
        put_msg($news_code);
        $news_title=DecodeAsk('news_title','测试');
        $s = ClubNews::model()->safeField();
        $tmp =ClubNews::model()->findAll('id<=50');
//        $s="news_code,news_title,news_introduction,news_type,news_address,sign_date_start,sign_date_end,sign_num,signIn_date_start,signIn_date_end,news_address";
        $this->DataToWX($tmp,$s,'获取成功');
    }

    //输出JSON数据   第一个数组用于附加res.data 第二个数组附加res.data.data
    public function DataToWx($tmp,$s,$msg,$arr=array(),$arr2=array()){
        $data = toIoArray($tmp,$s,$arr2);
        $total=is_array($tmp)?count($tmp):1;
        $rs=array('data'=>$data,'total'=>$total,'code'=>'200','msg'=>$msg,'time' => time());
        $rs=array_merge($rs,$arr);
        echo json_encode($rs);
    }


}

