<table class="table">
    <thead>
        <tr>
            <th class="span1">#</th>
            <th>Регіон</th>
            <th>Ціна</th>
        </tr>
    </thead>
    <tbody>
        {foreach $data1 as $k => $datas}
            <tr>
                <td>{echo $k}</td>
                <td>{echo $d['region']}</td>
                <td>{echo $d['price']}</td>
            </tr>
        {/foreach}
    </tbody>
</table>