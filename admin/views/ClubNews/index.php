<?php if (!isset($_REQUEST['news_type'])) {$_REQUEST['news_type']=0;} ?>
<?php
 $years=base_year::model()->findALL();
 $terms=base_term::model()->findALL();
?>
<div class="box">
     <div class="box-title c"><h1><i class="fa fa-table"></i>课程列表</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="<?php echo $this->createUrl('create');?>"><i class="fa fa-plus"></i>添加</a>
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item input:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>刪除</a>
        </div><!--box-header end-->

     <form action="<?php echo Yii::app()->request->url;?>" method="get">
    <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
    <input type="hidden" name="news_type" id="news_type" value="<?php echo $_REQUEST['news_type'];?>">

    <label style="margin-right:20px;">
        <span>学年</span>
        <select name="styear">
            <?php foreach($years as $v){?>
            <option value="<?php echo $v->F_NAME;?>"><?php echo $v->F_view;?></option>
            <?php }?>
        </select>
    </label>

    <label style="margin-right:20px;">
        <span>学期</span>
        <select name="sterm">
            <option value="">全选</option>
            <option value="上学期">上学期</option>
            <option value="下学期">下学期</option>
        </select>
    </label>

     
        <button class="btn btn-blue" type="submit">查询</button>
    </form>
</div><!--box-search end-->

<div class="box-table">
    <table class="list">
<thead>

    <tr>
        <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>
        <th style='text-align: center;'>编号</th>
        <th style='text-align: center;'>活动名称</th>
        <th style='text-align: center;'>类型</th>
        <th style='text-align: center;'>简要介绍</th>
        <th style='text-align: center;'>课程开始时间</th>
        <th style='text-align: center;'>课程结束时间</th>
        <th style='text-align: center;'>报名开始时间</th>
        <th style='text-align: center;'>报名结束时间</th>
        <th style='text-align: center;'>缩略图</th>
        <th style='text-align: center;'>状态</th>
        <th style='text-align: center;'>日程设置</th>
        <th style='text-align: center;'>操作</th>
    </tr>
</thead>
<tbody>

<?php /*status:0保存 1提交审核 2驳回 3通过
        news_type 0登记 1审核 2通过名单 3即将开始 4正在开始 5结束*/
$index = 1;
foreach($arclist as $v){ 
    date_default_timezone_set("PRC");
    switch($_REQUEST['news_type'])
    {
        case 0:if($v->status==1 || $v->status==3) continue 2;break;
        case 1:if($v->status!=1) continue 2;break;
        case 2:if($v->status!=3) continue 2;break;
        case 3:if(($v->status!=3) || (date("Y-m-d h:i:s")>=($v->starttime))) continue 2;break;
        case 4:if(($v->status!=3) || (date("Y-m-d H:i:s")<($v->starttime)) || (date("Y-m-d H:i:s")>($v->endtime))) continue 2;break;
        case 5:if(($v->status!=3) ||  (date("Y-m-d H:i:s")<=($v->endtime))) continue 2;break;
        default:
    }
?>
<tr>
    <td class="check check-item"><input class="input-check" type="checkbox" value="<?php echo CHtml::encode($v->id); ?>"></td>
    <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->name; ?></td>
   <td style='text-align: center;'><?php echo $v->type; ?></td>
    <td style='text-align: center;'><?php echo $v->introduce; ?></td>
    <td style='text-align: center;'><?php echo $v->starttime; ?></td>
    <td style='text-align: center;'><?php echo $v->endtime; ?></td>
    <td style='text-align: center;'><?php echo $v->registrationstartdate; ?></td>
    <td style='text-align: center;'><?php echo $v->registrationenddate; ?></td>
    <td style='text-align: center;'><?php echo BaseLib::model()->show_pic($v->imagesurl);?></td>
    <td style='text-align: center;'><?php switch($v->status){
                                                                case 0:echo "保存";
                                                                    break;
                                                                case 1:echo "提交审核";
                                                                    break;
                                                                case 2:echo "驳回";
                                                                    break;
                                                                case 3:echo "审核通过";
                                                                    break;
                                                                default:
                                                                    echo "";
                                                            }
     ?></td>
    <td style='text-align: center;'>
        <a class="btn btn-blue" href="<?php echo $this->createUrl('Coursedata/index', array('id'=>$v->id,));?>" title="日程编辑"><i class="fa fa-table "> 日程查看</i></a>
    </td>
    <td style='text-align: center;'>
     
        <a class="btn" href="<?php echo $this->createUrl('update', array('id'=>$v->id,'news_type'=>Yii::app()->request->getParam('news_type')));?>" title="编辑"><i class="fa fa-edit"></i></a>
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
