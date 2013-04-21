<table class="table">
    <thead>
        <tr>
            <th>№</th>
            <th>Отписатся</th>
            <th>Товар</th>
            <th>Новая цена</th>
            <th>Старая цена</th>
            <th>Процент снижения цены</th>
        </tr>
    </thead>
    <tbody>
        {foreach $products as $key => $product}

            <tr>
                <td>{echo $key+1}</a></td>
                <td>
                    <input type="submit" 
                           class="btn" 
                           value="Отписаться"
                           onclick="unspy({$product[hash]});
                            return false"/>
                </td>
                <td>{date("d-m-Y H:i")}</td>
                <td>{date("d-m-Y H:i")}</td>
                <td>{} {}</td>
                <td>{}</td>
                <td>

                </td>
            </tr>
        {/foreach}
    </tbody>
</table>