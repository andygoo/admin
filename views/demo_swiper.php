<h3 class="page-header">demo swiper</h3>

<?php 
$list = array(
    array(
        'url' => '',
        'pic' => 'http://admin.com/imagefly/w800/2015/11/24/14483387441203.jpg',
    ),
    array(
        'url' => '',
        'pic' => 'http://admin.com/imagefly/w800/2015/11/24/14483387446413.jpg',
    ),
);
?>

<div class="swiper-container" id="swiper1">
    <div class="swiper-wrapper">
        <?php foreach($list as $item): ?>
        <div class="swiper-slide"><img src="<?= $item['pic']?>" width="100%"></div>
        <?php endforeach;?>
    </div>
</div>

<?= HTML::style('media/swiper/css/swiper.min.css')?>
<?= HTML::script('media/swiper/js/swiper.min.js');?>
<script>
var swiper = new Swiper('#swiper1', {loop: true});
</script>