{if $is_logged_in}
    <li class="login"><a href="{shop_url('profile')}" rel="nofollow" class="js gray">Личный кабинет</a></li>
	<li > <a href="/auth/logout" rel="nofollow" class="js gray">Выход</a </li>
{else:}
<!--    <li class="login"><a href="{site_url('auth')}" rel="nofollow" class="js gray">Вход в магазин</a></li>-->
<li class="login"><a href="#dialog1" rel="nofollow" class="js gray" name="modal">Вход в магазин</a></li>
<div id="boxes">
<div id="dialog1" class="window">
	<div class="fancy enter_reg">
 <ul>
                <li class="enter"><a href="#enter">Вход</a></li> 
                <li class="reg"><a href="#reg">Регистрация</a></li> 
            </ul>
			<form action="/auth/login" method="post" class="form" id="enter">
                <label>
                    Электронная почта
					<input type="text" id="username" size="30" name="username" value="Ваш логин" onfocus="if(this.value=='Ваш логин') this.value='';" onblur="if(this.value=='') this.value='Ваш логин';" />
                </label>
                <label>
                    Пароль
				<input type="password" size="30" name="password" id="password" value="{lang('lang_password')}" onfocus="if(this.value=='{lang('lang_password')}') this.value='';" onblur="if(this.value=='') this.value='{lang('lang_password')}';"/>
				</label>
					<div class="field">
			<label><input type="checkbox" name="remember" value="1" id="remember" /> {lang('lang_remember_me')}</label>
		</div>
                <div class="p-t_19 clearfix">
		          <li class="rpass"><a href="#rpass" >Забыли пароль?</a> </li>
               <div class="f_r buttons button_middle_blue">
						<input type="submit" id="submit" class="submit" value="{lang('lang_submit')}" />
                    </div>
                </div>
		<div class="clear"></div>
{form_csrf()}
            </form>
		
		 <form method="post" action="" id="rpass">
                <label>
                    Электронный адрес или Логин 
                    <input type="text"/>
                </label>
            
                <div class="p-t_19 t-a_c">
                    <div class="buttons button_middle_blue">
                        <input type="submit" value="Востановить">
                    </div>
                </div>
			 
           </form>
		
    {form_csrf()}
		</form>

		 <form method="post" action="/auth/register" id="reg" class="form" >
                <label>
                    Ваше имя
					<input type="text" size="30" name="userInfo[fullName]" value="Имя" onfocus="if(this.value=='Имя') this.value='';" onblur="if(this.value=='') this.value='Имя';" />
                </label>
                <label>
                    Электронный адрес
				<input type="text" size="30" name="email" value="email" onfocus="if(this.value=='email') this.value='';" onblur="if(this.value=='') this.value='email';" />
                </label>
                <label>
                    Пароль
<input type="password" size="30" name="password" id="password" value="password" onfocus="if(this.value=='password') this.value='';" onblur="if(this.value=='') this.value='{lang('lang_password')}';"/>
                </label>
                <label>
                    Повторите пароль
    <input type="password" size="30" name="confirm_password" id="confirm_password" value="password" onfocus="if(this.value=='password') this.value='';" onblur="if(this.value=='') this.value='{lang('lang_password')}';"/>
                </label>
          <div class="p-t_19 t-a_c">
                    <div class="buttons button_middle_blue">
                        <input type="submit" value="Зарегистрироваться">
                    </div>
                </div>
			 <div class="clear"></div>
	 {form_csrf()}
     </form>
			</div>
</div>
 <div id="mask"></div>
</div>
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


{/if}
