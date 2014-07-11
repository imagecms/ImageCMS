{if !empty($errors)} 
    <p style="color: #E42E2E;">
        {$errors}
    </p>
{/if}

<form method="post" action="/saas/create_store" style="margin: 30px; width: 400px;">

    <table cellpadding="10">
        <tr>
            <td>домен трєтого рівня</td>
            <td><input type="text" name="domain" value="{echo isset($domain) ? $domain : set_value('domain')}" ></td>
        </tr>
        <tr>
            <td>елєктро-почта</td>
            <td><input type="text" name="email" value="{echo set_value('email')}"></td>
        </tr>
        <tr>
            <td>я тя кличут?</td>
            <td><input type="text" name="username" value="{echo set_value('username')}"></td>
        </tr>
        <tr>
            <td>пароль від контакту</td>
            <td><input type="text" name="password" value="{echo set_value('password')}"></td>
        </tr>
        <tr>
            <td>тєлєфончик можна (хіба якшо гарна дєвочка)</td>
            <td><input type="text" name="phone" value="{echo set_value('phone')}"></td>
        </tr>
        <tr>
            <td>відки сам? не москаль часом?</td>
            <td>
                <select name="country">
                    <option value="1">Україна</option>
                    <option value="2">Або Україна</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>місто (Львів зе бест!)</td>
            <td><input type="text" name="city" value="{echo set_value('city')}"></td>
        </tr>
        <tr>
            <td>шо буш продавав</td>
            <td>
                <select name="products_category">
                    <option value="1">Жрачка</option>
                    <option value="2">Не жрачка</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>уровієнь мастєрства</td>
            <td>
                <select name="level">
                    <option value="1">взагалі не розумію де я</option>
                    <option value="2">животное!!!</option>
                </select>
            </td>
        </tr>

    </table>

    <br />

    <button type="submit" style="background: #E42E2E; padding: 5px; color: white;">Все буде добре (Океан Ельзи)</button>
    {form_csrf()}
</form>