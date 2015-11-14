<?php 

function option($items, $cat_id, $level=0) {
    foreach ($items as $item) {
        $selected = ($item['id']==$cat_id) ? 'selected' : '';
        echo '<option value="'.$item['id'].'" '.$selected.'>';
        echo str_repeat('├─', $level).$item['name'];
        if (isset($item['children']) && is_array($item['children'])) {
            option($item['children'], $cat_id, $level+1);
        }
        echo '</option>';
    }
}
?>

<h3 class="page-header">文章列表 <small>
<a href="<?= URL::site('article/add');?>">
<i class="glyphicon glyphicon-plus"></i></a></small>
</h3>

<form class="form-inline" method="get">
    <div class="form-group">
        <select class="form-control" name="cid">
			<option value="">选择分类</option>
		    <?php option($cat_tree, Arr::get($_GET, 'cid'));?>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" name="status">
			<option value="">选择状态</option>
			<option value="open" <?php if(Arr::get($_GET, 'status')=='open'):?>selected<?php endif;?>>已发布</option>
			<option value="close" <?php if(Arr::get($_GET, 'status')=='close'):?>selected<?php endif;?>>已关闭</option>
        </select>
    </div>
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" name="title" value="<?php echo Arr::get($_GET, 'title')?>" placeholder="">
            <span class="input-group-btn">
                <button class="btn btn-info" type="submit">查找</button>
            </span>
        </div>
     </div>
</form>
<br>

<ul class="media-list">
<?php foreach($list as $item): ?>
    <li class="media">
        <div class="media-left">
            <?php if (strpos($item['pic'], '://') !== false):?>
            <?= HTML::image($item['pic'].'?imageView2/2/w/160/h/120', array('width'=>160)) ?>
            <?php else:?>
            <?= HTML::image('/imagefly/w200-h150-c/' . $item['pic'], array('width'=>160)) ?>
            <?php endif;?>
        </div>
        <div class="media-body">
            <h4 class="media-heading"><a href="http://haoche.com<?= URL::site('article?id='.$item['id'])?>" target="_blank"><?= $item['title'] ?></a></h4>
            <div class="text-muted"><?= date('Y-m-d H:i:s', $item['add_time']) ?>  &bull; <?= $item['cat_name'] ?></div>
            <p class="text-muted"><?= Text::limit_chars($item['brief'],80) ?></p>
            
            <?php if ($item['status']=='open'):?>
            <a href="<?= URL::site('article/close?id='.$item['id']);?>" class="btn btn-info btn-xs">关闭</a>
            <?php else:?>
            <a href="<?= URL::site('article/open?id='.$item['id']);?>" class="btn btn-danger btn-xs">发布</a>
            <?php endif;?>
            
            <?php if ($item['featured']):?>
            <a href="#<?= URL::site('article/disable?id='.$item['id']);?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-star"></i> 取消</a>
            <?php else:?>
            <a href="#<?= URL::site('article/enable?id='.$item['id']);?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-star-empty"></i> 推荐</a>
            <?php endif;?>
            
    	    <a href="<?= URL::site('article/edit')?>?id=<?= $item['id'] ?>" class="btn btn-info btn-xs">修改</a>
    		<a href="<?= URL::site('article/del')?>?id=<?= $item['id'] ?>" class="btn btn-info btn-xs" onclick="return confirm('确定删除这条记录吗？')">删除</a>
        </div>
    </li>
<?php endforeach; ?>
</ul>

<?= $pager ?>
