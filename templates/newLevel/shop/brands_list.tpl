<div class="frame-crumbs">
    {widget('path')}
</div>
<div class="frame-inside page-brand-list">
    <div class="container">
        <div class="f-s_0 title-brand without-crumbs">
            <div class="frame-title">
                <h1 class="d_i title">{lang('Store brands','newLevel')}</h1>
            </div>
        </div>
        <div class="columnBrand">
        {$counter=0;}
            {foreach $alphabet as $key => $char}
                {if $model[$char] != null}
                    {if $counter >= $iteration-1}
                        {echo '</div>'}
                        {echo '<div class="columnBrand">'}
                        {$counter=0}
                    {/if}
                    <div href="#{$char}" class="brandName" >
                        {$char}
                    </div>
                    {foreach $model[$char] as $m}
                        {if $counter >= $iteration}
                           {echo '</div>'}
                           {echo '<div class="columnBrand">'}
                           {$counter=0}
                        {/if}
                         <a href="{shop_url('brand/'.$m[url])}" title="{echo $m[name]}">
                                {echo $m[name]}
                        </a>
                        <br>
                    {$counter++}
                    {/foreach}
                {/if}
            {/foreach}
        </div>
    </div>
</div>