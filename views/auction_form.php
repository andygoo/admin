
<?= HTML::script('media/js/Sortable.min.js')?>

<?= HTML::style('media/pikaday/css/pikaday.css')?>
<?= HTML::script('media/pikaday/js/pikaday.js')?>

<?= HTML::style('media/clockpicker/jquery-clockpicker.min.css')?>
<?= HTML::script('media/clockpicker/jquery-clockpicker.min.js')?>

<form action="" method="post" class="form-horizontal ajax-submit">
	<div class="form-group">
		<label class="col-sm-1 control-label">图片</label>
		<div class="col-sm-7">
    		<div>
                <button id="pickfiles" class="btn btn-default">选择文件</button>
                <button id="uploadBtn" class="btn btn-info">上传</button>
            </div>
            <div id="fsUploadProgress">
			<?php if (!empty($info['pic'])):?>
			    <?php $pics = json_decode($info['pic'], true)?>
    			<?php foreach ($pics as $pic):?>
    			<div class="up-item">
    			    <button class="close"><span>&times;</span></button>
    			    <?php if (strpos($pic, '://') !== false):?>
                        <?= HTML::image($pic.'?imageView2/2/w/160/h/160', array('width'=>160, 'class'=>'img-thumbnail')) ?>
                    <?php else:?>
                        <?= HTML::image('/imagefly/w200-h200-c/' . $pic, array('width'=>160, 'class'=>'img-thumbnail')) ?>
                    <?php endif;?>
		            <input type="hidden" class="form-control" name="pic[]" value="<?= $pic?>">
    			</div>
    			<?php endforeach;?>
			<?php endif;?>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">开始</label>
		<div class="col-sm-2">
	        <input type="text" class="form-control" name="start_date" id="start_date" value="<?= date('Y-m-d', $info['start_time'])?>" placeholder="开拍日期" required>
    	</div>
    	<div class="col-sm-2">
    		<div class="input-group clockpicker">
    	        <input type="text" class="form-control" name="start_time" value="<?= date('H:i', $info['start_time'])?>" placeholder="起拍时间" required>
    	        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
        	</div>
    	</div>
    </div>
    
	<div class="form-group">
		<label class="col-sm-1 control-label">结束</label>
		<div class="col-sm-2">
	        <input type="text" class="form-control" name="end_date" id="end_date" value="<?= date('Y-m-d', $info['end_time'])?>" placeholder="截拍日期" required>
    	</div>
    	<div class="col-sm-2">
    		<div class="input-group clockpicker">
    	        <input type="text" class="form-control" name="end_time" value="<?= date('H:i', $info['end_time'])?>" placeholder="截拍时间" required>
    	        <span class="input-group-addon">
                    <span class="glyphicon glyphicon-time"></span>
                </span>
        	</div>
    	</div>
    </div>
    
	<div class="form-group">
		<label class="col-sm-1 control-label">价格</label>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="start_price" value="<?= $info['start_price']?>" placeholder="起拍价" required>
		</div>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="step_price" value="<?= $info['step_price']?>" placeholder="加幅" required>
		</div>
		<div class="col-sm-2">
			<input type="text" class="form-control" name="reserve_price" value="<?= $info['reserve_price']?>" placeholder="底价" required>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-1 control-label">简介</label>
		<div class="col-sm-6">
			<textarea class="form-control" name="desc" rows="8"><?= $info['desc']?></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-3">
			<button type="submit" class="btn btn-primary">提交</button>
		</div>
	</div>
</form>

<script>
$(function () {
    var picker1 = new Pikaday({
        field: document.getElementById('start_date'),
        minDate: new Date('<?php echo date('Y-m-d')?>')
    });
    var picker2 = new Pikaday({
        field: document.getElementById('end_date'),
        minDate: new Date('<?php echo date('Y-m-d')?>')
    });
    $('.clockpicker').clockpicker({
        //autoclose: true
    });
    Sortable.create(document.getElementById("fsUploadProgress"), {
    	handle: ".up-item",
    	animation: 150
    });
});
</script>

<style>
.up-item{float:left;width:160px;margin:5px;position:relative}
.up-item .close{position:absolute;right:3px;top:0;}
.up-item .img-thumbnail{width:160px;}
.up-item .progress{position:absolute;left:0;bottom:0;width:100%;height:8px;margin:0;display:none}
</style>
<?php include Kohana::find_file('views', 'plupload');?>

<script>
$(function() {
	var uploader = new plupload.Uploader({
		browse_button : 'pickfiles',
		url : '<?= URL::site('upload/ajaxadd')?>',
		flash_swf_url : '<?= URL::site('media/plupload/Moxie.swf')?>',
		silverlight_xap_url : '<?= URL::site('media/plupload/Moxie.xap')?>',
		filters: {
			mime_types: [{
				title : "图片文件", 
				extensions: "jpg,gif,png"
			}],
            max_file_size : '1000kb',
			prevent_duplicates : true
	    }
	});
	uploader.init();

	uploader.bind('FilesAdded',function(up,files){
        plupload.each(files, function(file) {
        	var progress = new FileProgress(file, 'fsUploadProgress');

    		var remove_btn = $('#'+file.id).find('.close');
    		remove_btn.click(function(){
    			uploader.removeFile(file);
    		});
        });
	});
	uploader.bind('BeforeUpload',function(up, file){
		$('#'+file.id).find('.progress').show();
	});
	uploader.bind('UploadProgress',function(up, file){
        var progress = new FileProgress(file, 'fsUploadProgress');
	    progress.setProgress(file.percent);
	});
	uploader.bind('FileUploaded',function(up, file, info){
        var progress = new FileProgress(file, 'fsUploadProgress');
        progress.setComplete(up, file, info);

    	var res = info.response;
    	res = eval('('+res+')');
    	if (res.status=='ok') {
    	    var url = '/imagefly/w200-h200-c/'+res.data;
    	    $('#'+file.id).find('img').attr('src', url);
    	    $('#'+file.id).find('input').val(res.data);
    	}
	});

	$(document).on('click', '.up-item .close', function(){
		$(this).parents('.up-item').remove();
	});

    $('#uploadBtn').click(function() {
    	uploader.start();
    	return false;
    });
});
</script>
