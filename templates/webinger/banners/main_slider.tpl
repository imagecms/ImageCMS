{if count($banners)}
    <div class="frame_baner">
        <ul class="cycle">
            {foreach $banners as $banner}
                <li>
                    {if trim($banner.url)}
                        <a href="{site_url($banner.url)}"><img src="{echo $banner['photo']}" alt="{ShopCore::encode($banner.name)}"/></a>
                        {else:}
                        <span><img src="{echo $banner['photo']}" alt="{ShopCore::encode($banner.name)}"/></span>
                        {/if}
                    <div class="description">
                        {echo $banner.name}
                        {echo $banner.description}
                    </div>
                </li>
            {/foreach}
        </ul>
        <div class="pager"></div>
        <button class="next" type="button"></button>
        <button class="prev" type="button"></button>
    </div>
{/if}