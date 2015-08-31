<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Import-Export CSV/XLS','import_export')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
            </div>
        </div>
    </div>
    <div class="btn-group myTab m-t_20" data-toggle="buttons-radio">
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/import" class="btn btn-small active">{lang('Import', 'import_export')}</a>
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/export" class="btn btn-small">{lang('Export', 'import_export')}</a>
        <a href="{$BASE_URL}admin/components/init_window/import_export/getTpl/archiveList" class="btn btn-small">{lang('List archives exports', 'import_export')}</a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="importcsv">
            <table class="table  table-bordered table-hover table-condensed content_big_td">
                <thead>
                    <tr>
                        <th colspan="6">{lang('Import','import_export')}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <div class="importProcess">
                                <!-- Start. Choose file and load to server on checked slot  -->
                                <div class="fortextblock inside_padd">
                                    <form action="{$ADMIN_URL}../getImport/imports" method="post" enctype="multipart/form-data">
                                        <div class="control-group form-horizontal">
                                            <label class="control-label"></label>
                                            <div class="controls">
                                                <span class="btn btn-small p_r pull-left">
                                                    <i class="icon-folder-open"></i>&nbsp;&nbsp;{lang('Select the file','import_export')}
                                                    <input type="file" id="importcsvfile" name="userfile" class="btn-small btn" />
                                                </span>
                                            </div>
                                            {form_csrf()}
                                        </div>
                                    </form>
                                </div>
                                <!-- End. Choose file and load to server on checked slot  -->

                                <!-- Start. Choose file and load to server on checked slot  -->
                                <form action="{$ADMIN_URL}../getImport/imports" method="post" enctype="multipart/form-data" id="makeImportForm">
                                    <div class="inside_padd form-horizontal row-fluid">

                                        <!-- Start. First of tree slots markup -->
                                        <div class="control-group">
                                            <span class="control-label">
                                            </span>
                                        </div>


                                        <div class="control-group">
                                            <span class="control-label">
                                                <span data-title="{lang('Language ','import_export')}" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">{lang('Язык, на котором будут заполняться переводы названий товаров и вариантов','import_export')}</div>&nbsp;{lang('Language ','import_export')}:
                                            </span>
                                            <div class="controls">
                                                <select name="language">
                                                    {foreach $languages as $language}
                                                    <option value="{echo $language->identif}" {if $language->default == 1}selected="selected"{/if}>{echo $language->lang_name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <span class="control-label">
                                                <span data-title="&lt;b&gt;CSV/XLS/XLSX&lt;/b&gt;" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">{lang('Select the file in a convenient format','import_export')}</div>&nbsp;{lang('Files','import_export')}:
                                            </span>

                                            <div class="controls">
                                                <label class="btn-mini btn import_slot">
                                                    <input checked="checked" type="radio" value="1" id="csv" name="csvfile" />
                                                    <span>CSV/XLS/XLSX File slot #1</span>
                                                </label>&nbsp;
                                                <span class="help-inline fileCreateTime" data-file="product_csv_1csv">{$filesInfo.product_csv_1csv}</span>
                                            </div>
                                        </div>
                                        <!-- End. First of tree slots markup -->

                                        <!-- Start. Second of tree slots markup -->
                                        <div class="control-group">
                                            <span class="control-label"></span>
                                            <div class="controls">
                                                <label class="btn-mini btn import_slot">
                                                    <input type="radio" value="2" id="csv" name="csvfile" />
                                                    <span>CSV/XLS/XLSX File slot #2</span>
                                                </label>&nbsp;
                                                <span class="help-inline fileCreateTime" data-file="product_csv_2csv">{$filesInfo.product_csv_2csv}</span>
                                            </div>
                                        </div>
                                        <!-- End. First of tree slots markup -->

                                        <!-- Start. third of tree slots markup -->
                                        <div class="control-group">
                                            <span class="control-label"></span>
                                            <div class="controls">
                                                <label class="btn-mini btn import_slot">
                                                    <input type="radio" value="3" id="csv" name="csvfile" />
                                                    <span>CSV/XLS/XLSX File slot #3</span>
                                                </label>&nbsp;
                                                <span class="help-inline fileCreateTime" data-file="product_csv_3csv">{$filesInfo.product_csv_3csv}</span>
                                            </div>
                                        </div>
                                        <!-- End. third of tree slots markup -->

                                        <!-- Start. Wrap for file attributes showing -->
                                        <div class="attrHandler">
                                            {include_tpl('import_attributes')}
                                        </div>
                                        <!-- End. Wrap for file attributes showing -->
                                        <!-- Start. Let's go Button ;) -->
                                        <span class="controls span10">
                                            <span data-title="" class="popover_ref" data-original-title="">
                                                <i class="icon-info-sign"></i>
                                            </span>

                                            <div class="d_n">
                                                <b>{lang('Make changes, if the fields are empty','import_export')}<br/>
                                                {lang('Relates to the fields of','import_export')}:<br/></b>
                                                {lang('Short description', 'import_export')}<br/>
                                                {lang('Full description', 'import_export')}<br/>
                                                {lang('Meta Title', 'import_export')}<br/>
                                                {lang('Meta Description', 'import_export')}<br/>
                                                {lang('Meta Keywords', 'import_export')}<br/>
                                                {lang('Price', 'import_export')}<br/>
                                                {lang('Old Price', 'import_export')}<br/>                                                
                                                {lang('Amount', 'import_export')}<br/>
                                                {lang('Variant name', 'import_export')}<br/>
                                                {lang('Additional categories', 'import_export')}<br/>                                            
                                            </div>
                                            <label class="" style="display: inline;">
                                                <input class="v-a_m" style="position: relative; top: 2px; margin: 0 2px;" type="checkbox" value="true" name="EmptyFields">
                                                <span>{lang('Insert an empty field','import_export')}</span>
                                            </label>
                                        </span>
                                        <span class="controls span10">
                                            <span data-title="&lt;b&gt;Backup&lt;/b&gt;" class="popover_ref" data-original-title="">
                                                <i class="icon-info-sign"></i>
                                            </span>
                                            <div class="d_n">{lang('The data of your database will be stored in the folder','import_export')} {echo BACKUPFOLDER}</div>
                                            <label class="" style="display: inline;">
                                                <input class="v-a_m" style="position: relative; top: 2px; margin: 0 2px;" type="checkbox" {if $withBackup}checked="checked"{/if} value="true" name="withBackup">
                                                <span>{lang('Take a snapshot of the database before start','import_export')}</span>
                                            </label>
                                        </span>

                                        <span class="controls span10">
                                            <span data-title="&lt;b&gt;{lang('Resize','import_export')}&lt;/b&gt;" class="popover_ref" data-original-title="">
                                                <i class="icon-info-sign"></i>
                                            </span>
                                            <div class="d_n">
                                                {lang('For imported images will be produced resize','import_export')} <br>
                                                {lang('It may take more time','import_export')}
                                            </div>
                                            <label class="" style="display: inline;">
                                                <input class="v-a_m" style="position: relative; top: 2px; margin: 0 2px;" type="checkbox" value="true" name="withResize">
                                                <span>{lang('Start resize images after import','import_export')}</span>
                                            </label>
                                        </span>

                                        <span class="controls span10">
                                            <span data-title="&lt;b&gt;{lang('Price checking','import_export')}&lt;/b&gt;" class="popover_ref" data-original-title="">
                                                <i class="icon-info-sign"></i>
                                            </span>
                                            <div class="d_n">
                                                {lang('Will be recalculated prices of products in accordance to the default currency','import_export')}
                                            </div>
                                            <label class="" style="display: inline;">
                                                <input class="v-a_m" style="position: relative; top: 2px; margin: 0 2px;" type="checkbox" value="true" name="withCurUpdate">
                                                <span>{lang('Refresh prices after import','import_export')}</span>
                                            </label>
                                        </span>

                                        <div class="control-group">
                                            <span class="controls span2">
                                                <input class="attributes" type="hidden" name="attributes" value="" />
                                                <button class="btn btn-success" type="submit">{lang('Start import','import_export')}</button
                                                </span>
                                            </div>
                                            <!-- End. Let's go Button ;) -->
                                        </div>
                                        <input type="hidden" value=";" name="delimiter" />
                                        <input type="hidden" value="&#34;" name="enclosure"/>
                                        <input type="hidden" value="utf-8" name="encoding"/>
                                        <input type="hidden" value="ProductsImport" name="import_type"/>
                                        {/*}<input type="hidden" value="{echo $mainLangIdentif}" name="mainLanguage"/>{ */}
                                        <input type="hidden" value="{echo $currencies[0]->id}" name="currency"/>
                                        {form_csrf()}
                                    </form>
                                    <!-- End. Choose file and load to server on checked slot  -->
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <label id="progressLabel"></label>
                                <div class="progress progress-striped active" id="progressBlock" style="display:none;margin-top:15px;">
                                    <div id="percent" class="bar" style="width: 1%;">
                                        <div style="position: relative; top:1px">
                                            <span id="ratio" style="color: black;"></span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
