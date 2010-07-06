<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$site_title}</title>
<meta name="description" content="{$site_description}" />
<meta name="keywords" content="{$site_keywords}" />
<meta name="generator" content="ImageCMS">

<link rel="stylesheet" type="text/css" href="{$THEME}/css/style.css" />
<link rel="stylesheet" type="text/css" href="{$THEME}/css/forms.css" />



</head>
<body>

	<div class="all">
    	
        <div class="topmenu">
            {load_menu('main_menu')}
        </div>
    	<div class="clear"></div>
        
		<div class="mbody">
        	<div class="mbody_top">
        		<div class="top_left_corner">
        			<div class="top_rigt_corner">
						
                        <div class="center">
                        
                            <div class="logo">
                                <a href="{site_url()}"><img src="{$THEME}/images/logo.gif" /></a>        
                            </div>
                            
                            <div class="top_image"></div>
                                           
                            <div class="content bg_line">
                                 
                                <div class="left">
                                	<div class="sidebar">
                                       <h2>Категории</h2> 
                                       
                                        {sub_category_list(51)}

                                        <div class="search">
                                        	<form action="{site_url('search')}" method="POST">
                                            	<input type="text" id="inputtext" name="text"/>
                                                <input type="image" src="{$THEME}/images/search.gif"/>
                                            {form_csrf()}
                                            </form>
                                        </div>
                                       
                                        <div class="separator"></div>
                                       
                                        <h2>Комментарии</h2> 
                                        
                                        {widget('latest_comments')}

                                        <div class="separator"></div>
                                       
                                        {if $is_logged_in}
                                        {lang('lang_logged_in_as')} {$username}. <a href="{site_url('auth/logout')}">{lang('lang_logout')}</a> 
                                        {else:}
                                            <a href="{site_url('auth/login')}">Вход</a><br/>
                                            <a href="{site_url('auth/register')}">Регистрация</a>
                                        {/if}

                                        <div class="separator"></div>

                                        <h2>Облако Тегов</h2> 
                                        
                                        {widget('tags_cloud')}
                                        
                                     </div><!-- sidebar END -->
                                     
                                </div><!-- left END -->

                                <div class="right">
                                    {$content}            
                                </div><!-- right END -->
                                
                                <div class="clear"></div>  
                                                 
                            </div><!-- content END --> 
                            
                        </div>    
                                        
					</div><!-- top_rigt_corner END -->                  
				</div> 
			</div>
		</div><!-- mbody END --> 
        
        <div class="bot_left_corner">
        	<div class="bot_right_corner">
        		<div class="mbody_bot">
                    <div class="mbody_bot_line"></div>
                </div>
        	</div>
        </div>
	<div class="copy" align="right">© 2010, this site is powered by <a href="http://www.imagecms.net">ImageCMS</a></div>
    <br />
	</div>
</body>
</html>
{echo $CI->template->run_info()}
