<!--Start. Global js variables -->
<script type="text/javascript">
    var currencySymbolJS = '{echo $CS}';
</script>
<!--End. Global js variables -->
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Создание скидки</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/mod_discount" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit" data-form="#image_upload_form" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('a_save')}
                </button>
                <button onclick="" type="button" class="btn btn-small action_on formSubmit" data-form="#image_upload_form" data-action="tomain">
                    <i class="icon-check"></i>{lang('a_footer_save_exit')}
                </button>
            </div>
        </div>                            
    </div>
    <form method="post" action="/admin/components/init_window/mod_discounts/create" enctype="multipart/form-data" id="">
        <table class="table table-striped table-bordered table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        Создать
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="span9">
                                    <h2 style="padding-left: 25px;">Детали скидки</h2>
                                    <div class="control-group pt_25" >
                                       <label class="control-label bold_text" for="Text">Название:</label>
                                        <div class="controls">
                                            <input type="text" name="name" value="" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label bold_text" for="Text">Укажите код скидки и к-ство использования:</label>
                                        <div class="controls width150">
                                            <input type="text" name="name" value="" />
                                            <button class="btn btn-small" type="button" id="generateDiscountKey">
                                                <i class="icon-refresh"></i>
                                            </button>
                                        </div>
                                            
                                        <div class="controls noLimitC">
                                            <label class="pt_25">Сколько раз будет использована скидка</label>
                                            <input class="input-small" type="text" value="" disabled="disabled"/>
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" checked="checked" name="active" value="1" class="noLimitCountCheck">
                                                </span>
                                                Бесконечно
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                 <h2 style="padding-left: 25px;">Способ начисления</h2>
                                <div class="span4">
                                    <div class="control-group">
                                        <label class="control-label" for="Text"><i class="icon-info-sign"></i></label>
                                        <div class="controls">
                                            <div class="width150">
                                                <select name="type_value" id="selectTypeValue">
                                                    <option value="1">Процентний</option>
                                                    <option value="2">Фиксированный</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="width100">
                                        <input class="input-small required ml_50" type="text" name="value" value="" />
                                    </div>
                                    <div  id="typeValue" style="float: right;">
                                        %
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <div class="span9">
                                    <h2 style="padding-left: 25px;">Тип скидки</h2>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="width150">
                                                <select name="type_discount" id="selectDiscountType">
                                                    <option value="">Нет</option>
                                                    <option value="all_order">Заказ на сумму больше</option>
                                                    <option value="comulativ">Накопительная скидка</option>
                                                    <option value="user">Пользователь</option>
                                                    <option value="group_user">Группа пользователей</option>
                                                    <option value="category">Категория</option>
                                                    <option value="product">Наименования</option>
                                                    <option value="brand">Бренд</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-horizontal">
                                <div class="span9">
                                  <div class="control-group">
                                        <div class="controls">
                                            <div class="width150">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <h2 style="padding-left: 25px;">Время актуальности</h2>
                                <div class="span3">
                                    <label class="control-label" for="Text" style="margin-top: 25px;"><i class="icon-info-sign"></i></label>
                                    <div class="control-group">
                                        <div class="controls width150">
                                            <label>Скидка начинается</label>
                                            <input class="datepicker" type="text" value="" name="date_begin" />
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="control-group noLimitC">
                                        <div class="ml_50 width150">
                                            <label>Скидка истекает</label>
                                            <input class="datepicker" type="text" value="" name="date_end" />
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="active" value="1" class="noLimitCountCheck">
                                                </span>
                                                Не заканчивается
                                            </span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>                               
    </form>
    <div id="elFinder"></div>
</section>