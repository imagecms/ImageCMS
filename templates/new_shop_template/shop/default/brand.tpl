{# Variables
/**
* @brand.tpl - template for displaying shop brand page
* Variables
*   $products: (object) instance of SProduct
*       $product->firstVariant: variable which contains the first variant of product
*       $product->getStock(): method which returns product availability 
*       $product->url(): method which return product url
*       $product->name(): method which return product name
*       $product->getmainimage(): method which return product main image
*       $product->getId(): method which return product id
*        
*   $pagination: variale which contains HTML code of page pagination
*
*   $totalProducts: variale which contains total count of products in brand category
*
*   $model: (object) instance of SBrands
*/
#}

{$Comments = $CI->load->module('comments')->init($products)}
<article>
    <div class="row">
        {include_tpl('filter')}
        <div class="span9 right">
            <h1 class="d_i">{echo ShopCore::encode($model->getName())}</h1>
                <span class="c_97">
                    {$totalProducts}
                </span>
            <div class="clearfix t-a_c frame_func_catalog">
                <div class="f_l">
                    <span class="v-a_m">Фильтровать по:</span>
                    <div class="lineForm w_170">
                        <select id="sort" name="order">
                            <option value="" {if !ShopCore::$_GET['order']}selected="selected"{/if}>-Нет-</option>
                            <option value="rating" {if ShopCore::$_GET['order']=='rating'}selected="selected"{/if}>{lang('s_po')} {lang('s_rating')}</option>
                            <option value="price" {if ShopCore::$_GET['order']=='price'}selected="selected"{/if}>{lang('s_dewevye')}</option>
                            <option value="price_desc" {if ShopCore::$_GET['order']=='price_desc'}selected="selected"{/if} >{lang('s_dor')}</option>
                            <option value="hit" {if ShopCore::$_GET['order']=='hit'}selected="selected"{/if}>{lang('s_popular')}</option>
                            <option value="hot" {if ShopCore::$_GET['order']=='hot'}selected="selected"{/if}>{lang('s_new')}</option>
                            <option value="action" {if ShopCore::$_GET['order']=='action'}selected="selected"{/if}>{lang('s_action')}</option>
                        </select>
                    </div>
                </div>
                <div class="f_r">
                    <span class="v-a_m">Товаров на странице:</span>
                    <div class="lineForm w_70">
                        <select class="sort" id="sort2" name="order2">
                            <option value="12" {if ShopCore::$_GET['user_per_page']=='12'}selected="selected"{/if} >12</option>
                            <option value="24" {if ShopCore::$_GET['user_per_page']=='24'}selected="selected"{/if} >24</option>
                            <option value="36" {if ShopCore::$_GET['user_per_page']=='36'}selected="selected"{/if} >36</option>
                        </select>
                    </div>
                </div>
                <div class="groupButton list_pic_btn" data-toggle="buttons-radio">
                    <button type="button" class="btn active"><span class="icon-cat_pic"></span>Картинками</button>
                    <button type="button" class="btn"><span class="icon-cat_list"></span>Списком</button>
                </div>
            </div>
            {if str_replace(' ', '', $model->getDescription()) != ''}
                <div class="grey-b_r-bord">
                    <figure class="f_l m-t_10 w_150">
                        <img src="/uploads/shop/brands/{echo $model->getImage()}"/>
                    </figure>
                    <p>{echo $model->getDescription()}</p>
                </div>
            {/if}
            <ul class="items items_catalog" data-radio-frame>
                <!-- Start of rendering produts list   -->
                {foreach $products as $product}
                    <li class="span3{if $product->getFirstVariant()->getStock() == 0} not-avail{/if}">
                        <div class="description">
                            <div class="frame_response">
                                <!--    Star reiting    -->
                                <div class="star">
                                    <img src="/templates/new_shop_template/shop/default/images/temp/STAR.png"/>
                                </div>
                                <!--    Star reiting    -->
                                <a href="{shop_url('product/'.$product->url.'#cc')}" class="count_response">                                    
                                    {echo $Comments[$product->getId()]}
                                </a>
                            </div>
                            <a href="{shop_url('product/' . $product->geturl())}">{echo ShopCore::encode($product->getname())}</a>
                            <div class="price price_f-s_16">
                                <span class="f-w_b">
                                    {echo $product->firstVariant->toCurrency()}
                                </span> 
                                {$CS}&nbsp;&nbsp;
                            </div>
                            <button class="btn btn_buy" type="button" 
                                    data-prodid="{echo $product->getId()}" 
                                    data-varid="{echo $product->firstVariant->getId()}"
                                    data-price="{echo $product->firstVariant->toCurrency()}"
                                    data-name="{echo ShopCore::encode($product->firstVariant->getName())}">
                                {lang('s_buy')}
                            </button>
                            <div class="d_i-b">
                                <button class="btn btn_small_p" type="button" title="добавить в список сравнений"><span class="icon-comprasion_2"></span></button>
                                <button class="btn btn_small_p" type="button" title="добавить в список желаний"><span class="icon-wish_2"></span></button>
                            </div>
                        </div>
                        <a href="{shop_url('product/' . $product->getUrl())}" class="photo">
                            <span class="helper"></span>
                            <figure>
                                <img src="{productImageUrl($product->getmainimage())}" alt="{echo ShopCore::encode($product->getName())} - {echo $product->getid()}"/>
                            </figure>
                        </a>
                    </li>
                {/foreach}
                <!--  End of rendering produts list   -->
            </ul>
            <!--    Pagination    -->
            {$pagination}
            <!--    Pagination    -->
        </div>
    </div>
</article>