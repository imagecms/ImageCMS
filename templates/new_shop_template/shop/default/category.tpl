{# Variables
# @var category
# @var products
# @var totalProducts
# @var pagination
# @var pageNumber
#}

{$Comments = $CI->load->module('comments')->init($products)}
<article>
    {//Block for banners}
    {$banners = ShopCore::app()->SBannerHelper->getBannersCat(3,$model->id);}
    {if count($banners)}
        <div class="cycle center">
            <ul> 
                {foreach $banners as $banner}
                    <li>
                        <a href="{echo $banner->getUrl()}">
                            <img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="{echo ShopCore::encode($banner->getName())}" />
                        </a>
                    </li>
                {/foreach}
            </ul>
            <span class="nav"></span>
            <button class="prev"></button>
            <button class="next"></button>
        </div>
    {/if}

    {//Block for bread crumbs with a call of shop_helper function to create it according to category model}
    <div class="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
        {echo makeBreadCrumbs($category)}
    </div>

    {//main category page content}
    <div class="row">
        {//here filter tpl is including}
        {include_tpl('filter')}

        {//catalog container}
        <div class="span9 right">

            {//category title and products count output}
            <h1 class="d_i">{echo $category->getName()}</h1><span class="c_97">Найдено {echo $totalProducts} {echo SStringHelper::Pluralize($totalProducts, array("товар", "товара", "товаров"))}</span>
            <div class="clearfix t-a_c frame_func_catalog">

                {//sort block}
                <div class="f_l">
                    <span class="v-a_m">Сортировать по:</span>
                    <div class="lineForm w_170">
                        <select class="sort" id="sort" name="order">
                            <option selected="selected" value="1">по Рейтингу</option>
                            <option value="2">От дешевых к дорогим</option>
                            <option value="3">От дорогих к дешевым</option>
                            <option value="4">Популярные</option>
                            <option value="5">Новинки</option>
                            <option value="6">Акции</option>
                        </select>
                    </div>
                </div>

                {//products on page count}
                <div class="f_r">
                    <span class="v-a_m">Товаров на странице:</span>
                    <div class="lineForm w_70">
                        <select class="sort" id="sort2" name="user_per_page">
                            <option selected="selected" value="1">12</option>
                            <option value="2">24</option>
                            <option value="3">36</option>
                            <option value="4">48</option>
                        </select>
                    </div>
                </div>

                {//selecting product list type}
                <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                    <button type="button" class="btn active"><span class="icon-cat_pic"></span><span class="text-el">Картинками</span></button>
                    <button type="button" class="btn"><span class="icon-cat_list"></span><span class="text-el">Списком</span></button>
                </div>
            </div>

            {//displaying category description if page number is 1}
            {if $page_number == 1 && $category->getDescription() != ''}
                <div class="grey-b_r-bord">
                    <p><span style="font-weight:bold">{echo $category->getName()}</span> &mdash; {echo $category->getDescription()}</p>
                </div>
            {/if}

            {//rendering product list if products count more than 0}
            {if count($products)>0}

                {//product list container}
                <ul class="items items_catalog" data-radio-frame>

                    {//starts loop for array with products}
                    {foreach $products as $product}

                        {//product block}
                        {//check if product is in stock}
                        <li class="{if (int)$product->getallstock() == 0}not-avail {else:}in_cart {/if}span3">

                            {//product info block}
                            <div class="description">
                                <div class="frame_response">

                                    {//displaying product's rate}
                                    <div class="star">
                                        <img src="{$SHOP_THEME}images/temp/STAR.png"/>
                                    </div>

                                    {//displaying comments count}
                                    <a href="{shop_url('product/'.$product->url.'#cc')}" class="count_response">
                                        <span class="icon-comment"></span>
                                        {echo $Comments[$product->getId()]}
                                    </a>
                                </div>

                                {//displaying product name}
                                <a href="{shop_url('product/'.$product->getUrl())}">{echo $product->getName()}</a>

                                {//displaying products first variant price and currency symbol}
                                <div class="price price_f-s_16"><span class="f-w_b">{echo $product->firstVariant->getPrice()}</span> {$CS}&nbsp;&nbsp;<span class="second_cash"></span></div>

                                {//displaying buy button according to its availability in stock}

                                {if (int)$product->getallstock() == 0}

                                    {//displaying notify button}
                                    <button data-placement="bottom right" 
                                            data-place="noinherit" 
                                            data-duration="500" 
                                            data-effect-off="fadeOut" 
                                            data-effect-on="fadeIn" 
                                            data-drop=".drop-report"
                                            data-prodid="{echo $product->getId()}"
                                            type="button" 
                                            class="btn btn_not_avail">
                                        <span class="icon-but"></span>
                                        Сообщить о появлении
                                    </button>
                                {else:}

                                    {//displaying buy or in cart button}
                                    <button class="btn btn_buy" type="button" 
                                            data-prodid="{echo $product->getId()}" 
                                            data-varid="{echo $product->firstVariant->getId()}"
                                            data-price="{echo $product->firstVariant->getPrice()}"
                                            data-name="{echo $product->firstVariant->getName()}">
                                        Купить
                                    </button>
                                {/if}

                                <div class="d_i-b">

                                    {//to compare button}
                                    <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>

                                    {//to wish list button}
                                    <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                                </div>
                            </div>

                            {//displaying products main mod image}
                            <a href="{shop_url('product/'.$product->getUrl())}" class="photo">
                                <span class="helper"></span>
                                <figure>
                                    <img src="{productImageUrl($product->getMainModImage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getId()}"/>
                                </figure>
                            </a>

                            {//creating hot bubble for products image if product is hot}
                            {if $product->getHot()}
                                <span class="top_tovar nowelty">{lang('s_shot')}</span>
                            {/if}

                            {//creating hot bubble for products image if product is action}
                            {if $product->getAction()}
                                <span class="top_tovar promotion">{lang('s_saction')}</span>
                            {/if}

                            {//creating hot bubble for products image if product is hit}
                            {if $product->getHit()}
                                <span class="top_tovar discount">{lang('s_s_hit')}</span>
                            {/if}
                        </li>
                    {/foreach}
                </ul>
            {/if}

            {//pagination container}
            <div class="pagination">

                {//pagination variable from category.php controller}
                {$pagination}
            </div>
        </div>
    </div>
</article>
