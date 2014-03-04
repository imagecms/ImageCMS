<ul class="cycle"><!--remove class="cycle" if not cycle-->
    {foreach $banners as $banner}
        <li>
            {if trim($banner.url)}
                <a href="{site_url($banner.url)}"><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></a>
                {else:}
                <span><img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{ShopCore::encode($banner.name)}"/></span>
                {/if}
        </li>
    {/foreach}
</ul>
<div class="preloader"></div>
<div class="pager"></div>