<div class="frame-baner-catalog frame-baner">
    <section class="carousel-js-css baner container resize cycleFrame">
        <div class="content-carousel">
            <ul class="cycle">
                {foreach $banners as $banner}
                    <li>
                        {if trim($banner.url)}
                            <a href="{echo $banner['url']}">
                                <img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{echo $banner['name']}"/>
                            </a>
                        {else:}
                            <span>
                                <img data-original="{echo $banner['photo']}" src="{$THEME}images/blank.gif" alt="{echo $banner['name']}"/>
                            </span>
                        {/if}
                    </li>
                {/foreach}
            </ul>
            <div class="preloader"></div>
            <div class="pager"></div>
        </div>
        <div class="group-button-carousel">
            <button type="button" class="prev arrow">
                <span class="icon_arrow_p"></span>
            </button>
            <button type="button" class="next arrow">
                <span class="icon_arrow_n"></span>
            </button>
        </div>
    </section>
</div>