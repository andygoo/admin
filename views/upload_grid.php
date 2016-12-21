<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>图片管理</title>
<?= HTML::style('media/bootstrap/css/bootstrap.min.css')?>

<?= HTML::script('media/js/jquery.min.js')?>
<?= HTML::script('media/bootstrap/js/bootstrap.min.js')?>

<?= HTML::style('media/pikaday/css/pikaday.css')?>
<?= HTML::script('media/pikaday/js/pikaday.js')?>
<style>
.up-files .img-thumbnail{cursor:pointer}
.up-files .img-thumbnail:hover{border:1px solid orange}
.up-files .img-thumbnail.selected{border:1px solid blue}
abbr[data-original-title],abbr[title] {
    cursor: default;
    border-bottom: 0px dotted #777
}
.img-thumbnail{transition:none}
</style>
</head>
<body style="padding:10px 20px">
<div class="container">
	<div class="row">
	    <div style="margin-bottom:10px">
            <button id="pickfiles" class="btn btn-default">选择文件</button>
            <button id="uploadBtn" class="btn btn-info">上传</button>
            
            <div class="pull-right col-xs-6 col-sm-6 col-md-6">
                <form id="search_form" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" id="q" name="q" placeholder="">
                        <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" id="search">查找</button>
                        </span>
                     </div>
                 </form>
             </div>
        </div>
            
        <div id="fsUploadProgress">
            <?php include __DIR__ . '/upload_grid_increment.php';?>
        </div>
        
        <div style="clear:both"></div>
        
        <nav class="pager">
        <?php if ($pager->next_page): ?>
        <a class="btn btn-default btn-block" href="<?= $pager->url($pager->next_page) ?>"><?= '查看更多' ?></a>
        <?php endif ?>
        </nav>
            
	</div>
</div>

<style>
.up-item, .up-files{float:left;width:120px;height:90px;margin-right:6px;margin-bottom:6px;position:relative}
.up-item .close, .up-files .close{position:absolute;right:3px;top:0;}
.up-item .img-thumbnail, .up-files .img-thumbnail{width:120px;height:90px;}
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
            max_file_size : '400kb',
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
    	    var url = '/imagefly/w120-h90-c/'+res.data;
    	    $('#'+file.id).find('img').attr('src', url);
    	    
    	    var ourl = '/imagefly/w800/'+res.data;
    	    $('#'+file.id).attr('class', 'up-files').find('img').attr('o-src', ourl);
    	}
	});

    $('#uploadBtn').click(function() {
    	uploader.start();
    });
});
</script>

<script>
$(function() {
    $(document).on('click', ".up-files .img-thumbnail", function(){
        var t = $(this);
    	var selected = t.hasClass("selected");
    	selected ? t.removeClass("selected") : t.addClass("selected");
    });

	$(document).on('click', '.pager>a', function(){
		var t = $(this);
		var url = t.attr('href');
		if (url.split('#')[0].length) {
    		$.get(url, function(res) {
    			$('#fsUploadProgress').append(res.content);
    			$('.pager>a').attr('href', res.nexturl);
    			if (!res.nexturl) {
    				$('.pager').hide();
    			} 
    		});
		}
		return false;
	});

	$('#search_form').submit(function() {
		var url = $(this).attr('action');
		var params = {};
		params.q = $('input[name=q]').val();
		$.get(url, params, function(res) {
			$('#fsUploadProgress').html(res.content);
			$('.pager>a').attr('href', res.nexturl);
			if (!res.nexturl) {
				$('.pager').hide();
			} else {
				$('.pager').show();
			}
		});
		return false;
	});
	
    var picker = new Pikaday({
        field: document.getElementById('q'),
        //format: 'YYYY/MM/DD',
        minDate: new Date('2015-06-01'),
        maxDate: new Date('<?php echo date('Y-m-d')?>'),
        onSelect: 	function() {
            var d = this.toString();
			d = d.replace(/-/g, '/');
			$('input[name=q]').val(d);
		}
    });
});
</script>

</body>
</html>
