<ul class="nav nav-vertical">
    {foreach $brands as $brand}
    <li>
        <a href="{shop_url($brand.full_url)}" class="frame-photo-title">
            {$brand.name}
        </a>
    </li>
    {/foreach}
</ul>
