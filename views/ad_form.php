
<?= HTML::style('media/pikaday/css/pikaday.css')?>
<?= HTML::script('media/pikaday/js/pikaday.js')?>

<?= HTML::style('media/clockpicker/jquery-clockpicker.min.css')?>
<?= HTML::script('media/clockpicker/jquery-clockpicker.min.js')?>

<form action="" method="post" class="form-horizontal ajax-submit">

	<div class="form-group">
		<label class="col-sm-1 control-label">位置</label>
		<div class="col-sm-3">
            <select class="form-control" name="type" required>
    			<option value=""> - 选择广告位 - </option>
        	    <?php foreach ($types as $key=>$type):?>
    			<option value="<?= $key?>" <?php if($info['type']==$key || Arr::get($_GET, 'type')==$key):?>selected<?php endif;?>><?= $type?></option>
                <?php endforeach;?>
            </select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">图片</label>
		<div class="col-sm-6">
		    <div class="input-group">
		        <input class="form-control" type="url" name="pic_url" value="<?= $info['pic_url'] ?>">
        		<span class="input-group-btn">
                    <a class="btn btn-info" id="pickfile">+</a>
                </span>
            </div>
		</div>
	</div>
	<div class="form-group" id="upcontainer">
		<label class="col-sm-1 control-label"></label>
		<div class="col-sm-6" id="fsUploadProgress">
			<?php if (!empty($info['pic_url'])):?>
			<div class="up-item">
			    <button class="close"><span>&times;</span></button>
                <?= HTML::image($info['pic_url'], array('width'=>160, 'class'=>'img-thumbnail')) ?>
			</div>
			<?php endif;?>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">标题</label>
		<div class="col-sm-6">
		    <input type="text" class="form-control" name="title" value="<?= $info['title'] ?>">
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">链接</label>
		<div class="col-sm-6">
		    <input type="url" class="form-control" name="link_url" value="<?= $info['link_url'] ?>">
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">平台</label>
		<div class="col-sm-6">
		    <?php $plat_arr = explode('|', trim($info['plat'], '|'))?>
    	    <?php foreach ($plats as $item):?>
            <label class="checkbox-inline">
                <input type="checkbox" name="plat[]" value="<?= $item?>" <?php if (empty($info) || in_array($item, $plat_arr)):?>checked<?php endif;?>> <?= $item?>
            </label>
            <?php endforeach;?>
		</div>
	</div>

	<div class="form-group">
		<label class="col-sm-1 control-label">城市</label>
		<div class="col-sm-6">
            <label class="checkbox-inline">
                <input type="checkbox" name="city_all" value=""> 全部
            </label>
		    <?php $city_arr = explode('|', trim($info['city'], '|'))?>
    	    <?php foreach ($cities as $city_id => $city_name):?>
            <label class="checkbox-inline">
                <input type="checkbox" name="city[]" value="<?= $city_id?>" <?php if (empty($info['city']) || in_array($city_id, $city_arr)):?>checked<?php endif;?>> <?= $city_name?>
            </label>
            <?php endforeach;?>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">时间</label>
		<div class="col-sm-6">
            <label class="checkbox-inline">
                <input type="checkbox" id="time_btn" name="time_limit" value="1" <?php if (!empty($info['end_time'])):?>checked<?php endif;?>> 限制时间
            </label>
		</div>
	</div>
	
	<div class="form-group hid" style="display: none">
		<label class="col-xs-12 col-sm-1 control-label">开始</label>
		<div class="col-xs-4 col-sm-2">
	        <input type="text" class="form-control" name="start_date" id="start_date" value="<?= !empty($info['start_time']) ? date('Y-m-d', $info['start_time']) : ''?>" placeholder="开始日期" readonly>
    	</div>
    	<div class="col-xs-5 col-sm-2">
    		<div class="input-group clockpicker">
    	        <input type="text" class="form-control" name="start_time" value="<?= !empty($info['start_time']) ? date('H:i', $info['start_time']) : '08:00'?>" placeholder="开始时间" readonly>
    	        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
        	</div>
    	</div>
    </div>
    
	<div class="form-group hid" style="display: none">
		<label class="col-xs-12 col-sm-1 control-label">结束</label>
		<div class="col-xs-4 col-sm-2">
	        <input type="text" class="form-control" name="end_date" id="end_date" value="<?= !empty($info['end_time']) ? date('Y-m-d', $info['end_time']) : ''?>" placeholder="结束日期" readonly>
    	</div>
    	<div class="col-xs-5 col-sm-2">
    		<div class="input-group clockpicker">
    	        <input type="text" class="form-control" name="end_time" value="<?= !empty($info['end_time']) ? date('H:i', $info['end_time']) : '00:00'?>" placeholder="结束时间" readonly>
    	        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
        	</div>
    	</div>
    </div>
    
	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-3">
		    <button type="submit" class="btn btn-info">提交</button>
		</div>
	</div>
