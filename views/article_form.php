<?php 

function option($items, $cat_id, $level=0) {
    foreach ($items as $item) {
        $selected = ($item['id']==$cat_id) ? 'selected' : '';
        echo '<option value="'.$item['id'].'" '.$selected.'>';
        echo str_repeat('├─', $level).$item['name'];
        if (isset($item['children']) && is_array($item['children'])) {
            option($item['children'], $cat_id, $level+1);
        }
        echo '</option>';
    }
}
?>

<form action="" method="post" class="form-horizontal ajax-submit">
	<div class="form-group">
		<label class="col-sm-1 control-label">文章分类</label>
		<div class="col-sm-3">
			<select name="cid" class="form-control">
				<option value="0">选择分类</option>
			    <?php option($cat_tree, $info['cid']);?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">文章标题</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="title" value="<?= $info['title']?>" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">显示网址</label>
		<div class="col-sm-6">
			<input type="text" class="form-control" name="custom_url" value="<?= $info['custom_url']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">文章摘要</label>
		<div class="col-sm-6">
			<textarea name="brief" class="form-control" rows="3"><?= $info['brief']?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">文章封面</label>
		<input type="hidden" class="form-control" name="pic[]" value="<?= $info['pic']?>">
		<div class="col-sm-2" id="fsUploadProgress">
			<?php if (!empty($info['pic'])):?>
			<div class="up-item">
			    <button class="close"><span>&times;</span></button>
			    <?php if (strpos($info['pic'], '://') !== false):?>
                    <?= HTML::image($info['pic'].'?imageView2/2/w/160/h/120', array('width'=>160, 'class'=>'img-thumbnail')) ?>
                <?php else:?>
                    <?= HTML::image('/imagefly/w200-h150-c/' . $info['pic'], array('width'=>160, 'class'=>'img-thumbnail')) ?>
                <?php endif;?>
			</div>
			<?php endif;?>
			<img class="img-thumbnail" src="<?= URL::site('media/img/default.png')?>" id="pickfile" <?php if (!empty($info['pic'])):?>style="display:none"<?php endif;?>>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">文章内容</label>
		<div class="col-sm-11">
			<textarea id="editor" name="content"><?= htmlspecialchars($info['content'])?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-3">
			<button type="submit" class="btn btn-primary">提交</button>
		</div>
	</div>
</form>

<style>
div.mce-fullscreen {z-index: 9999;}
.mce-menubtn.mce-fixed-width span {width:auto}
</style>
<?= HTML::script('media/tinymce/tinymce.min.js')?>
<script type="text/javascript">
tinyMCE.init({
	selector : 'textarea#editor',
	plugins: [
		  		"advlist autolink lists link image charmap print preview anchor",
		  		"searchreplace visualblocks code fullscreen imagetools upload",
		  		"insertdatetime media table contextmenu paste textcolor colorpicker emoticons",
		  		"codesample"
		  	],
  	toolbar: "upload undo redo | styleselect fontselect fontsizeselect forecolor | bold italic | link image emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample fullscreen preview",
  	autosave_ask_before_unload: false,
  	convert_urls: false,
	height : 400,
	content_css: ['<?= URL::site('media/css/preview.css')?>'],
	language: 'zh_CN'
});
</script>

<!-- 
<?php HTML::script('media/js/resizeable.js')?>
<style>
.resizable-east { width:10px; height:100%; position:absolute; top:0; right:0; cursor:e-resize; }
.resizable-north { width:100%; height:10px; position:absolute; left:0; bottom:0; cursor:n-resize; }
.resizable-north-west { width:20px; height:20px; position:absolute; right:0; bottom:0; cursor:nw-resize; }
</style>
<script>
$(function() {
    Resizeable('.mce-window');
});
</script> -->

<style>
.up-item{float:left;width:160px;margin:5px;position:relative}
.up-item .close{position:absolute;right:3px;top:0;}
.up-item .img-thumbnail{width:160px;}
.up-item .progress{position:absolute;left:0;bottom:0;width:100%;height:8px;margin:0;display:none}
</style>
<?php include __DIR__ . '/plupload.php';?>
<script>
$(function() {
	var uploader = new plupload.Uploader({
		browse_button : 'pickfile',
		multi_selection: false,
		url : '<?= URL::site('upload/ajaxadd')?>',
		flash_swf_url : '<?= URL::site('media/plupload/Moxie.swf')?>',
		silverlight_xap_url : '<?= URL::site('media/plupload/Moxie.xap')?>',
		filters: {
			mime_types: [{
				title : "图片文件", 
				extensions: "jpg,gif,png"
			}],
            max_file_size : '400kb',
			prevent_duplicates : true
	    }
	});
	uploader.init();

	uploader.bind('FilesAdded',function(up,files){
        plupload.each(files, function(file) {
        	var progress = new FileProgress(file, 'fsUploadProgress');
        	$('#pickfile').hide();

    		var remove_btn = $('#'+file.id).find('.close');
    		remove_btn.click(function(){
    			uploader.removeFile(file);
    			$('#pickfile').show();
    		});
        });
        this.start();
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

        $('#'+file.id).find('.close').show();
        
    	var res = info.response;
    	res = eval('('+res+')');
    	if (res.status=='ok') {
    	    var url = '/imagefly/w200-h150-c/'+res.data;
    	    $('#'+file.id).find('img').attr('src', url);
    	    $('#'+file.id).find('input').val(res.data);
    	}
	});

	$(document).on('click', '.up-item .close', function(){
		$(this).parents('.up-item').remove();
		//$('input[name=pic]').val('');
		$('#pickfile').show();
	});
});
</script>
