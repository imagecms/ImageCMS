<section class="mini-layout" style="padding-top: 39px;">
        <div class="frame_title clearfix" style="top: 179px; width: 1168px;">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Скидки ({echo count($discountsList)})</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
            <!--        <button title="Фильтровать" type="submit" class="btn btn-small"><i class="icon-filter"></i>Фильтр</button>
                    <a href="/admin/components/run/shop/search/index" title="Сбросить фильтр" type="button" class="btn btn-small pjax"><i class="icon-refresh"></i>Сбросить фильтр</a>-->
                    <a class="btn btn-small btn-success pjax" href="/admin/components/init_window/mod_discount/create"><i class="icon-plus-sign icon-white"></i>Создать</a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <table class="table table-striped table-bordered table-hover table-condensed discounts_table">
                <thead>
                    <tr style="cursor: pointer;">
                        <th class="span3">Название </th>
                        <th class="span3">Ключ</th>
                        <th class="span2">Лимит</th>
                        <th class="span2">Использовано</th>
                        <th class="span2">Начaло действия</th>
                        <th class="span2">Окончание действия</th>
                        <th class="span1" style="width: 60px;">Активна</th>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    {foreach $discountsList as $discount}
                                    <tr>
                                        <td>
                                            <a href="/admin/components/init_window/mod_discount/edit/{echo $discount['id']}" class="pjax" >{echo $discount['name']}</a>
                                        </td>
                                        <td><p>{echo $discount['key']}</p></td>
                                        <td>{echo $discount['max_apply']}</td>
                                        <td>{echo $discount['count_apply']}</td>
                                        <td>{echo date("Y-m-d H:i:s", $discount['date_begin'])}</td>
                                        <td>{echo date("Y-m-d H:i:s", $discount['date_end'])}</td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать">
                                                {if $discount['active'] == 1}
                                                    <span class="prod-on_off" data-id="{echo $discount['id']}"></span>
                                                {else:}
                                                    <span class="prod-on_off disable_tovar" data-id="{echo $discount['id']}"></span>
                                                {/if}
                                            </div>
                                        </td>
                                    </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
    {/*<div class="clearfix">
        <!-- Start. Pages -->
            <div class="pagination pull-left">
                <ul>
                    <li class="btn-primary active"><span>1</span></li>
                    <li>
                        <a class="pjax" href="/admin/components/run/shop/search/index/?_pjax=%23mainContent&amp;per_page=24/">2</a>
                    </li>
                    <li>
                        <a class="pjax" href="/admin/components/run/shop/search/index/?_pjax=%23mainContent&amp;per_page=48/">3</a>
                    </li>
                </ul>
            </div>
        <!-- End. Pages -->
        
        <!-- Start. Prev/ Next buttons -->
        <div class="pagination pull-right">
            <ul>
                <li class="disabled"><span>&lt;&nbsp;Prev</span></li>
                <li><a class="pjax" href="/admin/components/run/shop/search/index/?_pjax=%23mainContent&amp;per_page=24/">Next&nbsp;&gt;</a></li>
            </ul>
        </div>
        <!-- End. Prev/ Next buttons -->
        
        <!-- Start. Per page block -->
        <div class="pagination pull-right" style="margin-right: 25px;">
                <select style="max-width:60px;" onchange="change_per_page(this);
                return false;">
                <option value="10">10</option>
            </select>
        </div>
        <!-- End. Per page block -->
        <div class="pagination pull-right" style="margin-right: 10px; margin-top: 24px;">На странице товаров:</div>
    </div>*/}
    </div>
</section>
    