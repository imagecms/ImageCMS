{if count($brands) > 0}
<div class="carousel_js products-carousel frame-brands">
    <div class="container frame-title">
        <div class="title_h1"><span>{$title}</span></div>
    </div>
    <div class="container">
        <div class="frame-brands-carousel">
            <div class="content-carousel">
                <ul class="items items-brands">
                    {foreach $brands as $brand}
                    <li>
                        <a href="{shop_url($brand.full_url)}" class="frame-photo-title">
                            <span class="photo-block">
                                <span class="helper"></span>
                                <img src="{media_url($brand.img_fullpath)}" title="{$brand.name}" alt="{$brand.name}"/>
                            </span>
                        </a>
                    </li>
                    {/foreach}
                </ul>
                <button type="button" class="prev arrow">
                    <span class="icon_arrow_p"></span>
                </button>
                <button type="button" class="next arrow">
                    <span class="icon_arrow_n"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="container">
        <span class="show-all-brands show-all-default">
            <a href="{shop_url('brand/')}" class="t-d_n f-s_0"><span class="icon-arrow"></span><span class="text-el">Смотреть все</span></a>
        </span>
    </div>
</div>
{/if}