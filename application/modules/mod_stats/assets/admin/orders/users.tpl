<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic" id="chartArea">
            {include_tpl('../include/top_form_orders_users')}
            <div id="user_information">
                <form id="orders_users_filter_form">
                    <input type="hidden" name="orderMethod" value="{$_GET['orderMethod']}"/>
                    <input type="hidden" name="order" value="{$_GET['order']}"/>

                    <table class="table  table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th class="orders_users_order" data-column="username">
                                    <span class="t-d_u">{lang('User','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'username'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="orders_count">
                                    <span class="t-d_u">{lang('Orders','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'orders_count'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="paid">
                                    <span class="t-d_u">{lang('Paid','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'paid'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="unpaid">
                                    <span class="t-d_u">{lang('Unpaid','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'unpaid'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="delivered">
                                    <span class="t-d_u">{lang('Delivered','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'delivered'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="orders_ids">
                                    <span class="t-d_u">{lang('Orders','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'orders_ids'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="price_sum">
                                    <span class="t-d_u">{lang('Total sum','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'price_sum'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="products_count">
                                    <span class="t-d_u">{lang('Unique products','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'products_count'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                                <th class="orders_users_order" data-column="quantity">
                                    <span class="t-d_u">{lang('Total products','mod_stats')}</span>
                                    {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'quantity'}
                                    {if $_GET.order == 'ASC'}
                                    <span class="f-s_14">↑</span>
                                    {else:}
                                    <span class="f-s_14">↓</span>
                                    {/if}
                                    {/if}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="head_body">

                                <td>
                                    <div>
                                        <input name="username" type="text" value="{$_GET['username']}"/>
                                    </div>
                                </td>
                                <td colspan="4"></td>
                                <td class="number">
                                    <input type="text" name="order_id" value="{$_GET['order_id']}" maxlength="5"/>
                                </td>
                                <td colspan="3"></td>

                            </tr>

                            {foreach $data as $user}
                            <tr>
                                <td>{$user.username}</td>
                                <td>{$user.orders_count}</td>
                                <td>{$user.paid}</td>
                                <td>{$user.unpaid}</td>
                                <td>{$user.delivered}</td>
                                <td style="word-wrap: break-word;">{$user.orders_ids}</td>
                                <td>{echo \Currency\Currency::create()->decimalPointsFormat($user.price_sum)}</td>
                                <td>{$user.products_count}</td>
                                <td>{$user.quantity}</td>
                            </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </form>

            </div>


        </div>
    </div>
</section>

