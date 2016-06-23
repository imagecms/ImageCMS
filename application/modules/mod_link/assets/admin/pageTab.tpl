<table class="table  table-bordered table-hover table-condensed content_big_td">
    <thead>
    <tr>
        <th colspan="6">
            {lang('mod_link', 'mod_link')}
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd">
                <div class="row-fluid">
                    <div class="span12">

                        <div class="control-group">
                            <div class="control-label"></div>
                            <div class="controls">
                                <span class="frame_label no_connection">
                                    <span class="niceCheck b_n">
                                        <input name="linked[show_on]"
                                               type="checkbox" {echo $pageLink->getShowOn()?'checked':''}/>
                                    </span>
                                    {lang('Show link in product page', 'mod_link')}
                                </span>
                            </div>
                        </div>


                        <div class="control-group">
                            <div class="control-label"></div>
                            <div class="controls">
                                <span class="frame_label no_connection " id="permanentCheck">
                                    <span class="niceCheck b_n">
                                        <input
                                                name="linked[permanent]"
                                                type="checkbox" {echo $pageLink->getPermanent()?'checked':''}/>
                                    </span>
                                    {lang('Show always', 'mod_link')}
                                </span>
                            </div>
                        </div>


                        <div class="control-group " id="hideDate" {if $pageLink->getPermanent()}hidden{/if}>
                            <label class="control-label"
                                   for="showInCategory">{lang('Date', 'mod_link')}:
                            </label>
                            <div class="controls">
                                <label class="v-a_m"
                                       style="width:115px;margin-right:10px; display: inline-block;margin-bottom:0px;">
                                        <span class="o_h d_b p_r">
                                            <input type="text" data-placement="top"
                                                   data-original-title="{lang('choose a date','mod_link')}"
                                                   data-rel="tooltip" class="datepicker " name="linked[active_from]"
                                                   value="{echo $pageLink->getActiveFrom('d-m-Y')}"
                                                   placeholder="{lang('from','admin')}">
                                            <i class="icon-calendar"></i>
                                        </span>
                                </label>
                                <label class="v-a_m" style="width:115px; display: inline-block;margin-bottom:0px;">
                                        <span class="o_h d_b p_r">
                                            <input type="text" data-placement="top"
                                                   data-original-title="{lang('choose a date','mod_link')}"
                                                   data-rel="tooltip" class="datepicker " name="linked[active_to]"
                                                   value="{echo $pageLink->getActiveTo('d-m-Y')}"
                                                   placeholder="{lang('to','admin')}">
                                            <i class="icon-calendar"></i>
                                        </span>
                                </label>
                            </div>
                        </div>

                        <div class="control-group ">
                            <label class="control-label">{lang('Selecting a product','mod_link')}:
                            </label>
                            <div class="controls">
                                <input type="text" id="linkedProducts"/>
                                <span class="help-block">
                                    {lang('ID', 'admin')} / {lang('Product name', 'admin')} / {lang('Article', 'mod_link')}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div id="linkedProductsBlock" {if 0 == count($pageLink->getLinkedProducts($locale))} style="display: none;" {/if}>
                        <div class="title-default">{lang('Current products','mod_link')}</div>
                        <table class="table  table-bordered table-hover table-condensed">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span6">{lang('Product', 'mod_link')}</th>
                                <th class="span6">{lang('Photo', 'mod_link')}</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach $pageLink->getLinkedProducts() as $product}
                                <tr>
                                    <td>
                                        <a class="remove_linked_row btn btn-small" data-rel="tooltip"
                                           data-title="{lang('Delete','admin')}">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{echo '/admin/components/run/shop/products/edit/' . $product->getId()}">
                                            {echo $product->getName()}
                                        </a>
                                    </td>
                                    <td>
                                        {$src= $product->getFirstVariant()->getSmallPhoto()}
                                        <img src="{$src}"
                                             class="img-polaroid"
                                             style="width: 40px;float: left; margin-right: 15px;">
                                    </td>
                                    <input name="linked[products][]" type="hidden" value="{echo $product->getId()}">
                                </tr>
                            {/foreach}
                            <tr id="row_default" style="display: none;">
                                <td class="item-accessories">
                                    <a class="remove_linked_row btn btn-small" data-rel="tooltip"
                                       data-title="{lang('Delete','mod_link')}">
                                        <i class="icon-trash"></i>
                                    </a>
                                </td>
                                <td></td>
                                <td>
                                    <img src="{media_url('templates/administrator/images/select-picture.png')}"
                                         class="img-polaroid"
                                         style="width: 40px;float: left; margin-right: 15px;">
                                </td>
                                <input type="hidden">
                            </tr>
                            </tbody>

                        </table>

                        <input type="hidden" name="linked[locale]" value="{$locale}">
                    </div>
                </div>
            </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>




