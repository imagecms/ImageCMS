<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Import-Export CSV/XLS','import_export')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/init_window/import_export" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'import_export')}</span></a>
                    {echo create_language_select($languages, $locale, "/admin/components/modules_table")}
            </div>
        </div>
    </div>
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/import" class="btn btn-small">{lang('Import', 'import_export')}</a>
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/export" class="btn btn-small active">{lang('Export', 'import_export')}</a>
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/archiveList" class="btn btn-small">{lang('List archives exports', 'import_export')}</a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="exportcsv">    
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">{lang('Export','import_export')}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <form action="../getExport" method="post" id="makeExportForm">
                                {$categories = ShopCore::app()->SCategoryTree->getTree()}
                                <div class="inside_padd form-horizontal row-fluid">
                                    <label class="control-label" for="">{lang('Columns','import_export')}</label>
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
                                    <div class="control-group">
                                        <label class="control-label" for="">{lang('Categories','import_export')}</label>
                                        <div class="controls">
                                            <div>
                                                <select name="selectedCats[]" multiple="multiple" class="selectedCats span5" id="selectedCats" onchange="
                                                        if ($(this).val())
                                                            $('#showCatProps').removeAttr('disabled');
                                                        else
                                                            $('#showCatProps').attr('disabled', 'disabled');">
                                                    {foreach $categories as $category}
                                                        <option value="{echo $category->getId()}">
                                                            {str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}
                                                        </option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                            <button type="button" data-loading-text="{lang('Loading properties','import_export')}..." class="btn btn-small m-t_10" id="showCatProps" disabled="disabled">
                                                <i class="icon-chevron-down m-r_5"></i>{lang('Show properties of the selected categories','import_export')}
                                            </button>
                                        </div>
                                    </div>
                                    <div id="properties" class="control-group">
                                        <label class="control-label">{lang('Properties of the products','import_export')}:</label>
                                        <div class="controls ctext">
                                            <div class="properties_result">
                                                <p id="pleaseSelectCats">{lang('Select a category for export','import_export')}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="type">{lang('Filetype','import_export')}</label>
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

                                    <span class="controls span10">
                                        <div class="d_n">{lang('The data of your database will be stored in the folder','import_export')} {echo BACKUPFOLDER}</div>
                                        <span class="frame_label no_connection">
                                            <span class="niceCheck b_n">
                                                <input class="btn btn-small action_on" type="checkbox" value="true" name="withZip">
                                            </span>
                                            <span>{lang('Make a backup of photos','import_export')}</span>
                                        </span>
                                    </span>

                                    <!-- Start. Let's go Button ;) -->
                                    <div class="control-group">
                                        <div class="control-label"></div>
                                        <label class="controls">
                                            <span class="btn btn-small action_on runExport" data-loading-text="{lang('Exports in progress','import_export')}...">{lang('Start export','import_export')}</span>
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
        </div>
    </div>
</section>