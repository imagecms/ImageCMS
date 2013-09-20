<form method="POST" action="{site_url('/wishlist/wishlist/send_email')}">
    <input type="email" name = "email" />
    <input type="hidden" name = "wish_list_id" value="{echo $wish_list_id}"/>
    <input type="submit" value="Отправить" />
    {form_csrf()}
</form>