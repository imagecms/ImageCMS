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
                        <th class="span3">Ключ</th>
                        <th class="span3">Описание</th>
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
                                            <a href="/admin/components/init_window/mod_discount/edit/{echo $discount['id']}" class="pjax" >{echo $discount['key']}</a>
                                        </td>
                                        <td><p>{echo $discount['name']}</p></td>
                                        <td>{if $discount['max_apply'] != 0}{echo $discount['max_apply']}{else:} Неограничено{/if}</td>
                                        <td>{if $discount['count_apply'] != null}{echo $discount['count_apply']}{else:} - {/if}</td>
                                        <td>{echo date("Y-m-d H:i:s", $discount['date_begin'])}</td>
                                        <td>{if $discount['date_end'] != 0}{echo date("Y-m-d H:i:s", $discount['date_end'])}{else:} - {/if}</td>
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
    </div>
</section>
    