</form>

<script>
$(function() {
	$('input[name=city_all]').change(function() {
	    var t = $(this);
	    var checked = t.prop('checked');
	    $("input[name='city[]']").prop('checked', checked);
	});
	function check_all() {
    	if ($("input[name='city[]']:checked").length == $("input[name='city[]']").length) {
    		$('input[name=city_all]').prop('checked', true);
    	} else {
    		$('input[name=city_all]').prop('checked', false);
    	}
	}
	$("input[name='city[]']:checked").change(function() {
		check_all();
	});
	check_all();
});
</script>


<script>
$(function () {
    var picker1 = new Pikaday({
        field: document.getElementById('start_date')
    });
    var picker2 = new Pikaday({
        field: document.getElementById('end_date')
    });
    $('.clockpicker').clockpicker({
        //autoclose: true,
        'placement' : 'top'
    });
    $('#time_btn').change(function() {
        var t = $(this);
        var checked = t.prop('checked');
        if (checked) {
            $('.hid').show();
        } else {
            $('.hid').hide();
        }
    });
    $('#time_btn').change();
});
</script>

<style>
.up-item{float:left;width:160px;margin:5px;position:relative}
.up-item .close{position:absolute;right:3px;top:0;}
.up-item .img-thumbnail{width:160px;}
.up-item .progress{position:absolute;left:0;bottom:0;width:100%;height:8px;margin:0;display:none}
</style>
<?php include __DIR__ . '/plupload.php';?>

<?= HTML::script('media/js/qiniu.js')?>
<script>
$(function() {
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfile',
		multi_selection: false,
        flash_swf_url: '<?= URL::site('media/plupload/Moxie.swf')?>',
        uptoken_url: '<?= URL::site('qiniu/uptoken')?>',
        domain: 'http://7xkkhh.com1.z0.glb.clouddn.com/',
        //uptoken_url: '<?= URL::site('qiniu/uptoken_hc51')?>',
        //domain: 'http://image3.hc51img.com/',
		filters: {
			mime_types: [{
				title : "图片文件", 
				extensions: "jpg,gif,png"
			}],
            max_file_size : '400kb',
			prevent_duplicates : true
	    },
        // downtoken_url: '/downtoken',
        // unique_names: true,
        // save_key: true,
        // x_vars: {
        //     'id': '1234',
        //     'time': function(up, file) {
        //         var time = (new Date()).getTime();
        //         // do something with 'time'
        //         return time;
        //     },
        // },
        auto_start: true,
        init: {
            'FilesAdded': function(up, files) {
                plupload.each(files, function(file) {
                	var progress = new FileProgress(file, 'fsUploadProgress');
                	$('.up-item').eq(0).siblings('.up-item').remove();

            		var remove_btn = $('#'+file.id).find('.close');
            		remove_btn.click(function(){
            			uploader.removeFile(file);
            			$(this).parents('.up-item').remove();
            		});
                });
            },
            'BeforeUpload': function(up, file) {
            	$('#'+file.id).find('.progress').show();
            },
            'UploadProgress': function(up, file) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                progress.setProgress(file.percent + "%", file.speed);
            },
            'FileUploaded': function(up, file, info) {
                var progress = new FileProgress(file, 'fsUploadProgress');
                progress.setComplete(up, file, info);
                
                var res = $.parseJSON(info);
                var domain = up.getOption('domain');
                var url = domain + res.key;
                $('#'+file.id).find('img').attr('src', url).load(function() {

                    var image = new Image();
                    image.src = url;
                    var w = image.width;
                    var h = image.height;

                    //$.get('/qiniu/add',{'img_url':url, 'file_size': file.size, 'img_width': w, 'img_height': h},function(){});
                });
        		$('input[name=pic_url]').val(url);
            },
            'UploadComplete': function() {
            	//$('#uploadBtn').attr('disabled', true);
            },
            'Error': function(up, err, errTip) {
            },
            'Key': function(up, file) {
                var prefix = $.trim($('#prefix').val());
                if (prefix != '') {
                    return prefix + file.name;
                } else {
                	var file_type = file.name.substr(file.name.lastIndexOf(".")).toLowerCase();
                	var date = format_time(new Date(), 'yyyy/MM/dd');
                	var time = new Date().getTime();
                	var random = Math.floor(Math.random()*9);
                    var key = date+'/'+time+random+file_type; 
                    return key;
                }
            }
        }
    });

	$(document).on('click', '.up-item .close', function(){
		$(this).parents('.up-item').remove();
		$('input[name=pic_url]').val('');
	});
});
</script>
