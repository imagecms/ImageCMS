<div class="contain-cycle">
    <div class="cycle container">
        <ul>
            {foreach $banners as $banner}
                <li>
                    {if trim($banner.url)}
                        <a href="{site_url($banner.url)}">
                            <img src="{echo $banner['photo']}" alt="{$banner.name}"/>
                        </a>
                    {else:}
                        <span>
                            <img src="{echo $banner['photo']}" alt="{$banner.name}"/>
                        </span>
                        {/if}
                </li>
            {/foreach}
        </ul>
        <div class="pager p_r">

        </div>
        <div id="prev_slide"></div>
        <div id="next_slide"></div> 
    </div>
</div>