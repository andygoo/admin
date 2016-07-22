
<h3 class="page-header">订单列表</h3>

<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
<tr>
	<th>订单ID</th>
	<th>数量</th>
	<th>金额</th>
	<th>收货人</th>
	<th>电话</th>
	<th>地址</th>
	<th>时间</th>
	<th>状态</th>
	<th>操作</th>
</tr>
</thead>
<tbody id="cat-list">
<?php foreach($list as $item): ?>
<tr>
	<td><?= $item['id'] ?></td>
	<td><?= $item['order_items'] ?></td>
	<td><?= $item['order_amount'] ?></td>
	<td><?= $item['consignee'] ?></td>
	<td><?= $item['phone'] ?></td>
	<td><?= $item['address'] ?></td>
	<td><?= date('Y-m-d H:i', $item['created_at']) ?></td>
	<td><?= $item['order_status'] ?></td>
	<td>
	    <a href="<?php echo URL::site('order/goods?order_id='.$item['id'])?>" class="btn btn-info btn-xs ajax-modal">查看详情</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?= $pager ?>