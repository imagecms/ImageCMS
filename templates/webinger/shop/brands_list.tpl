<article class="container">
    <div>
        <div class="clearfix frame_brand main">
            <ul class="items items-list">
                {foreach $alphabet as $key => $char}
                    {if $model[$char] != null}
                        <li>
                            <a href="#{$char}" class="c_3 f-w_b">
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
</article>
