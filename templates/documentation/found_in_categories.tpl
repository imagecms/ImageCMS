<ul class="">
    {foreach $tree as $item}
        {if array_key_exists($item['id'], $categoriesInSearchResults)}
            <li>
                <a href="{base_url($item['path_url'])}">{$item['name']}({$categoriesInSearchResults[$item['id']]})</a>
                <!--Start. Second level -->
                {if $item['subtree'] && $item['level']<3}
                    {foreach $item['subtree'] as $item}
                        {if array_key_exists($item['id'], $categoriesInSearchResults)}
                        <li>
                            <a href="{base_url($item['path_url'])}">
                                <span style="color:black;">
                                    -{$item['name']}({$categoriesInSearchResults[$item['id']]})
                                </span>
                            </a>
                            <!--Start. Third level -->
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
                    </li>
                {/if}
            {/foreach}
        {/if}
        <!--End. Second level -->
    </li>
{/if}
{/foreach}
</ul>

