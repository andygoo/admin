
<h3 class="page-header">拍品列表 
<a href="<?= URL::site('auction/add');?>" class="ajax-click">+</a>
</h3>

<ul class="media-list">
<?php foreach($list as $item): ?>
    <li class="media">
        <div class="media-left">
    	    <?php $pics = json_decode($item['pic'], true); $pic = $pics[0];?>
            <?php if (strpos($pic, '://') !== false):?>
                <?= HTML::image($pic.'?imageView2/2/w/160/h/120', array('width'=>160)) ?>
            <?php else:?>
                <?= HTML::image('/imagefly/w200-h150-c/' . $pic, array('width'=>160)) ?>
            <?php endif;?>
        </div>
        <div class="media-body">
        	<h4 class="media-heading"><a href="#"><?= date('Y/m/d H:i', $item['start_time']) ?>-<?= date('H:i', $item['end_time']) ?></a></h4>
        	<div class="text-muted">起 <?= $item['start_price'] ?> 加 <?= $item['step_price'] ?> 底 <?= $item['reserve_price'] ?> 图 <?php echo count($pics)?></div>
        	
        	<p class="text-muted"><?= str_replace("\n", '，', $item['desc']) ?></p>
        	
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
