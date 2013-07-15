<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-brand-list">
    <div class="container">
        <div class="f-s_0 title-brand without-crumbs">
            <div class="frame-title">
                <h1 class="d_i title">Бренды магазина</h1>
            </div>
        </div>
        <ul class="items items-brand-list">
            {foreach $alphabet as $key => $char}
                {if $model[$char] != null}
                    <li>
                        <a href="#{$char}">
                            {$char}
                        </a>
                        <ul>
                            {foreach $model[$char] as $m}
                                <li>
                                    <a href="{shop_url('brand/'.$m[url])}" 
                                       title="{echo $m[name]}">
                                        {echo $m[name]}
                                    </a>
                                </li>
                            {/foreach}
                        </ul>
                    </li>
                {/if}
            {/foreach}
        </ul>
    </div>
</div>