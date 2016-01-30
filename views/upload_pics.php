
<h3 class="page-header">图片列表</h3>
<style>
/* clearfix because of floats */
.row-grid-container:before,
.row-grid-container:after {
  content: "";
  display: table;
}
.row-grid-container:after {
  clear: both;
}
.row-grid-item {
  display: block;
  float: left;
  margin-bottom: 10px;
}
.row-grid-item img {
  max-width: 100%;
  max-height: 100%;
  vertical-align: bottom;
}
.first-item {
  clear: both;
}
/* remove margin bottom on last row */
.last-row, .last-row ~ .row-grid-item {
  margin-bottom: 0;
}
</style>

<div class="row-grid-container demo-gallery">
<?php foreach($list as $item): ?>
    <?php $img_width = $item['img_width'] > 1600 ? 1600 : $item['img_width'];?>
    <a class="row-grid-item swipe" href="<?= URL::site('imagefly/w'.$img_width.'/'.$item['file_src']) ?>" data-size="<?= $item['img_width'] ?>x<?= $item['img_height'] ?>">
        <img src="<?= URL::site('imagefly/h300/'.$item['file_src']) ?>" width="<?= ceil(120*$item['img_width']/$item['img_height']);?>" height="120" />
    </a>
<?php endforeach; ?>
</div>

<?= $pager ?>

<?php include Kohana::find_file('views', 'photoswipe');?>

<?= HTML::script('media/rowgrid/jquery.row-grid.min.js');?>
<script>
$(function(){
    $(".row-grid-container").rowGrid({
        itemSelector: ".row-grid-item", 
        minMargin: 10, 
        maxMargin: 10,
        lastRowClass: "last-row",
        firstItemClass: "first-item"
    });
});
</script>
