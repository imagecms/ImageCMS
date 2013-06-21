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
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit" data-form="#createDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('a_save')}
                </button>
                <button onclick="" type="button" class="btn btn-small action_on formSubmit" data-form="#createDiscountForm" data-action="tomain">
                    <i class="icon-check"></i>{lang('a_footer_save_exit')}
                </button>
            </div>
        </div>                            
    </div>
    <form method="post" action="/admin/components/init_window/mod_discount/create" enctype="multipart/form-data" id="createDiscountForm">
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
                                       <label class="control-label bold_text" for="Text">Описание:</label>
                                        <div class="controls">
                                            <input type="text" name="name" value="" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label bold_text" for="Text">Укажите код скидки и к-ство использования:</label>
                                        <div class="controls width150">
                                            <input id="discountKey" type="text" name="key" value="" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off"/>
                                            <button class="btn btn-small" type="button" id="generateDiscountKey">
                                                <i class="icon-refresh"></i>
                                            </button>
                                        </div>
                                        <div class="controls noLimitC">
                                            <label class="pt_25">Сколько раз будет использована скидка</label>
                                            <input class="input-small" type="text" value="" disabled="disabled"/>
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" checked="checked" name="max_apply" value="1" class="noLimitCountCheck">
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
                                    <div class="width100 ml_50">
                                        <input class="input-small required" type="text" name="value"/>
                                        <div  id="typeValue">
                                            %
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
                                <!-- Start. Choose type discount -->
                                <div class="span9">
                                    <h2 style="padding-left: 25px;">Тип скидки</h2>
                                    <div class="control-group">
                                        <div class="controls">
                                            <div class="width200">
                                                <select name="type_discount" id="selectDiscountType" class="required no_color">
                                                    <option  value="">Нет</option>
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
                                <!-- End. Choose type discount -->
                            </div>
                            <div class="form-horizontal">
                                <div class="control-group">
                                    <div class="controls">
                                        <!--Start. Show if discount type is all_orders -->
                                        <div id="all_orderBlock" class="forHide" style="display: none;">
                                            <input class="input-small" type="text" name="all_order[begin_value]" value="" />{echo $CS}
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="all_order[for_autorized]" value="1" class="noLimitCountCheck">
                                                </span>
                                                Только для зарегистрированных
                                            </span>
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="all_order[is_gift]" value="1" >
                                                </span>
                                                Подарочный сертификат
                                            </span>
                                        </div>
                                        <!-- End. Show if discount type is all_orders -->
                                        
                                         <!--Start. Show if discount type is comulativ -->
                                        <div id="comulativBlock" class="forHide" style="display: none;">
                                            от <input class="input-small" type="text" name="comulativ[begin_value]" value="" />{echo $CS}
                                            <div class="noLimitC"> 
                                                до <input class="input-small" type="text" name="comulativ[end_value]" value="" />{echo $CS}
                                                <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                    <span class="niceCheck" style="background-position: -46px 0px; ">
                                                        <input type="checkbox" class="noLimitCountCheck">
                                                    </span>
                                                    Максимум
                                                </span>
                                            </div>
                                        </div>
                                        <!-- End. Show if discount type is comulativ -->
                                        
                                        <!--Start. Show if discount type is user -->
                                        <div id="userBlock" class="forHide" style="display: none;">
                                            <div>
                                                <div>
                                                   <label> ID / ФИО / E-mail    :</label>
                                                   <input id="usersForDiscount" type="text" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                   <input id="discountUserId" type="hidden" name="user[user_id]" value=""/>
                                                </div>
                                           </div>
                                        </div>
                                        <!-- End. Show if discount type is user -->
                                        
                                        <!--Start. Show if discount type is group of users-->
                                        <div id="group_userBlock" class="forHide" style="display: none;">
                                            {$checked = 'checked'}
                                            {foreach $userGroups as $group}
                                                 <input type="radio" name="group_user[id]" value="{echo $group[id]}" {echo $checked}>{echo $group['alt_name']}<br/>
                                                 {$checked = ''}
                                            {/foreach}
                                        </div>
                                        <!-- End. Show if discount type is group of users-->
                                        
                                        <!--Start. Show if discount type is category of products-->
                                        <div id="categoryBlock" class="forHide" style="display: none;">
                                           <select name="category[category_id]">
                                                {foreach $categories as $category}
                                                    <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())}{echo ShopCore::encode($category->getName())}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <!-- End. Show if discount type is category of products-->
                                        
                                        <!--Start. Show if discount type is product-->
                                        <div id="productBlock" class="forHide" style="display: none;">
                                            <div>
                                                <label> Название / ID :</label>
                                                <input id="productForDiscount" type="text" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                <input id="discountProductId" type="hidden" name="product[product_id]" value=""/>
                                            </div>
                                        </div>
                                        <!-- End. Show if discount type is product-->
                                        
                                        <!--Start. Show if discount type is brand-->
                                        <div id="brandBlock" class="forHide" style="display: none;">
                                           <select id="selectBrand" name="brand[brand_id]">
                                                <option value="">{lang('a_not_set')}</option>
                                                {foreach SBrandsQuery::create()->find() as $brand}
                                                    <option value="{echo $brand->getId()}">{echo ShopCore::encode($brand->getName())}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <!-- End. Show if discount type is vrand-->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <!-- Start. Data discount block -->
                        <div class="inside_padd">
                            <div class="form-horizontal">
                                <h2 style="padding-left: 25px;">Время актуальности</h2>
                                <div class="span3">
                                    <label class="control-label" for="Text" style="margin-top: 25px;"><i class="icon-info-sign"></i></label>
                                    <div class="control-group">
                                        <div class="controls width150">
                                            <label>Скидка начинается</label>
                                            <input class="datepicker required" type="text" value="" name="date_begin" />
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
                                                    <input type="checkbox" name="date_end" value="1" class="noLimitCountCheck">
                                                </span>
                                                Не заканчивается
                                            </span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End. Data discount block -->
                    </td>
                </tr>
            </tbody>
        </table>     
    </form>
    <div id="elFinder"></div>
</section>