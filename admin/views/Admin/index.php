<div class="box">
    <div class="box-title c"><h1><i class="fa fa-table"></i>管理员信息列表</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a class="btn" href="<?php echo $this->createUrl('create');?>"><i class="fa fa-plus"></i>添加管理员用户</a>
        </div><!--box-header end-->
 
        <div class="box-table">
            <table class="list">
                <thead>
                    <tr>
                        <th style='text-align: center;'>序号</th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('account');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('password');?></th>
                        <th style='text-align: center;'><?php echo $model->getAttributeLabel('name');?></th>
                        <th style='text-align: center;'>操作</th>
                    </tr>
                </thead>
                <tbody>
<?php 
$index = 1;
foreach($arclist as $v){ 
?>
                    <tr>
                        <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
                        <td style='text-align:left;'><?php echo $v->account; ?></td>
                        <td style='text-align: center;'><?php echo $v->password; ?></td>
                        <td style='text-align: center;'><?php echo $v->name; ?></td>

 
                        <td style='text-align: center;'>
                            <a class="btn" href="<?php echo $this->createUrl('update', array('id'=>$v->id));?>" title="查看"><i class="fa fa-edit"></i></a>

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
var deleteUrl = '<?php echo $this->createUrl('delete', array('id'=>'ID')); ?>';
</script>