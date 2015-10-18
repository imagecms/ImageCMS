<form action="/one_click_order/make_order" method="post">
    <input type="text" name="name">
    <input type="text" name="phone">
    <input type="hidden" name="variant_id" value="{$variant_id}">
    <button type="submit">
        {lang("Make order", 'one_click_order')}
    </button>
    {form_csrf()}
</form>