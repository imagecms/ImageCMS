<div class="frame-crumbs">
    <div class="container">
        {myCrumbs($model->id, " / ")}
    </div>
</div>
<div class="frame-inside">
    <div class="container">
        <div class="right-catalog clearfix">
            <h1>{echo $model->name}</h1>

            {if count($banners = getBannersCat($limit = 3, $model->id)) > 0}
                <div class="catalog-baner clearfix">
                    {foreach $banners as $banner}
                        <a href="{echo $banner->getUrl()}">
                            <img src="/uploads/shop/banners/{echo $banner->getImage()}" alt="{echo ShopCore::encode($banner->getName())}" class="f_r"/>
                        </a>
                    {/foreach}
                </div>
            {/if}

            {$categories = getCategories($model->id)}
            <ul class="items-sub-category">
                {foreach $categories as $c}
                    <li>
                        <a href="{shop_url('category/' . $c.full_path)}">
                            {if $c.image}
                                <span class="photo-block">
                                    <span class="helper"></span>
                                    <img src="{$c.image}" alt="{echo $c.name}"/>
                                </span>
                            {/if}
                            <span class="title">{echo $c.name}</span>
                        </a>
                        {$subcategories = getCategories($c.id)}
                        {if count($subcategories) > 0}
                            <ul>
                                {foreach $subcategories as $sub}
                                    <li>
                                        <a href="{shop_url('category/' . $sub.full_path)}">{echo $sub.name}</a>
                                    </li>
                                {/foreach}
                            </ul>
                        {/if}
                    </li>
                {/foreach}
            </ul>
        </div>
        <div class="left-catalog">
            {if $model->parent_id == 0}
                {$managers = getMennager($model->id)}
            {else:}
                {$managers = getMennager($model->parent_id)}
            {/if}
            {foreach $managers as $mn}
                {$mn = $CI->load->module('cfcm')->connect_fields($mn, 'page')}
                <div class="frame-manager shadow-w_220">

                    {if trim($mn[field_photo]) != ""}
                        <div class="photo-block">
                            <span class="helper"></span>
                            <img src="{echo $mn[field_photo]}" alt='{$mn.title}'/>
                        </div>
                    {/if}
                    {$mn[prev_text]}
                </div>
            {/foreach}
        </div>

    </div>
</div>
{if trim($model->description) != ""}
    <div class="frame-seo-text">
        <div class="container">
            <div class="text seo-text">
                {echo trim($model->description)}
            </div>
        </div>
    </div>
{/if}