{# Variables
# @var model
# @var jsCode
# @var products
# @var totalProducts
# @var brandsInCategory
# @var pagination
# @var cart_data
#}
<div class="content_head">
    {widget('path')}
    <div class="crumbs">
        <h1>{echo ShopCore::encode($category->getTitle())}</h1>
    </div>
    {if strstr($_SERVER["REQUEST_URI"],'?')}
        {$full_url = $_SERVER["REQUEST_URI"] . '&filtermobile=1'}
    {else:}
        {$full_url = $_SERVER["REQUEST_URI"] . '?filtermobile=1'}
    {/if}
    <a href="{echo $full_url}" class="check_filter h_f"><span class="helper"></span><span class="v-a_m"><span class="check_filter_ico icon"></span><span class="title">{lang('Подбор по параметрам','commerce_mobiles')}</span></span></a>
</div>
<ul class="catalog">
    {foreach $products as $product}
        <li>
            <a href="{mobile_url('product/' . $product->getUrl())}" class="top_frame_tov">
                <span class="figure">
                    <img src="{echo $product->firstVariant->getMediumPhoto()}"/>
                </span>
                <span class="descr">
                    <span class="title">{echo ShopCore::encode($product->name)}</span>
                    {if $product->firstVariant->name}
                        <span class="divider">/</span>
                        <span class="code_v">{lang('Вариант','commerce_mobiles')}: {echo $product->firstVariant->name}</span>
                    {/if}
                    {if $product->firstVariant->getNumber()}
                        <span class="divider">/</span>
                        <span class="code">{lang('Артикул','commerce_mobiles')}: {echo $product->firstVariant->getNumber()}</span>
                    {/if}
                    <span class="d_b price">{echo $product->firstVariant->toCurrency()} {$CS}</span>
                </span>
            </a>
        </li>
    {/foreach}
</ul>
{echo $pagination}