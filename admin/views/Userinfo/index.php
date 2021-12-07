<?php
 //$loc=location::model()->findALL();
?>
<div class="box">
     <div class="box-title c"><h1><i class="fa fa-table"></i>学生信息</h1></div><!--box-title end-->
    <div class="box-content">
        <div class="box-header">
            <a class="btn" href="javascript:;" onclick="we.reload();"><i class="fa fa-refresh"></i>刷新</a>
            <a style="display:none;" id="j-delete" class="btn" href="javascript:;" onclick="we.dele(we.checkval('.check-item input:checked'), deleteUrl);"><i class="fa fa-trash-o"></i>刪除</a>
        </div><!--box-header end-->

     <form name="search" action="<?php echo Yii::app()->request->url;?>" method="get">
    <input type="hidden" name="r" value="<?php echo Yii::app()->request->getParam('r');?>">
    <label style="margin-right:10px;">
    <span>省：</span>
    <select name="province" id="province">
        <option value="">请选择</option>
        <?php foreach ($province as $v) { ?>
            <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('province') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
        <?php } ?>
    </select>
    </label>
    <label style="margin-right:10px;">
    <span>市：</span>
    <select name="city" id='city'>
        <option value="">请选择</option>
        <?php if(isset($city)) foreach ($city as $v) { ?>
            <option value="<?php echo $v->id; ?>" <?php if (Yii::app()->request->getParam('city') == $v->id) { ?> selected<?php } ?>><?php echo $v->name; ?></option>
        <?php } ?>
    </select>
    </label>
    

    <label style="margin-right:10px;">
        <span>学校：</span>
         <input style="width:200px;" class="input-text" type="text" name="keywords" value="<?php echo Yii::app()->request->getParam('keywords');?>">


    <button class="btn btn-blue" type="submit">查询</button>
    </form>
</div><!--box-search end-->

<div class="box-table">
    <table class="list">
<thead>


    <tr>
        <th class="check"><input id="j-checkall" class="input-check" type="checkbox"></th>
        <th style='text-align: center;'>编号</th>
        <th style='text-align: center;'>名称</th>
        <th style='text-align: center;'>性别</th>
        <th style='text-align: center;'>在读学历</th>
        <th style='text-align: center;'>昵称</th>
        <th style='text-align: center;'>手机号</th>
        <th style='text-align: center;'>学校名称</th>
        <th style='text-align: center;'>年级</th>
        <th style='text-align: center;'>地区</th>
        <th style='text-align: center;'>头像</th>
        <th style='text-align: center;'>注册时间</th>
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
    <td style='text-align: center;'><span class="num num-1"><?php echo $index ?></span></td>
   <td style='text-align: center;'><?php echo $v->name; ?></td>
   <td style='text-align: center;'><?php echo $v->gender; ?></td>
    <td style='text-align: center;'><?php echo $v->education; ?></td>
    <td style='text-align: center;'><?php echo $v->nikename; ?></td>
    <td style='text-align: center;'><?php echo $v->phone; ?></td>
    <td style='text-align: center;'><?php echo $v->schoolname; ?></td>
    <td style='text-align: center;'><?php echo $v->grade; ?></td>
    <td style='text-align: center;'><?php echo $v->country." ".$v->province." ".$v->city; ?></td>
    <td style='text-align: center;'><?php echo BaseLib::model()->show_pic($v->header);?></td>
    <td style='text-align: center;'><?php echo $v->registerdate; ?></td>
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
$("#province").change(function() {
        $('#city').html("<option value=''>请选择</option>");
        getLocation("#province",'#city');
        document.search.submit();
    });
$("#city").change(function() {
        document.search.submit();
    });


    function getLocation(sourece,target) {
        var code = $(sourece).val();
        getData(code,target);
    }

    function getData(code, element) {
        $.ajax({
            url: "<?php echo $this->createUrl('select/getLocation'); ?>",
            data: {
                code: code
            },
            type: "get",
            success: function(res) {
                var data = JSON.parse(res).data;
                var str = "<option value=''>请选择</option>";
                for (var i = 0; i < data.length; i++) {
                    str += "<option value='" + data[i].id + "'>" + data[i].name + "</option>";
                }
                // //把所有<option>放到区的下拉列表里
                $(element).html(str);
            }
        });
    }


</script>
