
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
        <select class="form-control" name="entrance">
        <option value=""> - 统计区域 - </option>
        <?php foreach ($entra as $key => $item):?>
        <option value="<?= $key?>" <?php if(Arr::get($_GET, 'entrance')==$key):?>selected<?php endif;?>><?= $item?></option>
        <?php endforeach;?>
        </select>
    </div>
    <div class="form-group">
        <input type="text" name="date_start" class="form-control" id="date_start" style="width:120px" value="<?= Arr::get($_GET, 'date_start', date('Ymd', strtotime('-1 day')))?>" placeholder="开始日期" required>
    </div> -
    <div class="form-group">
        <input type="text" name="date_end" class="form-control" id="date_end" style="width:120px" value="<?= Arr::get($_GET, 'date_end', date('Ymd', strtotime('-1 day')))?>" placeholder="截止日期" required>
    </div>
    <button type="submit" class="btn btn-info">查找</button>
</form>
<br>

<table class="table table-hover table-bordered">
<thead>
<tr>
	<th>日期</th>
	<th>平台</th>
	<th>统计区</th>
	<th>首页UV / PV</th>
	<th>列表页UV / PV</th>
	<th>详情页UV / PV</th>
	<th>拨打电话UV / PV</th>
	<th>提交线索UV / PV</th>
</tr>
</thead>
<tbody>
<?php foreach($list as $item): ?>
<tr>
	<td><?= $item['date'] ?></td>
	<td><?= isset($plats[$item['plat']]) ? $plats[$item['plat']] : '' ?></td>
	<td><?= isset($entra[$item['entrance']]) ? $entra[$item['entrance']] : $item['entrance'] ?></td>
	<td><?= $item['uv_home'] ?> / <?= $item['pv_home'] ?></td>
	<td><?= $item['uv_list'] ?> / <?= $item['pv_list'] ?></td>
	<td><?= $item['uv_detail'] ?> / <?= $item['pv_detail'] ?></td>
	<td><?= $item['uv_phone'] ?> / <?= $item['pv_phone'] ?></td>
	<td><?= $item['uv_call'] ?> / <?= $item['pv_call'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?= $pager ?>

<script>
$(function () {
    var picker1 = new Pikaday({
        field: document.getElementById('date_start'),
        minDate: new Date('2015-06-01'),
        maxDate: new Date('<?php echo date('Y-m-d')?>'),
        onSelect: 	function() {
            var d = this.toString();
			d = d.replace(/-/g, '');
			$('input[name=date_start]').val(d);
		}
    });
    var picker2 = new Pikaday({
        field: document.getElementById('date_end'),
        minDate: new Date('2015-06-01'),
        maxDate: new Date('<?php echo date('Y-m-d')?>'),
        onSelect: 	function() {
            var d = this.toString();
			d = d.replace(/-/g, '');
			$('input[name=date_end]').val(d);
		}
    });
});
</script>