<div class="slider">
    {foreach $banners as $banner}
        {if trim($banner['url'])}
            <a href="{echo $banner['url']}">
        {/if}
                <img src="{echo $banner['photo']}">
        {if trim($banner['url'])}
            </a>
        {/if}
    {/foreach}
</div>
