<div id="user_information">

    <table class="table table-striped table-bordered table-condensed content_big_td">
        <thead>
            <tr>
                <th>Польз.</th>
                <th>К-во заказов</th>
                <th>Оплаченных</th>
                <th>Дост. заказов</th>
                <th>Заказы</th>
                <th>На суму</th>
                <th>К-во товаров</th>
                <th>Всего товаров</th>
            </tr>
        </thead>
        <tbody>
            {foreach $data as $user}
                <tr>
                    <td>{$user.username}</td>
                    <td>{$user.orders_count}</td>
                    <td>{$user.paid}</td>
                    <td>{$user.delivered}</td>
                    <td>{$user.orders_ids}</td>
                    <td>{$user.price_sum}</td>
                    <td>{$user.products_count}</td>
                    <td>{$user.quantity}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    <div class="d-i_b span3">
        <select id="selectChartType">
            <option value="pieChart">{lang('pie', 'mod_stats')}</option>
            <option value="barChart">{lang('bar', 'mod_stats')}</option>
        </select>
    </div>

    <div class="d-i_b span3">
        <select id="diagramField">
            <option value="orders_count" {if $_COOKIE['user_info_dfield'] == 'orders_count'}selected = "selected"{/if}>К-во заказов</option>
            <option value="paid" {if $_COOKIE['user_info_dfield'] == 'paid'}selected = "selected"{/if}>Оплаченных</option>
            <option value="delivered" {if $_COOKIE['user_info_dfield'] == 'delivered'}selected = "selected"{/if}>Дост. заказов</option>
            <option value="price_sum" {if $_COOKIE['user_info_dfield'] == 'price_sum'}selected = "selected"{/if}>На суму</option>
            <option value="products_count" {if $_COOKIE['user_info_dfield'] == 'products_count'}selected = "selected"{/if}>К-во товаров</option>
            <option value="quantity" {if $_COOKIE['user_info_dfield'] == 'quantity'}selected = "selected"{/if}>Всего товаров</option>
        </select>
    </div>

    <div id="pieChart" class="hideChart">
        <svg style="height: 500px;"></svg>
    </div>

    <div id="barChart" class="hideChart span12" style="display: none;">
        <svg style="height: 500px; width: 800px;"></svg>
    </div>

</div>