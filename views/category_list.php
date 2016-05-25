
<?= HTML::script('media/js/Sortable.min.js')?>

<h3 class="page-header">类别列表 
<a href="<?= URL::site('category/add');?>" class="ajax-modal-sm">+</a>
</h3>

<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
<tr>
	<th>ID</th>
	<th>分类名称</th>
	<th>所属分类</th>
	<th>状态</th>
	<th width="150">操作</th>
</tr>
</thead>
<tbody id="cat-list">
<?php foreach($list as $item): ?>
<tr>
	<td><?= $item['id'] ?></td>
	<td class="drag-handle"><?= $item['name'] ?></td>
	<td><?= $item['parent_name'] ?></td>
	<td class="<?= $item['status']=='open' ? 'text-info' : 'text-danger' ?>"><?= $item['status'] ?></td>
	<td>
	    <a href="<?= URL::site('category/edit?id='.$item['id']);?>" class="btn btn-info btn-xs ajax-modal-sm">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;
	    <a href="<?= URL::site('category/add?pid='.$item['id']);?>" class="btn btn-info btn-xs ajax-modal-sm">+子类</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<script>
var list = document.getElementById("cat-list");
Sortable.create(list, {handle: ".drag-handle",});
</script>
