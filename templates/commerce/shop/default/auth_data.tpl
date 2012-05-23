{if $is_logged_in}
    <li class="login"><a href="{shop_url('profile')}" rel="nofollow" class="js gray">Личный кабинет</a></li>
	<li > <a href="{site_url('auth/logout')}" rel="nofollow" class="js gray">Выход</a </li>
{else:}
<li class="login"><a href="{site_url('auth')}" rel="nofollow" class="js gray loginAjax" >Вход в магазин</a></li>

{/*}
{literal}
	<script type="text/javascript">		

$(document).ready(function() {	
	$('a[name=modal]').click(function(e) {
	e.preventDefault();
	var id = $(this).attr('href');
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();
	$('#mask').css({'width':maskWidth,'height':maskHeight});
	
	$('#mask').fadeIn(100);	
	$('#mask').fadeTo("slow",0.3);	
	
	var winH = $(window).height();
	var winW = $(window).width();

	$(id).css('top',  winH/2-$(id).height()/2);
	$(id).css('left', winW/2-$(id).width()/2);
	
	$(id).fadeIn(200); 
	});
	$('.window .close').click(function (e) {
	e.preventDefault();
		$('#mask').hide();
		$('.window').hide();
	});		
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
     
        var winH = $(window).height();
        var winW = $(window).width();
  
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});

</script>
{/literal}
{*/}

{/if}
