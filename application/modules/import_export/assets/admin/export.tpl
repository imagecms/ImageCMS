<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="6">{lang('Export','admin')}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <form action="{$ADMIN_URL}system/export" method="post" id="makeExportForm">
                    {$categories = ShopCore::app()->SCategoryTree->getTree()}
                    <div class="inside_padd form-horizontal row-fluid">
                        <label class="control-label" for="">{lang('Columns','admin')}</label>
                        <div class="control-group">
                            {foreach $attributes as $attrKey => $attrName}                                
                                {if $attrName != 'skip' and !in_array($attrKey, $cFields)}
                                    <div class="controls">
                                        <span class="frame_label no_connection eattrcol">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" value="1" class="eattr" name="attribute[{$attrKey}]" {if in_array($attrKey, $checkedFields)} checked="checked" {/if}/>
                                            </span>
                                            {$attrName}
                                        </span>
                                    </div>
                                {/if}
                            {/foreach}
                        </div>                        
                        <div style="">
                            <label class="control-label" for="">{lang('Categories','admin')}</label>
                            <div class="control-group span4">
                                <select name="selectedCats[]" multiple="multiple" style="width:400px !important;height:400px !important;" class="selectedCats" id="selectedCats">
                                    {foreach $categories as $category}
                                        <option value="{echo $category->getId()}">
                                            {str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}
                                        </option>
                                    {/foreach}
                                </select>
                                <button style="margin-top: 20px;" type="button" data-loading-text="{lang('Loading properties','admin')}..." class="btn btn-small btn-primary d_b" id="showCatProps" data-form="" data-submit=""><i class="icon-ok"></i>{lang('Show properties of the selected categories','admin')}</button>
                            </div>

                            <div id="properties" class="control-group span5">
                                <label class="control-label">{lang('Properties of the products','admin')}:</label>
                                <div class="properties_result span6">
                                    <p id="pleaseSelectCats" style="color: #B72F09; line-height: 2.2">{lang('Select a category for export','admin')}</p>
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="type">{lang('Filetype','admin')}</label>
                            <div class="controls">
                                <span class="frame_label no_connection m-r_15">
                                    <span class="niceRadio b_n">
                                        <input type="radio" name="type" value="csv" checked="checked"/>
                                    </span>
                                    CSV 
                                </span>

                                <span class="frame_label no_connection m-r_15">
                                    <span class="niceRadio b_n">
                                        <input type="radio" name="type" value="xlsx" />
                                    </span>
                                    XLSX
                                </span>
                                <span class="frame_label no_connection m-r_15">
                                    <span class="niceRadio b_n">
                                        <input type="radio" name="type" value="xls" />
                                    </span>
                                    XLS
                                </span>
                            </div>
                        </div>
                        <!-- Start. Let's go Button ;) -->
                        <div class="control-group">
                            <div class="control-label"></div>
                            <label class="controls">
                                <span class="btn btn-small action_on runExport" data-loading-text="{lang('Exports in progress','admin')}...">{lang('Start export','admin')}</span>
                            </label>
                        </div>
                        <!-- End. Let's go Button ;) -->
                    </div>
                    <input type="hidden" value=";" name="delimiter" />
                    <input type="hidden" value="0" name="formed_file_type" />
                    <input type="hidden" value="&#34;" name="enclosure"/>
                    <input type="hidden" value="utf-8" name="encoding"/>
                    <input type="hidden" value="ProductsImport" name="import_type"/>
                    <input type="hidden" value="{echo $languages[0]->identif}" name="language"/>
                    <input type="hidden" value="{echo $currencies[0]->id}" name="currency"/>
                    {form_csrf()}
                </form>
            </td>
        </tr>
    </tbody>
</table>
                
{var_dump($test)}