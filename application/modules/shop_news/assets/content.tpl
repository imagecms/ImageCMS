{foreach $contentShopNews as $c}
<div class="grey-b_r-bordSN">
        <p><span style="font-weight:bold"><a href="{echo base_url().$c[cat_url].$c['url']}">{echo $c['title']}</a></span></p>
        <p>
            <span>
                {echo $c['prev_text']}
            </span>
        </p>
</div>
{/foreach}

