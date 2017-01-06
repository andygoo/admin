<h3 class="page-header">demo tree</h3>

<?= HTML::style('media/jstree/themes/default/style.min.css')?>
<?= HTML::script('media/jstree/jstree.min.js')?>


<div class="row">
    <div class="col-sm-3">
        <!-- <div id="ttt">
          <ul>
            <li>Root node
              <ul>
                <li>Child node 1</li>
                <li>Child node 2</li>
              </ul>
            </li>
          </ul>
        </div> -->
        
        <div id="ttt2">
        </div>
    </div>
    <div class="col-sm-9">
    <pre><code>ssss</code></pre>
    </div>
</div>

<script>
$(function() {
    $('#ttt').jstree({
        "plugins" : ["state",'wholerow']
    });
});
</script>

<script>
<?php 
function tree($path){
    $list = array();
    foreach(glob("$path/*") as $dir){
        if (is_dir($dir)) {
            $list[] = array(
                //'id' => basename($dir),
                'text' => basename($dir),
                'children' => tree($dir),
            );
        } else {
            $list[] = array(
                //'id' => basename($dir),
                'text' => basename($dir),
                'icon' => 'jstree-file',
            );
        }
    }
    return $list;
}
$path = SYSPATH;
$ret = array(
    'text' => basename($path),
    'children' => tree($path),
);
echo 'var data=' . json_encode($ret) . ';';
?>
$(function() {
    $('#ttt2').jstree({
    	'core' : {
    	    'data' : data
    	},
        "plugins" : ["state",'wholerow']
    });
});
</script>
