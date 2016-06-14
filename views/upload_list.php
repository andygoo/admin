
<h3 class="page-header">上传文件列表</h3>

<div id="container">
    <button id="pickfiles" class="btn btn-default">选择文件</button>
    <button id="uploadBtn" class="btn btn-info">上传</button>
</div>

<div id="fsUploadProgress" class="row" style="margin: 10px 0;">
</div>

<div class="table-responsive">
<table class="table table-hover table-bordered">
<thead>
<tr>
	<th width="50">ID</th>
	<th width="80">文件</th>
	<th width="55">类型</th>
	<th width="85">大小</th>
	<th width="120">尺寸</th>
	<th width="150">上传时间</th>
	<th width="50">操作</th>
</tr>
</thead>
<tbody class="demo-gallery">
<?php foreach($list as $item): ?>
<tr>
	<td><?= $item['id'] ?></td>
	<td>
    <?php $img_width = $item['img_width'] > 1600 ? 1600 : $item['img_width'];?>
    <a class="swipe" href="<?= URL::site('imagefly/w'.$img_width.'/'.$item['file_src']) ?>" data-size="<?= $item['img_width'] ?>x<?= $item['img_height'] ?>">
        <img src="<?= URL::site('imagefly/w120/'.$item['file_src']) ?>" width="80">
        <figure style="display: none;">This is dummy caption.</figure>
    </a>
	</td>
	<td><?= strtoupper($item['file_type']) ?></td>
	<td><?= Text::bytes($item['file_size']) ?></td>
	<td><?= $item['img_width'] ?> x <?= $item['img_height'] ?> px</td>
	<td><?= date('Y-m-d H:i:s', $item['add_time']) ?></td>
	<td>
	    <a href="<?= URL::site('upload/del')?>?id=<?= $item['id'] ?>" onclick="return confirm('确定删除这条记录吗？')" class="btn btn-info btn-xs ajax-del">删除</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<?= $pager ?>

<?php include __DIR__ . '/photoswipe.php';?>

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
		browse_button : 'pickfiles',
		//multi_selection: false,
		url : '<?= URL::site('upload/ajaxadd')?>',
		flash_swf_url : '<?= URL::site('media/plupload/Moxie.swf')?>',
		silverlight_xap_url : '<?= URL::site('media/plupload/Moxie.xap')?>',
		filters: {
			mime_types: [{
				title : "图片文件", 
				extensions: "jpg,gif,png"
			}],
            max_file_size : '8000kb',
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
    			$(this).parents('.up-item').remove();
    		});
        });
	});
	uploader.bind('BeforeUpload',function(up, file){
		$('#'+file.id).find('.progress').show();
	});
	uploader.bind('UploadProgress',function(up, file){
		//console.log(file.percent);
        var progress = new FileProgress(file, 'fsUploadProgress');
	    progress.setProgress(file.percent);
	});
	uploader.bind('FileUploaded',function(up, file, info){
        var progress = new FileProgress(file, 'fsUploadProgress');
        progress.setComplete(up, file, info);
        
    	var res = info.response;
    	res = eval('('+res+')');
    	if (res.status=='ok') {
    	    var url = '/imagefly/w200/'+res.data;
    	    $('#'+file.id).find('img').attr('src', url);
    	}
	});

    $('#uploadBtn').click(function() {
    	uploader.start();
    });
});

</script>
