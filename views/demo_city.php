<h3 class="page-header">demo city</h3>

<div id="c">
    <select class="form-control pull-left" style="width:150px;margin-right: 5px;" id="prov"></select>
    <select class="form-control pull-left" style="width:150px;margin-right: 5px;display: none" id="city"></select>
    <select class="form-control" style="width:150px;display: none" id="coun"></select>
</div>

<?php HTML::script('media/js/city.js')?>
<?= HTML::script('media/js/require.js', array('data-main'=>'/media/js/config'))?>

<script>
//$(function () {
//require(['jquery', 'cities'], function($, all_cities) {
require(['cities'], function(all_cities) {

	$(document).on('change', '#city', function() {
		var idx_prov = $(this).prev('select').find('option:selected').index();
		var idx_city = $(this).find('option:selected').index();
		var data = all_cities[idx_prov]['children'][idx_city]['children'];
		
		if (typeof data == 'undefined') {
			$(this).nextAll('select').empty().hide();
		} else {
    		var options = '';
    		for(var i in data) {
    			options += '<option value="'+data[i]['code']+'">'+data[i]['name']+'</option>';
    		}
    		$(this).next('select').empty().append(options).show();
		}
	});

	$(document).on('change', '#prov', function() {
		var idx_prov = $(this).find('option:selected').index();
		var data = all_cities[idx_prov]['children'];
		
		if (typeof data == 'undefined') {
			$(this).nextAll('select').empty().hide();
		} else {
    		var options = '';
    		for(var i in data) {
    			options += '<option value="'+data[i]['code']+'">'+data[i]['name']+'</option>';
    		}
    		$(this).next('select').empty().append(options).show().change();
		}
	});

	(function () {
    	var data = all_cities;
    	var options = '';
    	for(var i in data) {
    		options += '<option value="'+data[i]['code']+'">'+data[i]['name']+'</option>';
    	}
    	$('#prov').empty().append(options).change();
	})();
});
</script>
