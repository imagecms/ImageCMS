{if $type === 'TD'}
<td data-identifier="new_item_{echo time()}" data-text="New item" class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{lang('New item', 'admin_menu')}</a>
    <ul class="dropdown-menu sortableT">
        {/if}
        <li data-identifier="new_sub_item_{echo time()}" data-text="New sub item">
            <a>{lang('New sub item', 'admin_menu')}</a>
        </li>
        {if $type === 'TD'}
    </ul>
</td>
{/if}

