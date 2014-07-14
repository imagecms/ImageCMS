
<form method="post" action="/saas/create_store" style="padding: 30px; width: 400px;">
    <input type="text" name="domain">
    <input type="hidden" name="from_start" value="1">
    <button type="submit">Create your super-puper store</button>
    {form_csrf()}
</form>