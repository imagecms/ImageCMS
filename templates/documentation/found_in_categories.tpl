<ul class="search-lvl-1">
    {foreach $tree as $item}
    {if array_key_exists($item['id'], $categoriesInSearchResults)}
    <li>
        <a class="" href="{base_url($item['path_url'])}">{$item['name']}
        <!--    <span class="listing-num">({$categoriesInSearchResults[$item['id']]})</span>-->
        </a>
        <!--Start. Second level -->
        {if $item['subtree'] && $item['level']<3}
        <ul class="search-lvl-2">
            {foreach $item['subtree'] as $item}
            {if array_key_exists($item['id'], $categoriesInSearchResults)}
            <li>
                <a href="{base_url($item['path_url'])}">
                    {$item['name']}<span class="listing-num">({$categoriesInSearchResults[$item['id']]})</span>
                </a>
                {/*}      <!--Start. Third level -->
                {if $item['subtree'] && $item['level']<3}
                {foreach $item['subtree'] as $item}
                {if array_key_exists($item['id'], $categoriesInSearchResults)}
                <li>
                    <a href="{base_url($item['path_url'])}">
                        <span style="color:black;">
                            --{$item['name']}({$categoriesInSearchResults[$item['id']]})
                        </span>
                    </a>
                </li>
                {/if}
                {/foreach}
                {/if}
                <!--End. Third level -->
                {*/}
            </li>
            {/if}
            {/foreach}
        </ul>
        {/if}
        <!--End. Second level -->
    </li>
    {/if}
    {/foreach}
</ul>

