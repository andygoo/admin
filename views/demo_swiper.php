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

$list2 = array(
        'http://image1.hc51img.com/17855901962e8ba9076942410b41b962c9aba21a.jpg',
        'http://image1.hc51img.com/3c17b5cbefbf874ee03158d5a5201222dfa35991.jpg',
        'http://image1.hc51img.com/3fda95a16aa7e9b381226e8a2d520e2b775e1012.jpg',
        'http://image1.hc51img.com/e74343983ec7218a055f9b632d9c25107058018d.jpg',
        'http://image1.hc51img.com/d005616e6e3df01d6c2528981a97860e836056d8.jpg',
        'http://image1.hc51img.com/734c685a67e2f58fc9b34d6076b493135a683d7e.jpg',
);
?>
<!-- 
<div class="swiper-container" id="swiper1" style="width:600px">
    <div class="swiper-wrapper">
        <?php foreach($list as $item): ?>
        <div class="swiper-slide"><img src="<?= $item['pic']?>" width="100%"></div>
        <?php endforeach;?>
    </div>
</div> -->

<div class="swiper-container gallery-top" style="width:400px;height: 300px">
    <div class="swiper-wrapper">
        <?php foreach($list2 as $pic): ?>
        <div class="swiper-slide">
            <img data-src="<?= $pic?>?imageView2/1/w/400/h/300" width="100%" class="swiper-lazy">
            <div class="swiper-lazy-preloader"></div>
        </div>
        <?php endforeach;?>
    </div>
    <div class="swiper-pagination" style="color:#fff"></div>
</div>

<style>
.gallery-thumbs .active-nav {border: 1px solid #d00;}
</style>
<div class="swiper-container gallery-thumbs" style="width:400px; margin-top:3px">
    <div class="swiper-wrapper">
        <?php foreach($list2 as $pic): ?>
        <div class="swiper-slide" style="width:100px">
            <img src="<?= $pic?>?imageView2/1/w/280/h/210" width="100%">
        </div>
        <?php endforeach;?>
    </div>
</div>

<?= HTML::style('media/swiper/css/swiper.min.css')?>
<?= HTML::script('media/swiper/js/swiper.min.js');?>
<script>
var swiper = new Swiper('#swiper1', {loop: true});

var galleryTop = new Swiper('.gallery-top', {
	lazyLoading : true,
	lazyLoadingInPrevNext : true,
	pagination: '.swiper-pagination',
    paginationType: 'fraction',
	onSlideChangeStart: function(swiper) {
		var idx = swiper.activeIndex;
		var activeNav = $('.gallery-thumbs .swiper-slide').eq(idx);
	    activeNav.addClass('active-nav').siblings().removeClass('active-nav');
		if (!activeNav.hasClass('swiper-slide-visible')) {
			galleryThumbs.slideTo(idx-1);
		}
	}
});
var galleryThumbs = new Swiper('.gallery-thumbs', {
    slidesPerView: 'auto',
    spaceBetween: 1,
    onTap: function(swiper) {
		var idx = swiper.clickedIndex;
		galleryTop.slideTo(idx, 500, false);
		var activeNav = $('.gallery-thumbs .swiper-slide').eq(idx);
		activeNav.addClass('active-nav').siblings().removeClass('active-nav');
		if (!activeNav.hasClass('swiper-slide-visible')) {
			swiper.slideTo(idx-1);
		}
	}
});
</script>