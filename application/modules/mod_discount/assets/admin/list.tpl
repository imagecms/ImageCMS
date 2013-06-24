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
        <div class="pull-right">
            Виберите тип скидки
            <div class="d-i_b">
                <select id="selectFilterDiscountType">
                    <option  {if !$_GET['filterBy']}selected=selected{/if}value="">Все</option>
                    <option {if $_GET['filterBy'] == "all_order"}selected=selected{/if} value="all_order">Заказ на сумму больше</option>
                    <option {if $_GET['filterBy'] == "comulativ"}selected=selected{/if}value="comulativ">Накопительная скидка</option>
                    <option {if $_GET['filterBy'] == "user"}selected=selected{/if}value="user">Пользователь</option>
                    <option {if $_GET['filterBy'] == "group_user"}selected=selected{/if}value="group_user">Группа пользователей</option>
                    <option {if $_GET['filterBy'] == "category"}selected=selected{/if}value="category">Категория</option>
                    <option {if $_GET['filterBy'] == "product"}selected=selected{/if}value="product">Наименования</option>
                    <option {if $_GET['filterBy'] == "brand"}selected=selected{/if}value="brand">Бренд</option>
                </select>
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
                    <th class="span1" style="width: 60px;">Удалить</th>
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
                                        <td>{if $discount['max_apply'] != 0}{echo $discount['max_apply']}{else:} Неограничено{/if}</td>
                                        <td>{if $discount['count_apply'] != null}{echo $discount['count_apply']}{else:} - {/if}</td>
                                        <td {if time()< (int)$discount['date_begin']}style="color: red;"{/if}>{echo date("Y-m-d", $discount['date_begin'])}</td>
                                        <td {if time()> (int)$discount['date_end'] && $discount['date_end'] != '0'}style="color: red;"{/if}>{if $discount['date_end'] != 0}{echo date("Y-m-d", $discount['date_end'])}{else:} - {/if}</td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="показывать">
                                                {if $discount['active'] == 1}
                                                    <span class="prod-on_off" data-id="{echo $discount['id']}"></span>
                                                {else:}
                                                    <span class="prod-on_off disable_tovar" data-id="{echo $discount['id']}"></span>
                                                {/if}
                                            </div>
                                        </td>
                                        <td><u class="removeDiscountLink" style="cursor: pointer;">Удалить</u></td>
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
