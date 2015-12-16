
<?= HTML::style('media/pikaday/css/pikaday.css')?>
<?= HTML::script('media/pikaday/js/pikaday.js')?>

<h3 class="page-header">转化率统计</h3>

<style>
.dropdown-menu>li>label {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: 400;
  line-height: 1.42857143;
  color: #333;
  white-space: nowrap;
  cursor: pointer;
}
.dropdown-menu>li>label:hover {
    color: #262626;
    background-color: #f5f5f5
}
abbr[data-original-title], abbr[title] {border-bottom: none;}
</style>
<form class="form-inline" method="get">
    <div class="form-group">
        <select class="form-control" name="plat">
        <option value=""> - 选择平台 - </option>
        <?php foreach ($plats as $key => $plat):?>
        <option value="<?= $key?>" <?php if(Arr::get($_GET, 'plat')==$key):?>selected<?php endif;?>><?= $plat?></option>
        <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
        <input type="text" name="date" class="form-control" id="date" value="<?= Arr::get($_GET, 'date', date('Ymd', strtotime('-1 day')))?>" placeholder="日期">
    </div>
    <!-- 
    <div class="form-group">
        <input type="text" name="entrance" class="form-control" value="<?= Arr::get($_GET, 'entrance')?>" placeholder="">
    </div> -->
    <button type="submit" class="btn btn-info">查找</button>
</form>
<br>

<table class="table table-hover table-bordered">
<thead>
<tr>
	<th>日期</th>
	<th>平台</th>
	<th>入口</th>
	<th>首页pv</th>
	<th>列表页pv</th>
	<th>详情页pv</th>
	<th>拨打电话次数</th>
	<th>提交线索次数</th>
</tr>
</thead>
<tbody>
<?php foreach($list as $item): ?>
<tr>
	<td><?= $item['date'] ?></td>
	<td><?= $plats[$item['plat']] ?: '' ?></td>
	<td><?= $item['entrance'] ?></td>
	<td><?= $item['pv_home'] ?></td>
	<td><?= $item['pv_list'] ?></td>
	<td><?= $item['pv_detail'] ?></td>
	<td><?= $item['num_call'] ?></td>
	<td><?= $item['num_phone'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?= $pager ?>

<script>
$(function () {
    var picker1 = new Pikaday({
        field: document.getElementById('date'),
        minDate: new Date('2015-06-01'),
        maxDate: new Date('<?php echo date('Y-m-d')?>'),
        onSelect: 	function() {
            var d = this.toString();
			d = d.replace(/-/g, '');
			$('input[name=date]').val(d);
		}
    });
});
</script>