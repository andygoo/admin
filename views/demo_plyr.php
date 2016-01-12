<h3 class="page-header">demo plyr</h3>


<?= HTML::style('media/plyr/plyr.css')?>

<div style="width: 600px;">
<div class="player">
    <video poster="http://admin.com/imagefly/w800/2015/11/24/14483387441203.jpg" controls crossorigin>
        <!-- Video files -->
        <source src="https://cdn.selz.com/plyr/1.0/movie.mp4" type="video/mp4">
        <source src="https://cdn.selz.com/plyr/1.0/movie.webm" type="video/webm">

        <!-- Text track file -->
        <track kind="captions" label="English" srclang="en" src="https://cdn.selz.com/plyr/1.0/example_captions_en.vtt" default>
    </video>
</div>
</div>

<script>
(function(d, p){
    var a = new XMLHttpRequest(),
        b = d.body;
    a.open("GET", p, true);
    a.send();
    a.onload = function(){
        var c = d.createElement("div");
        c.style.display = "none";
        c.innerHTML = a.responseText;
        b.insertBefore(c, b.childNodes[0]);
    }
})(document, "<?= URL::site('media/plyr/sprite.svg')?>");
</script>

<?= HTML::script('media/plyr/plyr.js')?>
<script>
plyr.setup({
	controls: ['play', 'current-time', 'duration', 'mute', 'volume', 'fullscreen']
});
</script>
