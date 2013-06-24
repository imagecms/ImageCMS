<!--Start. Global js variables -->
<script type="text/javascript">
    var currencySymbolJS = '{echo $CS}';
</script>
<!--End. Global js variables -->
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">Редактирование скидки</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/mod_discount" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#editDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('a_save')}
                </button>
                <button onclick="" type="button" class="btn btn-small action_on formSubmit submitButton" data-form="#editDiscountForm" data-action="tomain">
                    <i class="icon-check"></i>{lang('a_footer_save_exit')}
                </button>
            </div>
        </div>                            
    </div>
    <form method="post" action="/admin/components/init_window/mod_discount/edit/{echo $discount['id']}" enctype="multipart/form-data" id="editDiscountForm">
        <table class="table table-striped table-bordered table-condensed content_big_td">
            <thead>
                <tr>
                    <th colspan="6">
                        Редактировать
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
                                            <textarea name="name" maxlength="100" class="">{echo $discount['name']}</textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label bold_text" for="Text">Укажите код скидки и к-ство использования:</label>
                                        <div class="controls width150">
                                            <input id="discountKey" type="text" name="key" value="{echo $discount['key']}" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off"/>
                                            <button class="btn btn-small" type="button" id="generateDiscountKey">
                                                <i class="icon-refresh"></i>
                                            </button>
                                        </div>
                                        <div class="controls noLimitC">
                                            <label class="pt_25">Сколько раз будет использована скидка</label>
                                            {if $discount['max_apply'] != null && $discount['max_apply'] != '0'}  
                                                {$maxApply = true;}
                                            {/if}
                                            <input class="input-small onlyNumbersInput" type="text" {if $maxApply}value="{echo $discount['max_apply']}"{/if} {if !$maxApply}  disabled="disabled" {/if} maxlength="3"/>
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" {if !$maxApply} checked="checked" {/if} name="max_apply" value="" class="noLimitCountCheck">
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
                                                    <option value="1" {if $discount['type_value'] == 1}selected {/if}>Процентний</option>
                                                    <option value="2" {if $discount['type_value'] == 2}selected {/if}>Фиксированный</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="width100 ml_50">
                                        <input id="valueInput" class="input-small required" type="text" name="value" value="{echo $discount['value']}" maxlength="9" />
                                        <div  id="typeValue">
                                           {if $discount['type_value'] == 1} % {/if}
                                           {if $discount['type_value'] == 2} {echo $CS} {/if}
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
                                                    <option value="all_order" {if $discount['type_discount'] == 'all_order'} selected {/if}>Заказ на сумму больше</option>
                                                    <option value="comulativ" {if $discount['type_discount'] == 'comulativ'} selected {/if}>Накопительная скидка</option>
                                                    <option value="user" {if $discount['type_discount'] == 'user'} selected {/if}>Пользователь</option>
                                                    <option value="group_user" {if $discount['type_discount'] == 'group_user'} selected {/if}>Группа пользователей</option>
                                                    <option value="category" {if $discount['type_discount'] == 'category'} selected {/if}>Категория</option>
                                                    <option value="product" {if $discount['type_discount'] == 'product'} selected {/if}>Наименования</option>
                                                    <option value="brand" {if $discount['type_discount'] == 'brand'} selected {/if}>Бренд</option>
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
                                        <div id="all_orderBlock" class="forHide" {if $discount['type_discount'] != 'all_order'}style="display: none;"{/if}>
                                            <input class="input-small onlyNumbersInput" type="text" name="all_order[begin_value]" value="{echo $discount['all_order']['begin_value']}" maxlength="9" />{echo $CS}
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" {if $discount['all_order']['for_autorized'] ==1}checked=checked{/if} name="all_order[for_autorized]" value="1" class="noLimitCountCheck">
                                                </span>
                                                Только для зарегистрированных
                                            </span>
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="all_order[is_gift]" value="1" {if $discount['all_order']['is_gift'] == 1}checked=checked{/if} >
                                                </span>
                                                Подарочный сертификат
                                            </span>
                                        </div>
                                        <!-- End. Show if discount type is all_orders -->
                                        
                                         <!--Start. Show if discount type is comulativ -->
                                        <div id="comulativBlock" class="forHide" {if $discount['type_discount'] != 'comulativ'}style="display: none;"{/if}>
                                            от <input class="input-small onlyNumbersInput required" type="text" name="comulativ[begin_value]" value="{echo $discount['comulativ']['begin_value']}" maxlength="9" />{echo $CS}
                                            <div class="noLimitC"> 
                                                {if $discount['comulativ']['end_value'] != null && $discount['comulativ']['end_value'] != '0'}
                                                    {$endValue = true;}
                                                {/if}
                                                до <input class="input-small onlyNumbersInput" type="text" name="comulativ[end_value]" {if $endValue} value="{echo $discount['comulativ']['end_value']}"{/if} {if !$endValue} disabled="disabled" {/if}maxlength="9"/>{echo $CS}
                                                <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                    <span class="niceCheck" style="background-position: -46px 0px; ">
                                                        <input type="checkbox" {if !$endValue} checked="checked" {/if} class="noLimitCountCheck">
                                                    </span>
                                                    Максимум
                                                </span>
                                            </div>
                                        </div>
                                        <!-- End. Show if discount type is comulativ -->
                                        
                                        <!--Start. Show if discount type is user -->
                                        <div id="userBlock" class="forHide" {if $discount['type_discount'] != 'user'}style="display: none;"{/if}>
                                            <div>
                                                <div>
                                                    <label class="hideAfterAutocomlite"> Текущий пользователь : 
                                                        {echo $discount['user']['userInfo']}
                                                    </label>
                                                    <label> ID / ФИО / E-mail    :</label>
                                                    <input id="usersForDiscount" type="text" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                    <input id="discountUserId" type="hidden" name="user[user_id]" value="{echo $discount['user']['user_id']}"/>
                                                </div>
                                           </div>
                                        </div>
                                        <!-- End. Show if discount type is user -->
                                        
                                        <!--Start. Show if discount type is group of users-->
                                        <div id="group_userBlock" class="forHide" {if $discount['type_discount'] != 'group_user'}style="display: none;"{/if}>
                                            {foreach $userGroups as $group}
                                                 <input type="radio" name="group_user[group_id]" value="{echo $group[id]}" {if $group[id] == $discount['group_user']['group_id']}checked=checked{/if}>{echo $group['alt_name']}<br/>
                                                 {$checked = ''}
                                            {/foreach}
                                        </div>
                                        <!-- End. Show if discount type is group of users-->
                                        
                                        <!--Start. Show if discount type is category of products-->
                                        <div id="categoryBlock" class="forHide" {if $discount['type_discount'] != 'category'} style="display: none;" {/if}>
                                           <select name="category[category_id]">
                                                {foreach $categories as $category}
                                                    <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} value="{echo $category->getId()}" {if $category->getId() == $discount['category']['category_id']}selected=selected{/if}>{str_repeat('-',$category->getLevel())}{echo ShopCore::encode($category->getName())}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <!-- End. Show if discount type is category of products-->
                                        
                                        <!--Start. Show if discount type is product-->
                                        <div id="productBlock" class="forHide" {if $discount['type_discount'] != 'product'} style="display: none;" {/if}>
                                            <div>
                                                <label class="hideAfterAutocomlite"> Текущий товар : 
                                                    {echo $discount['product']['productInfo']}
                                                </label>
                                                <label> Название / ID :</label>
                                                <input id="productForDiscount" type="text" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                <input id="discountProductId" type="hidden" name="product[product_id]" value="{echo $discount['product']['product_id']}"/>
                                            </div>
                                        </div>
                                        <!-- End. Show if discount type is product-->
                                        
                                        <!--Start. Show if discount type is brand-->
                                        <div id="brandBlock" class="forHide" {if $discount['type_discount'] != 'brand'} style="display: none;" {/if}>
                                           <select id="selectBrand" name="brand[brand_id]">
                                                {foreach SBrandsQuery::create()->find() as $brand}
                                                    <option value="{echo $brand->getId()}" {if $brand->getId() == $discount['brand']['brand_id']}selected=selected{/if}>{echo ShopCore::encode($brand->getName())}</option>
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
                                            <input class="datepicker required" type="text" value="{echo date("Y-m-d",$discount['date_begin'])}" name="date_begin" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="span4">
                                    <div class="control-group noLimitC">
                                        <div class="ml_50 width150">
                                            <label>Скидка истекает</label>
                                            {if $discount['date_end'] != null && $discount['date_end'] != '0'}  
                                                {$endDate = true;}
                                            {/if}
                                            <input class="datepicker" type="text" {if $endDate} value="{echo date("Y-m-d",$discount['date_end'])}"{/if}{if !$endDate} disabled="disabled"{/if} name="date_end" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off"/>
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" {if !$endDate} checked {/if}class="noLimitCountCheck">
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