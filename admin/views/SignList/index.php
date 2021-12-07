<div class="box">
     <div class="box-title c"><h1><i class="fa fa-table"></i>用户信息</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item input:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>刪除</a>
        </div><!--box-header end-->


    <div class="box-search">
        <form action="<?php echo Yii::app()->request->url;?>" method="get">
            <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
            <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id'];?>">                
            <span>课程名称</span>
            <input style="width:200px;" class="input-text" id="course_name" type="text" readonly='ture'>
            <input type="hidden" style="width:200px;" id="course_id" class="input-text" type="text" name="courseid">

                <input id="course_select_btn" class="btn" type="button" value="选择">
                <button class="btn btn-blue" type="submit">查询</button>
            </form>

               <!--  <td><//?php echo $form->labelEx($model, 'courseid'); ?></td>
                    <td>
                     <//?php echo $form->textField($model, 'courseid', array('class' => 'input-text-add','readonly'=>'ture')); ?>
                        <input id="club_select_btn" class="btn" type="button" value="选择">
                        <//?php echo $form->error($model, 'courseid', $htmlOptions = array()); ?>
                    </td> -->
</div><!--box-search end-->

<div class="box-table">
    <table class="list">
<thead>

    <tr>
        <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>
        <th style='text-align: center;'>编号</th>
        <th style='text-align: center;'>用户id</th>
        <th style='text-align: center;'>报名课程</th>
        <th style='text-align: center;'>报名时间</th>
        <th style='text-align: center;'>状态</th>
        <th style='text-align: center;'>操作</th>
    </tr>
</thead>
        <tbody>

<?php 
$index = 1;
foreach($arclist as $v){
    switch($_REQUEST['id'])
        {
            case 0:if($v->status!=0) continue 2;break;
            case 1:if($v->status!=1) continue 2;break;
            case 2:if($v->status!=2) continue 2;break;
            default:
        } 
?>
<tr>
    <td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>"></td>
    <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->userid; ?></td>
   <td style='text-align: center;'><?php echo ClubNews::model()->find("id=".$v->courseid)->name; ?></td>
    <td style='text-align: center;'><?php echo $v->registrationtime; ?></td>
    <td style='text-align: center;'><?php echo $v->status==0?'<span style="color: red">'."报名不成功</span>":($v->status==1?"报名成功未付款":($v->status==2?'<span style="color: lightseagreen">'."报名成功并付款</span>":"")); ?></td>
    <td style='text-align: center;'>
    <a class="btn" href="javascript:;" onclick="we.dele('<?php echo $v->id;?>', deleteUrl);" title="删除"><i class="fa fa-trash-o"></i></a>
    </td>
</tr>
<?php $index++; } ?>
                </tbody>
            </table>
        </div><!--box-table end-->
        <div class="box-page c"><?php $this->page($pages);?></div>
        
    </div><!--box-content end-->
</div><!--box end-->

<script>
var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID'));?>';
$('#course_select_btn').on('click', function(){ read_course(); });
    
 function read_course(){
        $.dialog.data('id', 0);
        //console.log($.dialog.data('id'));
        $.dialog.open('<?php echo $this->createUrl("select/course");?>',{
            id:'course',lock:true,opacity:0.3,width:'500px',height:'60%',
            title:'选择课程',
            close: function () {
                //console.log($.dialog.data('id'));
            if($.dialog.data('id')>0){
               $('#course_name').val($.dialog.data('name'));
               $('#course_id').val($.dialog.data('id'));
            }
        }
    });    
  }
</script>

