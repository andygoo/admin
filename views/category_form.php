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

<form action="" method="post" class="col-xs-7 col-sm-6 col-md-5 col-lg-4">
	<div class="form-group">
		<select class="form-control" name="parent_id">
			<option value="0"> -选择上级分类- </option>
			<?php if(Arr::get($_GET, 'pid')):?>
			<?php option($cat_tree, Arr::get($_GET, 'pid'), 0);?>
			<?php else:?>
			<?php option($cat_tree, $info['parent_id'], $info['id']);?>
			<?php endif;?>
		</select>
	</div>

	<div class="form-group">
		<input type="text" class="form-control" name="name" placeholder="名称" value="<?= $info['name'] ?>">
	</div>

	<div class="form-group">
		<label class="radio-inline">
            <input type="radio" name="status" value="open" checked> 正常
        </label>
        <label class="radio-inline">
            <input type="radio" name="status" value="close" <?php if ($info['status'] == 'close') echo 'checked';?>> 关闭
        </label>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-info">提交</button>
	</div>
</form>
