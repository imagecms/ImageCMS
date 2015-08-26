{if $class != 'btn inWL'}
    <form method="post" action="{site_url($href)}">
        <input type="submit"
               class="{$class}"
               id='{echo $varId}'
               value="{$value}"
               data-maxListsCount = '{$max_lists_count}'
               />
    </form>
{else:}
    <a href="/wishlist" class="btn inWL">{lang('Already in WishList', 'wishlist')}</a>
{/if}
