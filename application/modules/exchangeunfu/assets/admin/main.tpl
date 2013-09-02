<table class="table">
    <thead>
        <tr>
            <th class="span1">#</th>
            <th>Регіон</th>
            <th>Ціна</th>
        </tr>
    </thead>
    <tbody>
        {foreach $info as $k => $datas}
            <tr>
                <td>{echo $k}</td>
                <td>{echo $datas['region']}</td>
                <td>{echo $datas['price']}</td>
            </tr>
        {/foreach}
    </tbody>
</table>