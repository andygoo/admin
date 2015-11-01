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

<form action="" method="post" class="form-horizontal">
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
		<label class="col-sm-1 control-label">文章摘要</label>
		<div class="col-sm-6">
			<textarea name="brief" class="form-control" rows="3"><?= $info['brief']?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">文章封面</label>
		<div class="col-sm-2" id="fsUploadProgress">
			<input type="hidden" class="form-control" name="pic" value="<?= $info['pic']?>">
			<?php if (!empty($info['pic'])):?>
			<div class="up-item" style="position:relative">
			<button class="close" style="position:absolute;right:2px;top:0px;"><span>&times;</span></button>
			<img class="img-thumbnail" width="170" src="<?= $info['pic']?>">
			</div>
			<?php endif;?>
			<img class="img-thumbnail" width="170" id="pickfile" src="<?= URL::site('media/img/default.png')?>" <?php if(!empty($info['pic'])):?>style="display: none"<?php endif;?>>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-1 control-label">文章内容</label>
		<div class="col-sm-11">
			<textarea id="editor" name="content"><?= $info['content']?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-1 col-sm-3">
			<button type="submit" class="btn btn-primary">提交</button>
		</div>
	</div>
</form>

<!-- 
<script>
//dialogs/image/image.js; onlineImage.reset();
window.UEDITOR_HOME_URL = '<?= URL::site('media/qiniu_ueditor_1.4.3')?>/';
</script>
<?= HTML::script('media/qiniu_ueditor_1.4.3/ueditor.config.js')?>
<?= HTML::script('media/qiniu_ueditor_1.4.3/ueditor.all.min.js')?>
 -->

 
<!-- 
<script>
window.UEDITOR_HOME_URL = '<?= URL::site('media/ueditor_1.4.3')?>/';
</script>
<?= HTML::script('media/ueditor_1.4.3/ueditor.config.js')?>
<?= HTML::script('media/ueditor_1.4.3/ueditor.all.min.js')?>
 -->

<!-- 
<script>
var ue = UE.getEditor('editor',{
	initialFrameHeight:420
});
</script>
 -->


<?= HTML::script('media/tinymce/tinymce.min.js')?>
<script type="text/javascript">
tinyMCE.init({
	selector : 'textarea#editor',
	plugins: [
		  		"advlist autolink lists link image charmap print preview anchor",
		  		"searchreplace visualblocks code fullscreen imagetools upload",
		  		"insertdatetime media table contextmenu paste textcolor colorpicker emoticons"
		  	],
  	toolbar: "upload undo redo | styleselect fontselect fontsizeselect forecolor | bold italic | link image emoticons | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fullscreen preview",
  	autosave_ask_before_unload: false,
  	convert_urls: false,
	height : 400,
	content_css: ['<?= URL::site('media/css/bootstrap.min.css')?>','<?= URL::site('media/css/preview.css')?>'],
	language: 'zh_CN'
});
</script>
<style>
div.mce-fullscreen {z-index: 9999;}
</style>


<?= HTML::script('media/qiniujs/plupload/plupload.full.min.js')?>
<script>
function FileProgress(file, targetID) {
    this.fileProgressID = file.id;
    this.file = file;
    this.fileProgressWrapper = $('#' + this.fileProgressID);
    
    if (!this.fileProgressWrapper.length) {
		var html = '<div class="up-item" style="position:relative" id="' + file.id +'">';
			html += '<button class="close" style="position:absolute;right:2px;top:0;"><span>&times;</span></button>';
			html += '<img class="img-thumbnail" width="170" src="" />';
	    	html += '<div class="progress" style="position:absolute;left:0;bottom:0;width:100%;height:8px;margin:0;display:none">'
	    	html += '<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>';
	    	html += '</div>';
			html += '</div>';
		this.fileProgressWrapper = $(html);
		$('#'+targetID).append(this.fileProgressWrapper);
		
		previewImage(file,function(imgsrc){
			$('#'+file.id).find('img').attr('src', imgsrc);
		});
    }
}
FileProgress.prototype.setProgress = function(percentage) {
    percentage = parseInt(percentage, 10);
    var progressbar = this.fileProgressWrapper.find('.progress-bar');
    progressbar.attr('aria-valuenow', percentage).css('width', percentage + '%');
};
FileProgress.prototype.setComplete = function(up, file, info) {
	var res = info.response;
	res = eval('('+res+')');
	if (res.status=='ok') {
	    var url = '/imagefly/w200'+res.data;
	    $('#'+file.id).find('img').attr('src', url);
	    $('input[name=pic]').val(url);
	}
    this.fileProgressWrapper.find('.progress').hide();
    //this.fileProgressWrapper.find('.close').hide();
};

function previewImage(file,callback) {
	if(!file || !/image\//.test(file.type)) return;
	if(file.type=='image/gif') {
		var fr = new mOxie.FileReader();
		fr.onload = function(){
			callback(fr.result);
			//fr.destroy();
			fr = null;
		}
		fr.readAsDataURL(file.getSource());
	}else{
		var preloader = new mOxie.Image();
		preloader.onload = function() {
			preloader.downsize(300, 300);
			var imgsrc = preloader.type=='image/jpeg' ? preloader.getAsDataURL('image/jpeg',80) : preloader.getAsDataURL();
			callback && callback(imgsrc);
			preloader.destroy();
			preloader = null;
		};
		preloader.load(file.getSource());
	}
}
$(function() {
	var uploader = new plupload.Uploader({
		browse_button : 'pickfile',
		multi_selection: false,
		url : '<?= URL::site('upload/ajaxadd')?>',
		flash_swf_url : '<?= URL::site('media/qiniujs/plupload/Moxie.swf')?>',
		silverlight_xap_url : '<?= URL::site('media/qiniujs/plupload/Moxie.xap')?>',
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
	});

	$(document).on('click', '.up-item .close', function(){
		$(this).parents('.up-item').remove();
		$('input[name=pic]').val('');
		$('#pickfile').show();
	});
});

</script>

