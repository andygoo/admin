
<h3 class="page-header">七牛上传文件</h3>

<div id="container">
    <button id="pickfiles" class="btn btn-default">选择文件</button>
    <button id="uploadBtn" class="btn btn-info">上传</button>
</div>

<div id="fsUploadProgress" class="row" style="margin: 10px 0;">
</div>

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
	<a class="swipe" href="<?= $item['file_src'] ?>" data-size="<?= $item['img_width'] ?>x<?= $item['img_height'] ?>">
	    <?= HTML::image($item['file_src'].'?imageView2/2/w/80/h/80', array('width'=>80)) ?>
	</a>
	</td>
	<td><?= strtoupper($item['file_type']) ?></td>
	<td><?= Text::bytes($item['file_size']) ?></td>
	<td><?= $item['img_width'] ?> x <?= $item['img_height'] ?> px</td>
	<td><?= date('Y-m-d H:i:s', $item['add_time']) ?></td>
	<td>
	    <a href="<?= URL::site('qiniu/del')?>?id=<?= $item['id'] ?>" onclick="return confirm('确定要删除吗？');" class="btn btn-info btn-xs">删除</a>
	</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?= $pager ?>

<?php include Kohana::find_file('views', 'photoswipe');?>

<style>
.up-item{float:left;width:160px;margin:5px;position:relative}
.up-item .close{position:absolute;right:3px;top:0;}
.up-item .img-thumbnail{width:160px;}
.up-item .progress{position:absolute;left:0;bottom:0;width:100%;height:8px;margin:0;display:none}
</style>
<?php include Kohana::find_file('views', 'plupload');?>

<?= HTML::script('media/js/qiniu.js')?>
<script>
$(function() {
    var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        container: 'container',
        drop_element: 'container',
        max_file_size: '100mb',
        flash_swf_url: '<?= URL::site('media/plupload/Moxie.swf')?>',
        dragdrop: true,
        chunk_size: '4mb',
        uptoken_url: '<?= URL::site('qiniu/uptoken')?>',
        domain: 'http://7xkkhh.com1.z0.glb.clouddn.com/',
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
        auto_start: false,
        init: {
            'FilesAdded': function(up, files) {
                plupload.each(files, function(file) {
                	var progress = new FileProgress(file, 'fsUploadProgress');

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

                    $.get('/qiniu/add',{'img_url':url, 'file_size': file.size, 'img_width': w, 'img_height': h},function(){});
                });

            },
            'UploadComplete': function() {
            	//$('#uploadBtn').attr('disabled', true);
            },
            'Error': function(up, err, errTip) {
            },
            'Key': function(up, file) {
            	var file_type = file.name.substr(file.name.lastIndexOf(".")).toLowerCase();
            	var date = format_time(new Date(), 'yyyy/MM/dd');
            	var time = new Date().getTime();
            	var random = Math.floor(Math.random()*9);
                var key = date+'/'+time+random+file_type; 
                return key;
            }
        }
    });
    $('#uploadBtn').click(function() {
    	uploader.start();
    });
});
</script>
