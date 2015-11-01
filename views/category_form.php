<?php 

function option($items, $parent_id, $cat_id, $level=0) {
    foreach ($items as $item) {
        if ($item['id']==$cat_id) continue;
        
        $selected = ($item['id']==$parent_id) ? 'selected' : '';
        echo '<option value="'.$item['id'].'" '.$selected.'>';
        echo str_repeat('├─', $level).$item['name'];
        if (isset($item['children']) && is_array($item['children'])) {
            option($item['children'], $parent_id, $cat_id, $level+1);
        }
        echo '</option>';
    }
}
?>

<form action="" method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-1 control-label">上级</label>
		<div class="col-sm-3">
			<select class="form-control" name="parent_id">
				<option value="0"> - </option>
				<?php if(Arr::get($_GET, 'pid')):?>
				<?php option($cat_tree, Arr::get($_GET, 'pid'), 0);?>
				<?php else:?>
				<?php option($cat_tree, $info['parent_id'], $info['id']);?>
				<?php endif;?>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">名称</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" name="name" value="<?= $info['name'] ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">状态</label>
		<div class="col-sm-3">
			<select name="status" class="form-control">
				<option value="open" <?php if ($info['status'] == 'open') echo 'selected';?>>open</option>
				<option value="close" <?php if ($info['status'] == 'close') echo 'selected';?>>close</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-3">
			<button type="submit" class="btn btn-primary">提交</button>
		</div>
	</div>
</form>
