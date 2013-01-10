{//var_dump($baners)}
{$hits = getcategoryHits($model->getId())}
<div xmlns:v="http://rdf.data-vocabulary.org/#" class="breadCrumbs crumbs">{renderCategoryPath($model)}</div>
<div class="socall">
    <div class="vksave">
        {literal}
        <script type="text/javascript"><!--
            document.write(VK.Share.button({url: "http://www.sportek.net/"},{type: "round", text: "Зберегти"}));
            --></script>{/literal}
    </div>
    <div class="fbrec">
        <div id="fb-root"></div>
        {literal}
        <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        {/literal}
        <div class="fb-like" data-href="http://www.sportek.net/" data-send="false" data-layout="button_count" data-width="200" data-show-faces="true" data-action="recommend"></div>
    </div>
</div>

<!--<img src="{media_url('uploads/temp_imgs/sportec_inside_1_1.jpg')}" class="action" />-->
<h1>{if $model->alter_desc}{echo $model->alter_desc}{else:}{echo ShopCore::encode($model->getName())}{/if}</h1>
{if $page_type == 'main'}
{literal}
$(document).ready(function(){
s-d_h = $('.site_description').height();
});
{/literal}
{elseif $CI->uri->segment(2) == 'category' && $model->description && !$_GET['per_page']}
<!--{echo $model->getId()}-->

{$class = to}
<div class="site_description text {if count($hits) > 0}action_hit{/if}"  {if count($hits) == 0}style="padding-top:40px;"{/if}>
     {echo $model->description}
</div>
{/if}
<form action ="{if $base_url}{shop_url('category/'.$base_url)}{/if}" method="get" class="filter_form">
    <div class="left_inside">
        {include_tpl('filter')}
    </div>
    <div class="good_desc">
        <div class="o_h">
            <div class="sort">
                <select name="order">
                    <option {if ShopCore::$_GET['order']=='name'}selected{/if} value="name">Название  A-Z</option>
                    <option {if ShopCore::$_GET['order']=='name_desc'}selected{/if} value="name_desc">Название Z-A</option>
                    <option {if ShopCore::$_GET['order']=='price'}selected{/if} value="price">Сначала дешевые</option>
                    <option {if ShopCore::$_GET['order']=='price_desc'}selected{/if} value="price_desc">Сначала дорогие</option>
                    <option {if ShopCore::$_GET['order']=='hit'}selected{/if} value="hit">Сначала хиты</option>
                    <option {if ShopCore::$_GET['order']=='hot'}selected{/if} value="hot">Сначала новинки</option>
                    <option {if ShopCore::$_GET['order']=='action'}selected{/if} value="action">Сначала акции</option>
                </select>
                <select name="user_per_page">
                    <option{if ShopCore::$_GET['user_per_page']=='12'} selected="selected"{/if} value="12">Выводить по 12 на страницу</option>
                    <option{if ShopCore::$_GET['user_per_page']=='24'} selected="selected"{/if} value="24">Выводить по 24 на страницу</option>
                </select>
            </div>
            <div class="results t-a_r">
                <ul>{$pagination}</ul>
            </div>
        </div>
        <ul class="wares">    
            {foreach $products as $p} 
            {$stock = 0}
            {foreach $p->getProductVariants() as $variant}
            {$stock += $variant->stock}
            {/foreach}
            <li {if $stock == 0}class="noInStock"{/if}>

                <a class="imgTitle" href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
                <div class="image"><a href="{shop_url('product/' . $p->getUrl())}"><img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" /></a></div>
                <div class="price_buy"><div class="block_price"><span class="price_product">{echo $p->firstVariant->toCurrency()}</span> <span class="grn">{$CS}</span></div>

                    {if (int)$p->old_price > (int)$p->firstVariant->price}
                    <div class="old_price"><span>
                            {echo $p->old_price} {$CS}</span>
                    </div>
                    {/if}

                    {/*}
                    {if array_search($p->id, $alreadyInCartArr) !== false}<a class="alreadyIn_small" href="{shop_url('cart')}">В корзине</a>
                    {else:}
                    {*/}
                    {if $stock == 0}
                    <a data-prodid="{echo $p->getId()}"  data-proname="{echo $p->getName()}"  data-varid="{echo $p->firstVariant->getId()}" class="report" href="#report">
                        <span>Сообщить o появлении</span>{else:}
                        <a href="{shop_url('product/' . $p->getUrl())}">Купить
                            {/if}</a>
                        {//if}</div>
                {if $p->getAction()}<div class="act"></div>{/if}
                {if $p->getHit()}<div class="hit"></div>{/if}
            </li>
            {/foreach}
            {if count($products) < 1}
            <div class="noResults">
                <h2>К сожалению по выбранных вами параметрах товаров не найдено</h2>
                <p>Измените пожалуйста параметры фильтрации или поищите товар в других категориях.</p>
            </div>
            {/if}
        </ul>
        {if count($products) > 0}
        <div class="results">
            <span class="f_l">Показано с {$pageFrom} по {$pageTo} из {$totalProducts} (всего страниц - {echo $countOfPage})</span>
            <div class="t-a_r">
                <ul>{$pagination}</ul>
            </div>
        </div>
        {/if}    
    </div>
</form>
<div style="display: none">
    <div id="report">
        <div class="products_list" id="collback_form">
            <div class="h1title">Сообщить о появлении</div>
            <form action="" method="post" class="new_user commentForm callback_form">
                <h2><span id="notifyProductVariantName"></span></h2>
                <dl>
                    <dt>Ваше имя:<span>*</span></dt>
                    <dd><input type="text" name="name" class="required" value="" /></dd>
                </dl>
                <dl>
                    <dt><label>Email:<span>*</span></label></dt>
                    <dd><input type="text" name="email" class="required email" value="" /></dd>
                </dl>
                <dl>
                    <dt><label>Мобильный телефон:<span>*</span></label></dt>
                    <dd><input class="required" type="text" name="phone" value=""/></dd>
                </dl>

                <dl>
                    <dt><label>Актуально до:<span>*</span></label></dt>
                    <dd>
                        <input class="required" id="datepicker" type="text" name="actual" value="" />
                    </dd>
                </dl>

                <dl>
                    <dt><label>Дополнительная информация:</label></dt>
                    <dd><textarea name="comment"></textarea></dd>
                </dl>
                <div class="button"><input type="submit" value="Отправить" /></div>
                <input type="hidden" id="fproductId" name="productId" value="" />
                <input type="hidden" id="variantIds" name="variantIds" value="" />


                {form_csrf()}
            </form>
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
$("#datepicker").datepicker();

</script>
{/literal}
