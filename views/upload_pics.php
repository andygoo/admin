
<h3 class="page-header">图片列表</h3>

<div class="demo-gallery image-container">
</div>

<?= $pager ?>

<style>
.image-container{
	width: 1044px;
}
</style>
<?= HTML::script('media/justified/jquery.justified.min.js');?>
<script>
$(function(){
	var photos = [];
	<?php foreach($list as $item): ?>
	<?php $img_width = $item['img_width'] > 1600 ? 1600 : $item['img_width'];?>
    <?php $img_url = URL::site('imagefly/w'.$img_width.'/'.$item['file_src'], true);?>
	photos.push({url: '<?= $img_url?>', width: <?= $item['img_width']?>, height: <?= $item['img_height']?>});
	<?php endforeach; ?>
    showPhotos(photos);
});
var showPhotos = function(photos) {
    $('.image-container').empty().justifiedImages({
        template: function(data) {
            return '<a class="photo-container swipe" href="' + data.url + '" data-size="' + data.width + 'x' + data.height + '" style="float: left;height:' + data.displayHeight + 'px;margin-right:' + data.marginRight + 'px;">' +
                '<img class="image-thumb" src="' + data.src + '" style="position: relative;width:' + data.displayWidth + 'px;height:' + data.displayHeight + 'px;" >' +
                '</a>';
        },
        images : photos,
        rowHeight: 150,
        maxRowHeight: 200,
        thumbnailPath: function(photo, width, height) {
            var w = parseInt(width * 2 / 100) * 100;
            return photo.url.replace(/\/w(\d+)\//, '/w'+w+'/');
        },
        getSize: function(photo){
            return {width: photo.width, height: photo.height};
        },
        margin: 6
    });
}
</script>

<?php include __DIR__ . '/photoswipe.php';?>