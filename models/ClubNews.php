<?php

class ClubNews extends BaseModel {
    public $news_content_temp = '';
    public function tableName() {
        return '{{course}}';
    }

    /**
     * 模型驗證規則
     */
    public function rules() {
        return array(
          array('f_year', 'required', 'message' => '{attribute} 不能为空'),
          array('f_term', 'required', 'message' => '{attribute} 不能为空'),
          array('name', 'required', 'message' => '{attribute} 不能为空'),
          //array('content', 'required', 'message' => '{attribute} 不能为空'),
          array('starttime', 'required', 'message' => '{attribute} 不能为空'),
          array('endtime', 'required', 'message' => '{attribute} 不能为空'),
          array('registrationstartdate', 'required', 'message' => '{attribute} 不能为空'),
          array('registrationenddate', 'required', 'message' => '{attribute} 不能为空'),
          array('cost', 'required', 'message' => '{attribute} 不能为空'),
          //array('club_id', 'required', 'message' => '{attribute} 不能為空'),
          //array('news_club_name', 'required', 'message' => '{attribute} 不能為空'),
          array('id,name,introduce,content,starttime,endtime,cost,club_id,news_club_name,imagesurl,typeid,type,registrationstartdate,registrationenddate,status,duration,f_year,f_term,reasons_for_failure','safe'),

            array($this->safeField(),'safe'),
           // array('f_year,f_term,news_title,news_content_temp','safe'),
        );
    }

    /**
     *    array('f_year,f_term,news_code,news_title,news_pic,news_content,club_id,news_introduction,news_date_start,news_date_end,state,reasons_for_failure,
            news_address,latitude,Longitude,
                ','safe'),
     * 模型關聯規則
     */
    public function relations() {
        return array(
           // 'club_list' => array(self::BELONGS_TO, 'ClubList', 'club_id'),
        );
    }

    /**
     * 屬性標簽
     */
    public function attributeLabels() {
        return array(
            'id'=>'ID',
            'name'=>'课程名字',
            'introduce'=>'简要介绍',
            'content'=>'详细介绍',
            'news_content_temp' => '信息內容',

            'starttime'=>'课程开始时间',
            'endtime'=>'课程结束时间',
            'cost'=>'报名费用',
            'imagesurl'=>'缩略图',
            'typeid'=>'类型id',
            'type'=>'类型',
            'registrationstartdate'=>'报名开始时间',
            'registrationenddate'=>'报名结束时间',
            'status'=>'状态',
            'duration'=>'持续时间',
            'f_year'=>'学年',
            'f_term'=>'学期',
            'reasons_for_failure'=>'驳回说明',
            'club_id'=>'机构',
            'news_club_name'=>'社区信息',
            'uDate'=>'更新时间',
            'sign_max'  =>  '最多人数',
            'sign_num' =>  '报名人数',
            'sign_date_start' => '活动开始日期',
            'sign_date_end'  =>  '活动报名结束',
            'news_address' => '活动地址',
        );
    }
    public function WxMap() {
        return array(
            'id'=>'id',
            'name'=>'title',
            'introduce'=>'introduction',
            'content'=>'text',
            'news_content_temp' => 'text1',
            'starttime'=>'signIn_date_start',
            'endtime'=>'signIn_date_end',
            'cost'=>'price',
            'imagesurl'=>'pic',
            'typeid'=>'type_id',
            'type'=>'type',
            'registrationstartdate'=>'sign_date_start',
            'registrationenddate'=>'sign_date_end',
            'status'=>'status',
            'duration'=>'activity_days',
            'f_year'=>'year',
            'f_term'=>'term',
            'reasons_for_failure'=>'reasons_for_failure',
            'club_id'=>'club_id',
            'news_club_name'=>'news_club_name',
            'course_eval'=>'course_eval',
            'apply_obj'=>'apply_obj',
            'buy_info'=>'buy_info',
            'trip_arrange'=>'trip_arrange',
            'course_eval_num'=>'course_eval_num',
            'uDate'=>'uDate',
            'sign_max'  =>  'sign_max',
            'sign_num' =>  'sign_num',
            'news_address' => 'news_address',


//            'news_code'=>'code',
//            'news_pic'=>'pic',
//            'news_type'=>'type',
//            'news_type_name'=>'type_name',
//            'news_clicked'=>'news_clicked',
//            'collection_num'=>'collection_num',
//            'version'=>'version',
//            'order_num'=>'order_num',
//            'news_date_start'=>'news_date_start',
//            'news_date_end'=>'news_date_end',
//            'state_qmddid'=>'state_qmddid',
//            'state_time'=>'state_time',
//            'if_del'=>'if_del',
//            'club_list'=>'club_list',
//            'latitude' => 'latitude',
//            'Longitude' => 'longitude',
//            'sign_dist'  =>  'sign_dist',


        );
    }

    public function WxField($s='') {
        $dm=$this->WxMap();
        $s1='';$b1='';
        foreach($dm as $k=>$v)
        {
            $s1.=$b1.$k.":".$v;
            $b1=',';
        }
        return $s1;
    }

    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function afterFind() {
        parent::afterFind();
        $this->news_content_temp = $this->content;
        return true;
    } 

    protected function beforeSave() {
        parent::beforeSave();
         $status=$_POST['submitType'];
         if($status=='shenhe')
         {
            $this->status=1;
         }
         else if($status=='queren')
         {
            
         }
         else
         {
            $this->status=0;
         }
        // 圖文描述處理
        return true;
    }

    public function picLabels() {
        return 'imagesurl';
    }
}
