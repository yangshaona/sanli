<?php

class UserinfoController extends BaseController {

    protected $model = '';

    public function init() {
        $this->model = substr(__CLASS__, 0, -10);
        parent::init();
        //dump(Yii::app()->request->isPostRequest);
    }

    public function actionIndex($province='',$city='',$keywords="") {
    set_cookie('_currentUrl_', Yii::app()->request->url);
    $modelName = $this->model;
    $model = $modelName::model();
    $criteria = new CDbCriteria;
    /*$w1=get_where('1=1',$country,'country',$country,'"');
    $w2=get_where($w1,$province,'province',$province,'"');
    $w3=get_where($w2,$city,'city',$city,'"');*/
    $criteria->condition='1=1';
    $criteria->condition=get_like($criteria->condition,'schoolname',$keywords,'');
    $data = array();

    //$criteria->join = 'left join location l1 on t.province=l1.id';
    //$criteria->join = 'left join location l2 on t.city=l2.id';

        if ($province != '') {
            $p=location::model()->find('id='.$province)->name;
            $criteria->condition=get_where('1=1',$p,'province',$p,'"');
            $data['city'] = Location::model()->findAll('pid=' . $province);
        }
        if ($city != '') {
            $c=location::model()->find('id='.$city)->name;
            $criteria->condition=get_where($criteria->condition,$c,'city',$c,'"');
        }
       
        $data['province'] = Location::model()->findAll('pid=0');
    parent::_list($model, $criteria, 'index', $data,20);
    }


   public function actionCreate() {
        $modelName = $this->model;
        $model = new $modelName('create');
        $data = array();
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

}

