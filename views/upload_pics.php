
<h3 class="page-header">图片列表</h3>

<div class="demo-gallery">
<?php foreach($list as $item): ?>
<?php $img_width = $item['img_width'] > 1600 ? 1600 : $item['img_width'];?>
    <a class="swipe" href="<?= URL::site('imagefly/w'.$img_width.'/'.$item['file_src']) ?>" data-size="<?= $item['img_width'] ?>x<?= $item['img_height'] ?>">
        <img src="<?= URL::site('imagefly/w200-h150/'.$item['file_src']) ?>" height="120" style="margin-bottom: 5px">
    </a>
<?php endforeach; ?>
</div>

<?= $pager ?>

<?php include Kohana::find_file('views', 'photoswipe');?>

