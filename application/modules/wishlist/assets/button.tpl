<form method="post" action="{site_url('/wishlist/renderPopup/'.$varId)}">
    <input type="submit"
           class="{$class}"
           id='{echo $varId}'
           value="{$value}"
           data-maxListsCount = '{$max_lists_count}'
            />
</form>
