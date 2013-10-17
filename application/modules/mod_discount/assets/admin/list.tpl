<section class="mini-layout" style="padding-top: 39px;">
    <div class="frame_title clearfix" style="top: 179px; width: 1168px;">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Discounts of online store', 'mod_discount')} ({echo count($discountsList)})</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <!--        <button title="Фильтровать" type="submit" class="btn btn-small"><i class="icon-filter"></i>Фильтр</button>
                        <a href="/admin/components/run/shop/search/index" title="Сбросить фильтр" type="button" class="btn btn-small pjax"><i class="icon-refresh"></i>Сбросить фильтр</a>-->
                <a class="btn btn-small btn-success pjax" href="/admin/components/init_window/mod_discount/create"><i class="icon-plus-sign icon-white"></i>{lang('Create', 'mod_discount')}</a>
            </div>
        </div>
        <div class="pull-right">
            {lang('Choose discount type', 'mod_discount')}
            <div class="d-i_b">
                <select id="selectFilterDiscountType">
                    <option  {if !$_GET['filterBy']}selected=selected{/if}value="">{lang('All', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "all_order"}selected=selected{/if} value="all_order">{lang('Order amount of more than', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "comulativ"}selected=selected{/if}value="comulativ">{lang('Cumulative discount', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "user"}selected=selected{/if}value="user">{lang('User', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "group_user"}selected=selected{/if}value="group_user">{lang('User group', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "category"}selected=selected{/if}value="category">{lang('Category', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "product"}selected=selected{/if}value="product">{lang('Product', 'mod_discount')}</option>
                    <option {if $_GET['filterBy'] == "brand"}selected=selected{/if}value="brand">{lang('Brand', 'mod_discount')}</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <table class="table table-striped table-bordered table-hover table-condensed discounts_table">
            <thead>
                <tr style="cursor: pointer;">
                    <th class="span3">{lang('Key', 'mod_discount')}</th>
                    <th class="span3">{lang('Description', 'mod_discount')}</th>
                    <th class="span2">{lang('Limit', 'mod_discount')}</th>
                    <th class="span2">{lang('Used', 'mod_discount')}</th>
                    <th class="span2">{lang('Beggining time', 'mod_discount')}</th>
                    <th class="span2">{lang('End time', 'mod_discount')}</th>
                    <th class="span1" style="width: 60px;">{lang('Active', 'mod_discount')}</th>
                    <th class="span1" style="width: 60px;">{lang('Delete', 'mod_discount')}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="10">
                        <table>
                            <thead class="no_vis">
                                <tr>
                                    <td class="span3"></td>
                                    <td class="span3"></td>
                                    <td class="span2"></td>
                                    <td class="span2"></td>
                                    <td class="span2"></td>
                                    <td class="span2"></td>
                                    <td class="span1" style="width: 60px;"></td>
                                    <td class="span1" style="width: 60px;"></td>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $discountsList as $discount}
                                    <tr data-id="{echo $discount['id']}">
                                        <td>
                                            <a href="/admin/components/init_window/mod_discount/edit/{echo $discount['id']}" class="pjax" >{echo $discount['key']}</a>
                                        </td>
                                        <td><p>{echo $discount['name']}</p></td>
                                        <td>{if $discount['max_apply'] != 0}{echo $discount['max_apply']}{else:} {lang('Unlimited', 'mod_discount')}{/if}</td>
                                        <td>{if $discount['count_apply'] != null}{echo $discount['count_apply']}{else:} - {/if}</td>
                                        <td {if time()< (int)$discount['date_begin']}style="color: red;"{/if}>{echo date("Y-m-d", $discount['date_begin'])}</td>
                                        <td {if time()> (int)$discount['date_end'] && $discount['date_end'] != '0'}style="color: red;"{/if}>{if $discount['date_end'] != 0}{echo date("Y-m-d", $discount['date_end'])}{else:} - {/if}</td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{lang('show', 'mod_discount')}">
                                                {if $discount['active'] == 1}
                                                    <span class="prod-on_off" data-id="{echo $discount['id']}"></span>
                                                {else:}
                                                    <span class="prod-on_off disable_tovar" data-id="{echo $discount['id']}"></span>
                                                {/if}
                                            </div>
                                        </td>
                                        <td><u class="removeDiscountLink" style="cursor: pointer;">{lang('Delete', 'mod_discount')}</u></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>
