<div class="box">
    <div class="box-title c">
    <h1><i class="fa fa-table"></i>日程信息详情</h1><span class="back">
    <a class="btn" href="javascript:;" onclick="we.back();">
    <i class="fa fa-reply"></i>返回</a></span></div><!--box-title end-->
    <div class="box-detail">
     <?php  $form = $this->beginWidget('CActiveForm', get_form_list()); ?>
        <div class="box-detail-bd">
            <div style="display:block;" class="box-detail-tab-item">
                <table class="mt15">
                    <tr>
                        <td ><?php echo $form->labelEx($model, 'course_name'); ?></td>
                        <td >
                            <?php echo $form->textField($model, 'course_name', array('class'=>'input-text','value'=>$_SESSION["course_name"],'readonly'=>true)); ?>      
                            <?php echo $form->error($model, 'course_name', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td ><?php echo $form->labelEx($model, 'workyear'); ?></td>
                        <td >
                            <?php echo $form->textField($model, 'workyear', array('class'=>'input-text','value'=>$_SESSION["workyear"],'readonly'=>true)); ?>      
                            <?php echo $form->error($model, 'workyear', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td ><?php echo $form->labelEx($model, 'workterm'); ?></td>
                        <td >
                            <?php echo $form->textField($model, 'workterm', array('class'=>'input-text','value'=>$_SESSION["workterm"],'readonly'=>true)); ?>      
                            <?php echo $form->error($model, 'workterm', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                     <tr>
                        <td><?php echo $form->labelEx($model, 'day'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'day', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'day', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                   <tr>
                        <td ><?php echo $form->labelEx($model, 'name'); ?></td>
                        <td >
                            <?php echo $form->textField($model, 'name', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'name', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $form->labelEx($model, 'start_time'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'start_time', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'start_time', $htmlOptions = array()); ?>
                        </td>
                         </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'end_time'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'end_time', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'end_time', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'location'); ?></td>
                        <td>
                            <?php echo $form->textField($model, 'location', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'location', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'content'); ?></td>
                        <td>
                            <?php echo $form->textArea($model, 'content', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'content', $htmlOptions = array()); ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo $form->labelEx($model, 'work'); ?></td>
                        <td>
                            <?php echo $form->textArea($model, 'work', array('class' => 'input-text')); ?>
                            <?php echo $form->error($model, 'work', $htmlOptions = array()); ?>
                        </td>
                    </tr>

                </table>
        </div>
        <div class="box-detail-submit">
          <button onclick="submitType='baocun'" class="btn btn-blue" type="submit">保存</button>
          <button class="btn" type="button" onclick="we.back();">取消</button>
         </div>
         
    
            <?php $this->endWidget();?>
  </div><!--box-detail end-->
</div><!--box end-->
 
  <script>
we.tab('.box-detail-tab li','.box-detail-tab-item');
$('#Coursedata_start_time').on('click', function(){
WdatePicker({startDate:'00:00:00',dateFmt:'HH:mm:ss'});});

$('#Coursedata_end_time').on('click', function(){
WdatePicker({startDate:' 00:00:00',dateFmt:' HH:mm:ss'});});

</script> 

 