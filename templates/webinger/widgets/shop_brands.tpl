<div class="carusel_frame brand box_title carousel_js">
    <div class="carusel clearfix">
        <ul>
            {foreach $brands as $brand}
                <li>
                    <a href="{shop_url($brand.full_url)}">
                        <img src="{media_url($brand.img_fullpath)}" title="{$brand.name}" />
                    </a>
                </li>
            {/foreach}
        </ul>
    </div>
    <button class="prev"></button>
    <button class="next"></button>
</div>