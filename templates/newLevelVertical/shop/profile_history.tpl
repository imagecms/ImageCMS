<div class="inside-padd">
    {if count($orders) == 0}
        <div class="msg layout-highlight layout-highlight-msg">
            <div class="info">
                <span class="icon_info"></span>
                <span class="text-el">{lang('You do not have any registered orders','newLevel')}</span>
            </div>
        </div>
    {else:}
        <table class="table-profile">
            <thead>
                <tr>
                    <th>{lang('Order #','newLevel')}</th>
                    <th>{lang('Pime of purchase','newLevel')}</th>
                    <th>{lang('Amount of purchase','newLevel')}</th>
                    <th>{lang('Order status','newLevel')}</th>
                    <th>{lang('Payment status','newLevel')}</th>
                </tr>
            </thead>
            <tbody>
                {foreach $orders as $order}
                    <tr>
                        <td><a rel="nofollow" href="{shop_url('cart/view/' . $order->getKey())}">{lang('Order #','newLevel')}{echo $order->getId()}</a></td>
                        <td>{date("d-m-Y H:i", $order->getDateCreated())}</td>
                        <td>
                            <div class="frame-prices">
                                <span class="current-prices">
                                    <span class="price-new">
                                        <span>
                                            <span class="price">{echo ShopCore::app()->SCurrencyHelper->convert($order->getTotalPrice())}</span>
                                            <span class="curr">{$CS}</span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                        </td>
                        </span>
                        <td>{echo $order->getSOrderStatuses()->getName()}</td>
                        <td>{if $order->getPaid()} {lang('Paid','newLevel')} {else:} {lang('Not paid','newLevel')}{/if}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {/if}
</div>