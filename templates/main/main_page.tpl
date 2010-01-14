        <h1>Приветствуем на сайте</h1>
        <div class="welcome">
        	<img src="{$THEME}/images/rightrobot.png" style="float:left; margin:0px 7px 0px 0px"/>
        	<div class="welcome_bg1"><div class="welcome_bg2">Приветствуем на сайте магазина, где в дальнейшем можно будет заказать и купить любые модели роботов массового производства. Пока же мы предлагаем известные модели проверенных, бюджетных и надежных роботов-пылесосов, роботов, имитирующих животных, и еще некоторые наименования робототехнических товаров, а также необычные электронные hi-tech подарки и сувениры.</div></div>
        </div><!-- welcome END -->
        
        
            {widget('latest_news')}
        
         <h1>Последние фото</h1>
         {$latest_images = gallery_latest_images(3)}
         <div class="gallery">
         {foreach $latest_images as $i}
         	<div class="photo"><a href="{site_url($i.url)}"><img width="180" src="{site_url($i.file_path)}"/></a></div>
         {/foreach}
         </div> 

         <h1>Новые товары</h1>
         <div class="hot">
         <!-- Выборка страниц из категории 41, лимит 3 -->
         {foreach category_pages(41, 3) as $page}
         {$fields = page_fields_extended($page.id)}
         	<div class="robot1">
            	<h4><a href="{site_url($page.full_url)}">{$page.title}</a></h4>
            	<div class="hotimage">
                    <a href="{site_url($page.full_url)}"><img src="{media_url($fields.image.field_data)}"/></a> 
                </div>
                <div class="hot_info">
                	<div class="price"><p><span>{$fields.price.field_data}$</span></p></div>

                    <form action="{site_url('simple_cart/add_item')}" method="POST" name="order_form_{$page.id}">
                        <div class="add_to_cart"><a href="javascript:document.forms.order_form_{$page.id}.submit();">В корзину</a></div>
                    <input type="hidden" name="redirect" value="{uri_string()}" />
                    <input type="hidden" name="item_id" value="{$page.id}" />
                    {form_csrf()}
                    </form> 

                </div>
            </div>
         {/foreach}
         </div> <!-- hot END -->
