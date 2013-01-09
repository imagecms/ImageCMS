{$hits = getcategoryHits($model->getId())}
<div xmlns:v="http://rdf.data-vocabulary.org/#" class="breadCrumbs crumbs">{renderCategoryPath($model)}</div>
<!--<img src="{media_url('uploads/temp_imgs/sportec_inside_1_1.jpg')}" class="action" />-->
<h1>{if $model->alter_desc}{echo $model->alter_desc}{else:}{echo ShopCore::encode($model->getName())}{/if}</h1>
   {if $page_type == 'main'}

            {elseif $CI->uri->segment(2) == 'category' && $model->description && !$_GET['per_page']}
                <!--{echo $model->getId()}-->
                {if $model->getId() == 60}
                    {$class = to800}
                {elseif $model->getId() == 101}
                    {$class = to590}
                {elseif $model->getId() == 67}
                    {$class = to325}
                {elseif $model->getId() == 61}
                    {$class = to310}
                {elseif $model->getId() == 68}
                    {$class = to460}
                {elseif $model->getId() == 99}
                    {$class = to280}
                {elseif $model->getId() == 89}
                    {$class = to460}
                {elseif $model->getId() == 88}
                    {$class = to390}
                {elseif $model->getId() == 118}
                    {$class = to375}
                {elseif $model->getId() == 95}
                    {$class = to460}
                {elseif $model->getId() == 117}
                    {$class = to420}
                {elseif $model->getId() == 116}
                    {$class = to460}
                {elseif $model->getId() == 72}
                    {$class = to460}                    
                {elseif $model->getId() == 63}
                    {$class = to325}                    
                {elseif $model->getId() == 58}
                    {$class = to460}
                {elseif $model->getId() == 66}
                    {$class = to375}
                {/if}                
                <div class="site_description text {if count($hits) > 0}action_hit{/if}"  {if count($hits) == 0}style="padding-top:40px;"{/if}>

                    {echo $model->description}
                </div>
            {/if}
{include_tpl('filter')}

<ul class="wares">    
    {foreach $products as $p} 
    

    
    <li {if $p->firstVariant->stock == 0}class="noInStock"{/if}>

        <a class="imgTitle" href="{shop_url('product/' . $p->getUrl())}">{echo ShopCore::encode($p->getName())}</a>
        <div class="image"><a href="{shop_url('product/' . $p->getUrl())}"><img src="{productImageUrl($p->getSmallImage())}" alt="{echo ShopCore::encode($p->getName())}" /></a></div>
        <div class="price_buy"><div class="block_price"><span class="price_product">{echo $p->firstVariant->toCurrency()}</span> <span class="grn">{$CS}</span></div>
            {/*}
            {if $p->old_price}
            <div class="old_price">
                    {echo $p->old_price} {$CS}              
            </div>
            {/if}
            {*/}
		
            {if array_search($p->id, $alreadyInCartArr) !== false}<a class="alreadyIn_small" href="{shop_url('cart')}">В корзине</a>
            {else:}{if $p->firstVariant->stock == 0}<a data-prodid="{echo $p->getId()}"  data-proname="{echo $p->getName()}"  data-varid="{echo $p->firstVariant->getId()}" class="report" href="#report"><span>Сообщить o появлении</span>{else:}<a href="{shop_url('product/' . $p->getUrl())}">Купить{/if}</a>
            {/if}</div>
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
    <span>Показано с {$pageFrom} по {$pageTo} из {$totalProducts} (всего страниц - {echo $countOfPage})</span>
    <div>
        <ul>{$pagination}</ul>
    </div>
</div>
{/if}    
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
            <dt><label>Мобильный телефон:</label></dt>
            <dd><input type="text" name="phone" value=""/></dd>
        </dl>
        {/*}
        <dl>
            <dt><label>Актуально до:</label></dt>
            <dd><input type="text" name="actual" value="" /></dd>
        </dl>
        {*/}
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