
<?php foreach($list as $item): ?>
<div class="up-files">
    <img src="<?= URL::site('imagefly/w120-h90-c/'.$item['file_src'], true) ?>" o-src="<?= URL::site('imagefly/w800/'.$item['file_src'], true) ?>" class="img-thumbnail">
</div>
<?php endforeach; ?>

