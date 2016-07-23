
<?= HTML::style('media/pikaday/css/pikaday.css')?>
<?= HTML::script('media/pikaday/js/pikaday.js')?>

<h3 class="page-header">订单列表</h3>

<form class="form-inline ajax-submit" method="get">
	<div class="form-group">
		<input type="text" class="form-control" id="date" name="date" placeholder="日期" value="<?= Arr::get($_GET, 'date', date('Y-m-d')) ?>">
	</div>

    <div class="form-group">
        <select class="form-control" name="pay_status">
			<option value="">支付状态</option>
			<?php $pay_status = Arr::get($_GET, 'pay_status', '');?>
			<?php foreach ($pay_status_arr as $key => $item):?>
			<option value="<?php echo $key?>" <?php if($pay_status!=='' && $pay_status==$key):?>selected<?php endif;?>><?php echo $item?></option>
			<?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="deliver_status">
			<option value="">发货状态</option>
			<?php $deliver_status = Arr::get($_GET, 'deliver_status', '');?>
			<?php foreach ($deliver_status_arr as $key => $item):?>
			<option value="<?php echo $key?>" <?php if($deliver_status!=='' && $deliver_status==$key):?>selected<?php endif;?>><?php echo $item?></option>
			<?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-info" type="submit">查找</button>
    </div>
</form>
<br>

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
	<th>支付</th>
	<th>发货</th>
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
	<td><?= $item['pay_status'] ?></td>
	<td><?= $item['deliver_status'] ?></td>
	<td>
	    <a href="<?php echo URL::site('order/goods?order_id='.$item['id'])?>" class="btn btn-info btn-xs ajax-modal">查看详情</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?= $pager ?>

<script>
$(function() {
	var picker = new Pikaday({
	    field: document.getElementById('date'),
	    //format: 'YYYY/MM/DD',
	    minDate: new Date('2015-06-01'),
	    maxDate: new Date('<?php echo date('Y-m-d')?>')
	});
});
</script>