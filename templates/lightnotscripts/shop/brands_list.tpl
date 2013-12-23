<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-brand-list">
    <div class="container">
        <div class="f-s_0 title-brand without-crumbs">
            <div class="frame-title">
                <h1 class="d_i title">{lang('Все бренды магазина','newLevel')}</h1>
            </div>
        </div>
        <ul class="items items-brand-list">
            <li>
                {foreach $alphabet as $key => $char}
                    {if $model[$char] != null}
                        {if $counter >= $iteration-1}
                            {echo '</li>'}
                            {echo '<li>'}
                            {$counter=0}
                        {/if}
                        <a href="#{$char}">
                            {$char}
                        </a>

                        <ul>
                            {foreach $model[$char] as $m}
                                <li>
                                    {if $counter >= $iteration}
                                        {echo '</li></ul>'}
                                        {echo '<li><ul>'}
                                        {$counter=0}
                                    {/if}
                                    <a href="{shop_url('brand/'.$m[url])}" title="{echo $m[name]}">
                                        {echo $m[name]}
                                    </a>
                                </li>
                                {$counter++}
                            {/foreach}
                        </ul>
                    {/if}
                {/foreach}
            </li>
        </ul>
    </div>
</div>