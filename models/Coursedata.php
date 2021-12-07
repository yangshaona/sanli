<?php

class Coursedata extends BaseModel {
    public $news_content_temp = '';
    public function tableName() {
        return '{{course_data}}';
    }

    /**
     * 模型驗證規則
     */
    public function rules() {
        return array(
          array('day', 'required', 'message' => '{attribute} 不能為空'),
          array('name', 'required', 'message' => '{attribute} 不能為空'),
          array('start_time', 'required', 'message' => '{attribute} 不能為空'),
          array('end_time', 'required', 'message' => '{attribute} 不能為空'),
          array('location', 'required', 'message' => '{attribute} 不能為空'),
          array('content', 'required', 'message' => '{attribute} 不能為空'),
          array('work', 'required', 'message' => '{attribute} 不能為空'),
          array('course_name', 'required', 'message' => '{attribute} 不能為空'),
          array('workyear', 'required', 'message' => '{attribute} 不能為空'),
         array('workterm', 'required', 'message' => '{attribute} 不能為空'),
          array('day,name,start_time,end_time,location,content,work,course_name,workyear,workterm','safe'),

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
        'name'=>'日程名称',
        'day'=>'日程天数',
        'start_time'=>'开始时间',
        'end_time'=>'结束时间',
        'location'=>'地址',
        'content'=>'日程内容',
        'work'=>'作业内容',
        'course_name'=>'课程名称',
        'workyear'=>'学年',
        'workterm'=>'学期',
        );
    }

    /**
     * Returns the static model of the specified AR class.
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    protected function afterFind() {
        parent::afterFind();
        return true;
    } 


}
