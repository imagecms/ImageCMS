<!--Start. Global js variables -->
<script type="text/javascript">
    var currencySymbolJS = '{echo $CS}';
</script>
<!--End. Global js variables -->
<section class="mini-layout">        
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Discount editing', 'mod_discount')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/mod_discount{echo $filterQuery}" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'mod_discount')}</span></a>
                <button onclick="" type="button" class="btn btn-small btn-primary formSubmit submitButton" data-form="#editDiscountForm" data-submit>
                    <i class="icon-ok icon-white"></i>{lang('Save', 'mod_discount')}
                </button>
                <button onclick="" type="button" class="btn btn-small action_on formSubmit submitButton" data-form="#editDiscountForm" data-action="tomain">
                    <i class="icon-check"></i>{lang('Save and exit', 'mod_discount')}
                </button>
                {echo create_language_select($languages, $locale, "/admin/components/init_window/mod_discount/edit/" . $discount['id'])}
            </div>
        </div>
    </div>
    <form method="post" action="/admin/components/init_window/mod_discount/edit/{echo $discount['id']}/{echo $locale}" enctype="multipart/form-data" id="editDiscountForm">
        <table class="table table-striped table-bordered table-condensed content_big_td module-cheep">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang('Edit', 'mod_discount')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd discount-out">
                            <div class="form-horizontal">
                                <div class="title-bonus-out">
                                    <div class="span4"></div>
                                    <div class="span8 title-bonus">{lang('Discount details', 'mod_discount')}</div>
                                </div>
                                <label class="">
                                    <span class="span4">{lang('Discount name', 'mod_discount')}:</span>
                                    <span class="span8 discount-name"><input type="text" name='name' value="{echo $discount['name']}" /></span>
                                </label>
                                <label class="">
                                    <span class="span4">{lang('Discount code', 'mod_discount')}:</span>
                                    <span class="span8">
                                        <input readonly id="discountKey" type="text" name="key" value="{echo $discount['key']}" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off"/>
                                        <button class="btn btn-small" type="button" id="generateDiscountKey">
                                            <i class="icon-refresh"></i>
                                        </button>
                                    </span>
                                </label>
                                <div class="noLimitC">
                                    <div class="span4">{lang('Count of usage', 'mod_discount')}:</div>
                                    <div class="span8">
                                        {if $discount['max_apply'] != null && $discount['max_apply'] != '0'}
                                            {$maxApply = true;}
                                        {/if}
                                        <span class="d-i_b m-r_10">
                                            <input class="input-small onlyNumbersInput " id="how-much" type="text" name="max_apply"{if $maxApply}value="{echo $discount['max_apply']}"{/if} {if !$maxApply}  disabled="disabled" {/if} maxlength="7"/>
                                        </span>
                                        <span class="d-i_b v-a_m">
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" {if !$maxApply} checked="checked" {/if} class="noLimitCountCheck">
                                                </span>
                                                {lang('Unlimit', 'mod_discount')}
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd discount-out">
                            <div class="form-horizontal">
                                <div class="title-bonus-out">
                                    <div class="span4"></div>
                                    <div class="span8 title-bonus">{lang('Method of calculation', 'mod_discount')}</div>
                                </div>
                                <div class="">
                                    <div class="span4">{lang('Choose method', 'mod_discount')}:</div>
                                    <div class="span8">
                                        <div class="d-i_b m-r_15">
                                            <select name="type_value" id="selectTypeValue">
                                                <option value="1" {if $discount['type_value'] == 1}selected {/if}>{lang('Percents', 'mod_discount')}</option>
                                                <option value="2" {if $discount['type_value'] == 2}selected {/if}>{lang('Fixed', 'mod_discount')}</option>
                                            </select>
                                        </div>
                                        <div class="d-i_b w-s_n-w">
                                            <input id="valueInput" class="input-small required" type="text" name="value" value="{echo $discount['value']}" maxlength="9" />
                                            <span  id="typeValue">
                                            {if $discount['type_value'] == 1} % {/if}
                                        {if $discount['type_value'] == 2} {echo $CS} {/if}
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
                <div class="inside_padd discount-out">
                    <div class="form-horizontal">
                        <div class="title-bonus-out">
                            <div class="span4"></div>
                            <div class="span8 title-bonus">{lang('Discount type', 'mod_discount')}</div>
                        </div>
                        <!-- Start. Choose type discount -->
                        <div class="m-b_15">
                            <div class="span4">{lang('Choose type', 'mod_discount')}:</div>
                            <div class="span8">
                                <select name="type_discount" id="selectDiscountType" class="required no_color">
                                    <option value="all_order" {if $discount['type_discount'] == 'all_order'} selected {/if}>{lang('Order amount of more than', 'mod_discount')}</option>
                                    <option value="comulativ" {if $discount['type_discount'] == 'comulativ'} selected {/if}>{lang('Cumulative discount', 'mod_discount')}</option>
                                    <option value="user" {if $discount['type_discount'] == 'user'} selected {/if}>{lang('User', 'mod_discount')}</option>
                                    <option value="group_user" {if $discount['type_discount'] == 'group_user'} selected {/if}>{lang('User group', 'mod_discount')}</option>
                                    <option value="category" {if $discount['type_discount'] == 'category'} selected {/if}>{lang('Category', 'mod_discount')}</option>
                                    <option value="product" {if $discount['type_discount'] == 'product'} selected {/if}>{lang('Product', 'mod_discount')}</option>
                                    <option value="brand" {if $discount['type_discount'] == 'brand'} selected {/if}>{lang('Brand', 'mod_discount')}</option>
                                </select>
                            </div>
                        </div>
                        <!-- End. Choose type discount -->

                        <div class="">
                            <div class="span4"></div>
                            <div class="span8">
                                <div class="">
                                    <!--Start. Show if discount type is all_orders -->
                                    <div id="all_orderBlock" class="forHide" {if $discount['type_discount'] != 'all_order'}style="display: none;"{/if}>
                                        <span class="d_b m-b_10">
                                            <span class="d-i_b sum-of-order"><input class="input-small onlyNumbersInput" type="text" name="all_order[begin_value]" value="{if !$discount['all_order']['begin_value']}0{else:}{echo $discount['all_order']['begin_value']}{/if}" maxlength="9" /></span>
                                            <span class="d-i_b">{echo $CS}</span>
                                        </span>
                                        <div class="m-b_5">
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" {if $discount['all_order']['for_autorized'] ==1}checked=checked{/if} name="all_order[for_autorized]" value="1" class="noLimitCountCheck">
                                                </span>
                                                {lang('Only for registered', 'mod_discount')}
                                            </span>
                                        </div>
                                        <div class="">
                                            <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                                <span class="niceCheck" style="background-position: -46px 0px; ">
                                                    <input type="checkbox" name="all_order[is_gift]" value="1" {if $discount['all_order']['is_gift'] == 1}checked=checked{/if} >
                                                </span>
                                                {lang('Gift Certificate', 'mod_discount')}
                                            </span>
                                        </div>
                                    </div>
                                    <!-- End. Show if discount type is all_orders -->
                                </div>
                                <div class="">
                                    <!--Start. Show if discount type is comulativ -->
                                    <div id="comulativBlock" class="forHide" {if $discount['type_discount'] != 'comulativ'}style="display: none;"{/if}>
                                        <span class="d-i_b m-r_5">{lang('from', 'mod_discount')}</span>
                                        <span class="d-i_b">
                                            <input class="input-small onlyNumbersInput required" type="text" name="comulativ[begin_value]" value="{echo $discount['comulativ']['begin_value']}" maxlength="9" />
                                        </span>
                                        <div class="noLimitC d-i_b">
                                            {if $discount['comulativ']['end_value'] != null && $discount['comulativ']['end_value'] != '0'}
                                                {$endValue = true;}
                                            {/if}
                                            <span class="d-i_b m-r_5">{lang('to', 'mod_discount')}</span>
                                            <span class="d-i_b">
                                                <input class="input-small onlyNumbersInput" type="text" name="comulativ[end_value]" {if $endValue} value="{echo $discount['comulativ']['end_value']}"{/if} {if !$endValue} disabled="disabled" {/if}maxlength="9"/>
                                            </span>
                                            <span class="d-i_b">{echo $CS}</span>
                                            <span class="d-i_b m-l_20">
                                                <span class="frame_label no_connection m-r_15 spanForNoLimit d-i_b v-a_m" >
                                                    <span class="niceCheck" style="background-position: -46px 0px; ">
                                                        <input type="checkbox" {if !$endValue} checked="checked" {/if} class="noLimitCountCheck">
                                                    </span>
                                                    {lang('Maximum', 'mod_discount')}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- End. Show if discount type is comulativ -->
                                </div>
                                <div class="">
                                    <!--Start. Show if discount type is user -->
                                    <div id="userBlock" class="forHide" {if $discount['type_discount'] != 'user'}style="display: none;"{/if}>
                                        <div>
                                            <div>
                                                <label class="hideAfterAutocomlite"> {lang('Current user', 'mod_discount')} :
                                                    {echo $discount['user']['userInfo']}
                                                </label>
                                                <label> {lang('ID / Name / E-mail', 'mod_discount')}:</label>
                                                <input id="usersForDiscount" type="text" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                                <input id="discountUserId" type="hidden" name="user[user_id]" value="{echo $discount['user']['user_id']}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End. Show if discount type is user -->
                                </div>
                                <div class="">
                                    <!--Start. Show if discount type is group of users-->
                                    <div id="group_userBlock" class="forHide" {if $discount['type_discount'] != 'group_user'}style="display: none;"{/if}>
                                    {if $discount['group_user']['group_id'] == null}{$checked = 'checked=checked'}{/if}
                                    {foreach $userGroups as $group}
                                        <label>
                                            <input type="radio" name="group_user[group_id]" {$checked} value="{echo $group[id]}" {if $group[id] == $discount['group_user']['group_id']}checked=checked{/if}>{echo $group['alt_name']}<br/>
                                        </label>
                                        {$checked=''}
                                    {/foreach}
                                </div>
                                <!-- End. Show if discount type is group of users-->
                            </div>
                            <div class="">
                                <!--Start. Show if discount type is category of products-->
                                <div id="categoryBlock" class="forHide" {if $discount['type_discount'] != 'category'} style="display: none;" {/if}>
                                    <select name="category[category_id]">
                                        {foreach $categories as $category}
                                            <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} value="{echo $category->getId()}" {if $category->getId() == $discount['category']['category_id']}selected=selected{/if}>{str_repeat('-',$category->getLevel())}{echo ShopCore::encode($category->getName())}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <!-- End. Show if discount type is category of products-->
                            </div>
                            <div class="">
                                <!--Start. Show if discount type is product-->
                                <div id="productBlock" class="forHide" {if $discount['type_discount'] != 'product'} style="display: none;" {/if}>
                                    <div>
                                        <label class="hideAfterAutocomlite"> {lang('Current product', 'mod_discount')} :
                                            <span class="now-active-prod">{echo $discount['product']['productInfo']}</span>
                                        </label>
                                        <label> {lang('Name / ID', 'mod_discount')}  :</label>
                                        <input id="productForDiscount" type="text" value="" class="ui-autocomplete-input" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
                                        <input id="discountProductId" type="hidden" name="product[product_id]" value="{echo $discount['product']['product_id']}"/>
                                    </div>
                                </div>
                                <!-- End. Show if discount type is product-->
                            </div>
                            <div class="">
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
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="6">
            <!-- Start. Data discount block -->
            <div class="inside_padd discount-out">
                <div class="title-bonus-out">
                    <div class="span4"></div>
                    <div class="span8 title-bonus">{lang('Allowed time for discounts', 'mod_discount')}</div>
                </div>
                <div class="">
                    <div class="span4">{lang('Period of the discount from', 'mod_discount')}:</div>
                    <div class="span8">
                        <div class="">
                            <span class="d-i_b">
                                <label class="p_r">
                                    <input class="datepicker required discountDate" type="text" value="{echo date("Y-m-d",$discount['date_begin'])}" name="date_begin" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off" />
                                    <span class="icon-calendar"></span>
                                </label>
                            </span>
                            <span class="d-i_b m-r_10 m-l_10">{lang('to', 'mod_discount')}</span>
                            <span class="d-i_b">
                                <div class="noLimitC">
                                    {if $discount['date_end'] != null && $discount['date_end'] != '0'}
                                        {$endDate = true;}
                                    {/if}
                                    <label class="d-i_b p_r">
                                        <input class="datepicker discountDate" type="text" {if $endDate} value="{echo date("Y-m-d",$discount['date_end'])}"{/if}{if !$endDate} disabled="disabled"{/if} name="date_end" onkeypress="return false;" onkeyup="return false;" onkeydown="return false;" autocomplete="off"/>
                                        <span class="icon-calendar"></span>
                                    </label>
                                    <div class="d-i_b m-l_10 v-a_m">
                                        <span class="frame_label no_connection m-r_15 spanForNoLimit" >
                                            <span class="niceCheck" style="background-position: -46px 0px; ">
                                                <input type="checkbox" {if !$endDate} checked {/if}class="noLimitCountCheck">
                                            </span>
                                            {lang('Constant discount', 'mod_discount')}
                                        </span>
                                    </div>
                                </div>
                            </span>
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