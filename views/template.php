<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>好车无忧管理后台</title>
<?= HTML::style('media/bootstrap/css/bootstrap.min.css')?>
<?= HTML::style('media/font-awesome/css/font-awesome.min.css')?>
<?= HTML::style('media/css/AdminLTE.min.css')?>
<?= HTML::style('media/css/skins/skin-blue.min.css')?>
<style>
@media (max-width: 767px){
.skin-blue .main-header .navbar .dropdown-menu li a{color: #555}
.skin-blue .main-header .navbar .dropdown-menu li a:hover{color: #fff}
}
</style>

<?= HTML::script('media/js/jquery.min.js')?>
<?= HTML::script('media/bootstrap/js/bootstrap.min.js')?>
<?= HTML::script('media/js/highcharts.js')?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <a href="<?= URL::site()?>" class="logo ajax-click">
      <span class="logo-mini"><i class="glyphicon glyphicon-home"></i></span>
      <span class="logo-lg"><i class="glyphicon glyphicon-home"></i>&nbsp;好车无忧</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
		    <li class="dropdown">
		        <a href="#" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i>&nbsp;<?= $user['username']?><span class="caret"></span></a>
                <ul class="dropdown-menu">
			        <li><a href="<?= URL::site('admin/password')?>" class="ajax-modal-sm">&nbsp;修改密码</a></li>
			        <li><a href="<?= URL::site('admin/logout')?>">&nbsp;退出</a></li>
                </ul>
            </li>
		</ul>
      </div>
    </nav>
  </header>
  
  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
	    <?php foreach ($menu as $name=>$items):?>
		<li class="treeview">
		    <a href="#">
		        <i class="fa fa-circle-o text-yellow"></i>
		        <span><?= $name?></span>
		        <i class="fa fa-angle-left pull-right"></i>
		    </a>
		    <ul class="treeview-menu">
			    <?php foreach ($items as $sub_name=>$url):?>
				<li class="<?php if($uri==$url):?>curr<?php endif;?>">
				    <a class="ajax-click" href="<?= URL::site($url)?>"><i class="fa fa-circle-o"></i> <?= $sub_name?></a>
				</li>
			    <?php endforeach;?>
		    </ul>
		</li>
	    <?php endforeach;?>
      </ul>
    </section>
  </aside>
  
  <div class="content-wrapper" style="background: #fff">
    <section class="content" id="content">
    <?= $content?>
    </section>
  </div>
</div>
  
<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<?= HTML::script('media/js/app.min.js')?>
<script>
$(function(){
	$('.treeview-menu li.curr').parents('.treeview').attr('class', 'treeview active');
	$(document).on('click', '.treeview-menu .ajax-click', function() {
		$('body').removeClass('sidebar-open');
	});
	
	var currentState = {
        url: document.location.href,
        title: document.title,
        html: $("#content").html()
    };
    var modal_close_history_back = true;
    window.addEventListener("popstate",function(event) {
    	/*console.log(history.state);
    	var currentState = history.state;
        document.title = currentState.title;
        $("#content").html(currentState.html);*/
        if(event && event.state) {
            console.log('111111');
            document.title = event.state.title;
            $("#content").html(event.state.html);
        } else{
            console.log('222222');
            document.title = currentState.title;
            $("#content").html(currentState.html);
        }
    });
    
	$(document).on('click', '.ajax-modal, .ajax-modal-sm, .ajax-modal-lg', function(){
		/*var t = $(this);
		var url = t.attr('href');
		if (url.split('#')[0].length) {
			pushState(url);
		}
		return false;
		*/
		var t = $(this);
	    var m = $('.modal').eq(0);
	    var d = m.find('.modal-dialog');
	    d.removeClass('modal-sm');
	    d.removeClass('modal-lg');
		if (t.hasClass('ajax-modal-sm')) {
			d.addClass('modal-sm');
    	} else if (t.hasClass('ajax-modal-lg')) {
			d.addClass('modal-lg');
    	}
    	
		var url = this.href;
		if (url != location.href) {
			$.get(url, function(res) {
				m.find('.modal-body').html(res);
				m.modal('show');
				modal_close_history_back = true;
				var state = {
	                url: url,
	                title: document.title,
	                html: res
	            };
	            history.pushState(state,null,url);
			});
		}
		return false;
	});
	$('.modal').on('show.bs.modal', function (e) {
		var t = $(this);
		var page_title = t.find('.page-header');
        t.find('.modal-title').html(page_title.text());
        t.find('form').attr('class', 'ajax-submit');
        page_title.hide();

        currentState.html = $('#content').html();
	});
	$('.modal').on('hidden.bs.modal', function (e) {
		if (modal_close_history_back) {
		    history.back();
		} else {
			return false;
		}
	});

	$(document).on('click', '.ajax-click, .pagination>li>a', function(){
		var t = $(this);
		var url = this.href;
		if (url != location.href) {
			pushState(url);
		}
		return false;
	});
	
	$(document).on('click', '.ajax-del, .ajax-update', function() {
		var t = $(this);
		var url = this.href;
		if (url != location.href) {
    		$.get(url, function(res) {
    			if (res.code == '302') {
        			replaceState(res.url);
    			}
    		});
		}
		return false;
	});
	
	$(document).on('submit', '.ajax-submit', function() {
		var t = $(this);
		var url = t.attr('action') || location.href;
		var type = t.attr('method');
		$.ajax({
            type: type,
            url: url,
            data: t.serialize(),
            success: function(res) {
        		console.log(res);
    			//var res = eval('('+res+')');
    			if (res.code == '302') {
    				pushState(res.url);
    				modal_close_history_back = false;
    				$('.modal').modal('hide');
    			} else {
    				$('#content').html(res);
    				var state = {
		                url: url,
		                title: document.title,
		                html: res
		            };
		            history.pushState(state,null,url);
    			}
            }
		});
		return false;
	});
	
	function pushState(url){
		$.get(url, function(res) {
			$('#content').html(res);
			var state = {
                url: url,
                title: document.title,
                html: res
            };
            history.pushState(state,null,url);
		});
	}
	
	function replaceState(url){
		$.get(url, function(res) {
			$('#content').html(res);
			var state = {
                url: url,
                title: document.title,
                html: res
            };
            history.replaceState(state,null,url);
		});
	}
});
</script>

</body>
</html>
