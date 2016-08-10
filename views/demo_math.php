<h3 class="page-header">demo math</h3>

<?php echo HTML::style('media/katex/katex.min.css')?>
<?php echo HTML::script('media/katex/katex.min.js')?>

<textarea id="demo-input" spellcheck="false" rows="5" cols="50">
f(x) = \int_{-\infty}^\infty
    \hat f(\xi)\,e^{2 \pi i \xi x}
    \,d\xi
</textarea>

<div id="demo-output"></div>
<hr>

<div class="tex" data-expr="\displaystyle \frac{1}{\Bigl(\sqrt{\phi \sqrt{5}}-\phi\Bigr) e^{\frac25 \pi}} = 1+\frac{e^{-2\pi}} {1+\frac{e^{-4\pi}} {1+\frac{e^{-6\pi}} {1+\frac{e^{-8\pi}} {1+\cdots} } } }"></div>
<hr>
<div class="tex" data-expr="\displaystyle \left( \sum_{k=1}^n a_k b_k \right)^2 \leq \left( \sum_{k=1}^n a_k^2 \right) \left( \sum_{k=1}^n b_k^2 \right)"></div>
<hr>
<div class="tex" data-expr="\displaystyle 1 +  \frac{q^2}{(1-q)}+\frac{q^6}{(1-q)(1-q^2)}+\cdots = \prod_{j=0}^{\infty}\frac{1}{(1-q^{5j+2})(1-q^{5j+3})}, \quad\quad \text{for }\lvert q\rvert<1."></div>
<hr>

<script>
var tex = document.getElementsByClassName("tex");
Array.prototype.forEach.call(tex, function(el) {
    katex.render(el.getAttribute("data-expr"), el);
});

var demoInput = document.getElementById("demo-input");
var demoOutput = document.getElementById("demo-output");
function doDemo() {
    katex.render("\\displaystyle{" + demoInput.value + "}", demoOutput);
}
demoInput.addEventListener("input", function() {
    doDemo();
});
doDemo();
</script>