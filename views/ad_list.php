
<h3 class="page-header">广告列表 
<a href="<?= URL::site('ad/add');?>" class="ajax-click">+</a>
</h3>

<form class="form-inline ajax-submit" method="get">
    <div class="form-group">
        <select class="form-control" name="type">
    	    <?php foreach ($types as $key=>$type):?>
			<option value="<?= $key?>" <?php if(Arr::get($_GET, 'type')==$key):?>selected<?php endif;?>><?= $type?></option>
            <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="plat">
			<option value="">选择平台</option>
    	    <?php foreach ($plats as $plat):?>
			<option value="<?= $plat?>" <?php if(Arr::get($_GET, 'plat')==$plat):?>selected<?php endif;?>><?= $plat?></option>
            <?php endforeach;?>
        </select>
    </div>
    <!-- 
    <div class="form-group">
        <select class="form-control" name="city">
			<option value="">选择城市</option>
    	    <?php foreach ($cities as $city_id => $city_name):?>
			<option value="<?= $city_id?>" <?php if(Arr::get($_GET, 'city')==$city_id):?>selected<?php endif;?>><?= $city_name?></option>
            <?php endforeach;?>
        </select>
    </div> -->
    <div class="form-group">
        <button class="btn btn-info" type="submit">查找</button>
    </div>
</form>
<br>

<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
<tr>
	<th>广告位</th>
	<th>标题</th>
	<th>排序</th>
	<th>平台</th>
	<th>城市</th>
	<th width="150">操作</th>
</tr>
</thead>
<tbody id="cat-list">
<?php foreach($list as $item): ?>
<?php $plat_arr = explode('|', trim($item['plat'], '|'))?>
<?php 
$city_arr = empty($item['city']) ? array() : explode('|', trim($item['city'], '|'));
$city_arr2 = array();
foreach ($city_arr as $city_id) {
    $city_arr2[] = $cities[$city_id];
}
?>
<tr>
	<td><?= isset($types[$item['type']]) ? $types[$item['type']] : '' ?></td>
	<td>
	<?php $link_url = !empty($item['link_url']) ? $item['link_url'] : '#'?>
	<a href="<?= $link_url?>" target="_blank">
	    <?php if(!empty($item['title'])):?>
	        <?= $item['title'] ?><br>
	    <?php endif;?>
	    <?php if(!empty($item['pic_url'])):?>
	        <img width="100" src="<?= $item['pic_url'] ?>">
	    <?php endif;?>
	</a>
	</td>
	<td><?= $item['order'] ?></td>
	<td><?= implode(', ', $plat_arr) ?></td>
	<td><?= implode(', ', $city_arr2) ?></td>
	<td>
	    <a href="<?= URL::site('ad/edit?id='.$item['id']);?>" class="btn btn-info btn-xs ajax-click">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a href="<?= URL::site('ad/del?id='.$item['id']);?>" class="btn btn-info btn-xs ajax-update">删除</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
