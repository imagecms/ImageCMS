{if $class != 'btn inWL'}
    <form method="post" action="{site_url('/wishlist/renderPopup/'.$varId)}">
        <input type="submit"
               class="{$class}"
               id='{echo $varId}'
               value="{$value}"
               data-maxListsCount = '{$max_lists_count}'
               />
    </form>
{else:}
    <a href="/wishlist" class="btn inWL">Уже в Списке Желания</a>
{/if}
