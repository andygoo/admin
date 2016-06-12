
<style>
.max-line1 {
    text-overflow: -o-ellipsis-lastline;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
}
.max-line2 {
    text-overflow: -o-ellipsis-lastline;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
</style>

<h3 class="page-header">拍品列表 
<a href="<?= URL::site('auction/add');?>" class="ajax-click">+</a>
</h3>

<ul class="media-list">
<?php foreach($list as $item): ?>
    <li class="media">
        <div class="media-left">
    	    <?php $pics = json_decode($item['pic'], true); $pic = $pics[0];?>
            <?php if (strpos($pic, '://') !== false):?>
                <?= HTML::image($pic.'?imageView2/2/w/200/h/200', array('width'=>120)) ?>
            <?php else:?>
                <?= HTML::image('/imagefly/w200-h200-c/' . $pic, array('width'=>120)) ?>
            <?php endif;?>
        </div>
        <div class="media-body">
        	<h3 class="media-heading text-muted max-line2" style="font-size:14px;line-height: 20px;">
        	    <?= str_replace("\n", '&nbsp;&nbsp;', $item['desc']) ?>
        	</h3>
        	<div class="text-muted">
            	起拍价：<span class="text-primary"><?= $item['start_price'] ?>元</span>&nbsp;&nbsp;
            	加价幅度：<span class="text-primary"><?= $item['step_price'] ?>元</span>&nbsp;&nbsp;
            	底价：<span class="text-primary"><?= $item['reserve_price'] ?>元</span>&nbsp;&nbsp;
            	当前价：<span class="text-primary"><?= $item['curr_price'] ?>元</span>&nbsp;&nbsp;
            	图片：<span class="text-primary"><?php echo count($pics)?>张</span>
        	</div>
        	<p class="text-muted">
                                               时间：<span class="text-primary"><?= date('Y/m/d H:i', $item['start_time']) ?> - <?= date('Y/m/d H:i', $item['end_time']) ?></span>
        	</p>
        	
    	    <a href="<?= URL::site('auction/edit')?>?id=<?= $item['id'] ?>" class="btn btn-info btn-xs ajax-click">修改</a>&nbsp;&nbsp;
            <?php if ($item['status']=='1'):?>
            <a href="<?= URL::site('article/close?id='.$item['id']);?>" class="btn btn-info btn-xs ajax-update">关闭</a>
            <?php else:?>
            <a href="<?= URL::site('article/open?id='.$item['id']);?>" class="btn btn-danger btn-xs ajax-update">开启</a>
            <?php endif;?>
        </div>
    </li>
<?php endforeach; ?>
</ul>

<?= $pager ?>
