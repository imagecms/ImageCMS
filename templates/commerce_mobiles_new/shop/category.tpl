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
    <div class="crumbs">{renderCategoryPathNoSeo($category)}
        <h1>{echo ShopCore::encode($category->getTitle())}</h1>
    </div>
    <a href="{mobile_url('category/'.$category->getFullPath())}?filtermobile=1" class="check_filter h_f"><span class="helper"></span><span class="v-a_m"><span class="check_filter_ico icon"></span><span class="title">Подбор по параметрам</span></span></a>
</div>
<ul class="catalog">
    {foreach $products as $product}
    <li>
        {if count($product->getProductVariants()) > 1}
        <span class="top_frame_tov">
            <span class="figure"><img src="{productImageUrl($product->getMainModimage())}"/></span>
            <span class="descr">
                <span class="title">{echo ShopCore::encode($product->name)}</span>
                {if $product->firstVariant->name}
                <span class="code_v">
                    {lang('s_variant')}: {echo ShopCore::encode($product->firstVariant->name)}
                </span>
                {/if}
                {if $product->firstVariant->number}
                <span class="divider">/</span>
                <span class="code">{lang('s_article')}: {echo $product->firstVariant->number}</span>
                {/if}
                <span class="d_b price">{echo $product->firstVariant->toCurrency()} {$CS}</span>
            </span>
        </span>
        <ul>
            {foreach $product->getProductVariants() as $key => $p}
            {if $key > 0}
            <li>
                <span class="top_frame_tov">
                    <span class="figure"><img src="{productImageUrl($p->getMainModimage())}"/></span>
                    <span class="descr">
                        <span class="title">
                            {echo ShopCore::encode($product->name)}
                        </span>
                        {if $p->name}
                        <span class="code_v">
                            {lang('s_variant')}: {echo ShopCore::encode($p->name)}
                        </span>
                        {/if}
                        {if $p->number}
                        <span class="divider">/</span>
                        <span class="code">{lang('s_article')}: {echo $p->number}</span>
                        {/if}
                        <span class="d_b price">{echo $p->toCurrency()} {$CS}</span>
                    </span>
                </span>
            </li>
            {/if}
            {/foreach}
        </ul>
        <a href="{mobile_url('product/' . $product->getUrl())}" class="show_all_variant">{lang('s_show_products')} &#8594;</a>
        {else:}
        <a href="{mobile_url('product/' . $product->getUrl())}" class="top_frame_tov">
            <span class="figure"><img src="{productImageUrl($product->getMainModimage())}"/></span>
            <span class="descr">
                <span class="title">{echo ShopCore::encode($product->name)}</span>
                {if $product->firstVariant->name}
                <span class="code_v">{lang('s_variant')}: {echo $product->firstVariant->name}</span>
                {/if}
                {if $product->firstVariant->getNumber()}
                <span class="divider">/</span>
                <span class="code">{lang('s_article')}: {echo $product->firstVariant->getNumber()}</span>
                {/if}
                <span class="d_b price">{echo $product->firstVariant->toCurrency()} {$CS}</span>
            </span>
        </a>
        {/if}
    </li>
    {/foreach}
</ul>
{echo $pagination}