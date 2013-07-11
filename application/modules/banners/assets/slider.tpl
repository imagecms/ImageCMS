 <div class="frame-baner-catalog frame-baner">
    <section class="carousel_js baner container">
        <div class="content-carousel">
            <ul class="cycle">
                {foreach $banners as $banner}
                    <li>
                        {if trim($banner.url)}
                            <a href="{echo $banner['url']}">
                                <img data-src="{echo $banner['photo']}" alt="{echo $banner['name']}" />
                            </a>
                        {else:}
                            <span>
                                <img data-src="{echo $banner['photo']}" alt="{echo $banner['name']}" />
                            </span>
                        {/if}
                    </li>
                {/foreach}
            </ul>
            <span class="preloader-baner"></span>
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
