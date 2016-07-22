
<h3 class="page-header">订单详情 <small>共有 <?php echo $info['order_items']?> 件商品，金额 <?php echo $info['order_amount']?> 元</small></h3>

<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
<tr>
	<th>图片</th>
	<th>名称</th>
	<th>单价</th>
	<th>数量</th>
	<th>小计</th>
</tr>
</thead>
<tbody id="cat-list">
<?php foreach($list as $item): ?>
<?php $opts = json_decode($item['goods_opts'], true)?>
<tr>
	<td><img width="80" src="<?= $opts['pic'] ?>"></td>
	<td><?= $opts['title'] ?></td>
	<td><?= $item['goods_price'] ?></td>
	<td><?= $item['goods_qty'] ?></td>
	<td><?= $item['goods_total'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php if (1||$info['status']==1):?>
<a href="<?php echo URL::site('order/deliver?order_id='.$info['id'])?>" qonclick="return confirm('确认现在发货吗？');" class="btn btn-info pull-right ajax-click">现在发货</a>
<?php endif;?>
</div>
