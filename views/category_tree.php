<h3 class="page-header">类别列表</h3>

<style>
#kodoc-topics ul{ list-style-type:none; margin: 0; padding: 0;}
#kodoc-topics ul li { margin:0; padding: 0; margin-left: 1em;}
#kodoc-topics ul li a { display: block; padding: 0; margin: 0; }
#kodoc-topics ul li.active { font-weight: bold; }
#kodoc-topics span { display: block; padding: 0; margin: 0; cursor: pointer; float:left}
#kodoc-topics span.toggle { display: block; float: left; width: 1em; padding-right: 0.4em; margin-left: -1.4em; text-align: center; }
</style>

<?php 
function tree($items) {
    echo '<ul>';
    foreach ($items as $item) {
        $url = URL::site('category/edit?id='.$item['id']);
        echo '<li><span>'.$item['name'].'</span> <a href="'.$url.'">修改</a>';
        if (isset($item['children']) && is_array($item['children'])) {
            tree($item['children']);
        }
        echo '</li>';
    }
    echo '</ul>';
}

?>

<div id="kodoc-topics">
<?php tree($cat_tree);?>
</div>

<script>
$(function() {
	$('#kodoc-topics li:has(li)').each(function() {
		var t = $(this);
		var toggle = $('<span class="toggle"></span>');
		var menu = t.find('>ul');
		if(!t.is(':has(li.active)')) {
			menu.hide();
		}
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
});
</script>

