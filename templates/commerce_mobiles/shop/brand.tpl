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
    <div class="crumbs">
        <h1>{echo ShopCore::encode($model->getName())}</h1>
    </div>
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