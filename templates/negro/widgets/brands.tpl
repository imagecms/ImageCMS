<div class="carousel_js products-carousel">
    <div class="content-carousel container">
        <ul class="items-catalog">
                {foreach $brands as $brand}
                    <li>
                        <a href="{shop_url($brand.full_url)}">
                            <span class="helper"></span>
                            <img src="{media_url($brand.img_fullpath)}" title="{$brand.name}" alt="{$brand.name}"/>
                        </a>
                    </li>
                {/foreach}
            </ul>
            <button type="button" class="prev arrow"></button>
            <button type="button" class="next arrow"></button>
        </div>
    </div>
</div>