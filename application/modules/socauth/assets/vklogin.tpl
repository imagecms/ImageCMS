<form action="/socauth/vk" method="POST">
    Введите ваш емейл
    <input type="text" name="email"><br>
    <input type="submit" value="submit">
    <input type="hidden" name="name" value="{echo $data->first_name . ' ' .  $data->last_name}"><br>
    <input type="hidden" name="uid" value="{echo $data->uid}"><br>
    {form_csrf()}
</form>