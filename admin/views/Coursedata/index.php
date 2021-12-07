<?php
 //$cw=coursework::model()->findALL();
 $terms=base_term::model()->findALL();
 $years=base_year::model()->findALL();
 $course_name=ClubNews::model()->findALL();
?>
<div class="box">
     <div class="box-title c"><h1><i class="fa fa-table"></i>课程作业信息列表</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="<?php echo $this->createUrl('create');?>"><i class="fa fa-plus"></i>添加</a>
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item input:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>刪除</a>
        </div><!--box-header end-->

        <form action="<?php echo Yii::app()->request->url;?>" method="get">


     <?php $_SESSION["workyear"]=$model->workyear;
     $_SESSION["workterm"]=$model->workterm;
     /*$_SESSION["workcourse"]=$model->workcourse;*/
     /*$_SESSION["workteacher"]=$model->workteacher;*/
     $_SESSION["course_name"]=$model->course_name;?>  <!-- 储存session，供create页面使用 -->
     </form>

</div><!--box-search end-->

<div class="box-table">
    <table class="list">
<thead>

    <tr>
        <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>    
        <th style='text-align: center;'>日程天数</th>
        <th style='text-align: center;'>日程名称</th>
        <th style='text-align: center;'>开始时间</th>
        <th style='text-align: center;'>结束时间</th>
        <th style='text-align: center;'>地址</th>
        <th style='text-align: center;'>操作</th>
    </tr>
</thead>
        <tbody>

<?php 
$index = 1;
foreach($arclist as $v){ 
?>
<tr>
    <td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>"></td>
   <td style='text-align: center;'><?php echo $v->day; ?></td>
   <td style='text-align: center;'><?php echo $v->name; ?></td>
   <td style='text-align: center;'><?php echo $v->start_time; ?></td>
   <td style='text-align: center;'><?php echo $v->end_time; ?></td>
   <td style='text-align: center;'><?php echo $v->location; ?></td>
    <td style='text-align: center;'>
     
        <a class="btn" href="<?php echo $this->createUrl('update', array('id'=>$v->id,));?>" title="编辑"><i class="fa fa-edit"></i></a>
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

</script>
