<h3 class="page-header">类别列表
<a href="<?= URL::site('category/add');?>" class="ajax-modal-sm">+</a>
</h3>

<style>
#kodoc-topics ul{list-style-type:none; margin: 0; padding: 0;}
#kodoc-topics ul li {margin:0; padding: 0; margin-left: 1em;border-top: 1px solid #ddd}
#kodoc-topics span {display: inline-flex; padding: 10px 0; margin: 0; cursor: pointer;}
#kodoc-topics span.toggle {float: left; padding-right: 0.4em; margin-left: -1.4em;}
</style>

<?php 
function tree($items) {
    echo '<ul>';
    foreach ($items as $item) {
        $url1 = URL::site('category/edit?id='.$item['id']);
        $url2 = URL::site('category/add?pid='.$item['id']);
        
        echo '<li><span>'.$item['name'].'</span>';
        echo '<div class="pull-right" style="margin-top: 10px;_display: none">';
        echo '<a href="'.$url1.'" class="btn btn-info btn-xs ajax-click _ajax-modal-sm">修改</a>&nbsp;&nbsp;&nbsp;&nbsp;';
        echo '<a href="'.$url2.'" class="btn btn-info btn-xs ajax-click _ajax-modal-sm">+子类</a></div>';
        
        if (isset($item['children']) && is_array($item['children'])) {
            tree($item['children']);
        }
        echo '</li>';
    }
    echo '</ul>';
}

?>

<div id="kodoc-topics" style="max-width: 600px">
<?php tree($cat_tree);?>
</div>

<script>
$(function() {
	$('#kodoc-topics li:has(li)').each(function() {
		var t = $(this);
		var toggle = $('<span class="toggle"></span>');
		var menu = t.find('>ul');
		menu.hide();
	    toggle.click(function() {
			if(menu.is(':visible')) {
				menu.stop(true,true).slideUp('fast');
				toggle.html(' + ');
			} else {
				menu.stop(true,true).slideDown('fast');
				toggle.html(' – ');
			}
		});
		t.find('>span').click(function() {
			toggle.click();
		});
		toggle.html(menu.is(':visible') ? ' – ' : ' + ').prependTo(t);
	});

	$('#kodoc-topics li').hover(function(){
	    //$(this).find(">.pull-right").show();
    },function(){
    	//$(this).find(">.pull-right").hide();
    });
});
</script>

