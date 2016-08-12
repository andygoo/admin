
<form action="" method="post" class="form-horizontal ajax-submit">

	<div class="form-group">
		<label class="col-sm-1 control-label">广告位</label>
		<div class="col-sm-3">
            <select class="form-control" name="type">
    			<option value=""> - 选择广告位 - </option>
        	    <?php foreach ($types as $key=>$type):?>
    			<option value="<?= $key?>" <?php if($info['type']==$key || Arr::get($_GET, 'type')==$key):?>selected<?php endif;?>><?= $type?></option>
                <?php endforeach;?>
            </select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">图片</label>
		<div class="col-sm-6">
		    <input type="url" class="form-control" name="pic_url" value="<?= $info['pic_url'] ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">标题</label>
		<div class="col-sm-6">
		    <input type="text" class="form-control" name="title" value="<?= $info['title'] ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">链接</label>
		<div class="col-sm-6">
		    <input type="url" class="form-control" name="link_url" value="<?= $info['link_url'] ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">平台</label>
		<div class="col-sm-6">
		    <?php $plat_arr = explode('|', trim($info['plat'], '|'))?>
    	    <?php foreach ($plats as $item):?>
            <label class="checkbox-inline">
                <input type="checkbox" name="plat[]" value="<?= $item?>" <?php if (in_array($item, $plat_arr)):?>checked<?php endif;?>> <?= $item?>
            </label>
            <?php endforeach;?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">城市</label>
		<div class="col-sm-6">
            <label class="checkbox-inline">
                <input type="checkbox" name="city_all" value=""> 全部
            </label>
		    <?php $city_arr = explode('|', trim($info['city'], '|'))?>
    	    <?php foreach ($cities as $city_id => $city_name):?>
            <label class="checkbox-inline">
                <input type="checkbox" name="city[]" value="<?= $city_id?>" <?php if (in_array($city_id, $city_arr)):?>checked<?php endif;?>> <?= $city_name?>
            </label>
            <?php endforeach;?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-3">
		    <button type="submit" class="btn btn-info">提交</button>
		</div>
	</div>
</form>

<script>
$(function() {
	$('input[name=city_all]').change(function() {
	    var t = $(this);
	    var checked = t.prop('checked');
	    $("input[name='city[]'").prop('checked', checked);
	});
});
</script>
