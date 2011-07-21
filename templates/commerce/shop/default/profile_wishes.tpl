
{include_tpl("profile_menu")}

<div class="products_list">
    <table width="100%">
        <thead>
            <tr>
                <td style="width:15px;">ID</td>
                <td>Создан</td>
                <td></td>
                <td></td>
            </tr>
        </thead>

        {foreach $wishes as $wish}
        <tr style="font-size:13px;">
            <td style="width:15px;">{echo $wish->getId()}</td>
            <td>{date("d-m-Y H:i", $wish->getDateCreated())}</td>
            <td><a href="{shop_url('wish_list/view/' . $wish->getKey())}">Просмотр</a></td>
            <td><a href="{shop_url('wish_list/delete_wish/' . $wish->getKey())}">Удалить</a></td>
        </tr>
        {/foreach}
    </table>
</div>
