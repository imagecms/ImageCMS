<article class="container">
    <div class="row">
        <div class="columnBrandsHolder">
            <div class="columnBrand">
                {$counter=0}
                {foreach $alphabet as $key => $char}
                    {if $model[$char] != null}
                        {if $counter >= $iteration-1}
                        </div>
                        <div class="columnBrand">
                            {$counter=0}
                        {/if}
                        <div href="#{$char}" class="brandName" >
                            {$char}
                        </div>
                        {foreach $model[$char] as $m}
                            {if $counter >= $iteration}
                            </div>
                            <div class="columnBrand">
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
</article>
