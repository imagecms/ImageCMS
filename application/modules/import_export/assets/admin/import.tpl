<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Import-Export CSV/XLS','import_export')}</span>
        </div>
        <div class="clearfix">
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/init_window/import_export" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'import_export')}</span></a>                        
                </div>
            </div>
        </div>
    </div>
    <div class="content_big_td">
        <div class="tab-content">
            <div class="tab-pane active" id="importcsv">
                <table class="table table-striped table-bordered table-hover table-condensed t-l_a">
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
                                    <div class="fortextblock inside_padd span9">
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
                                        <div class="inside_padd span9 form-horizontal row-fluid">

                                            <!-- Start. First of tree slots markup -->
                                            <div class="control-group">
                                                <span class="control-label">
                                                    <span data-title="&lt;b&gt;CSV/XLS/XLSX&lt;/b&gt;" class="popover_ref" data-original-title="">
                                                        <i class="icon-info-sign"></i>
                                                    </span>
                                                    <div class="d_n">{lang('Select the file in a convenient format','import_export')}</div>&nbsp;{lang('Files','import_export')}
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
                                                <span data-title="&lt;b&gt;Backup&lt;/b&gt;" class="popover_ref" data-original-title="">
                                                    <i class="icon-info-sign"></i>
                                                </span>
                                                <div class="d_n">{lang('The data of your database will be stored in the folder','import_export')} {echo BACKUPFOLDER}</div>
                                                <label class="" style="display: inline;">
                                                    <input class="btn btn-small action_on" type="checkbox" {if $withBackup}checked="checked"{/if} value="true" name="withBackup">
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
                                                    <input class="btn btn-small action_on" type="checkbox" value="true" name="withResize">
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
                                                    <input class="btn btn-small action_on" type="checkbox" value="true" name="withCurUpdate">
                                                    <span>{lang('Refresh prices after import','import_export')}</span>
                                                </label>
                                            </span>

                                            <!--<div class="control-group">
                                                <label class="control-label">{lang('Import language ','import_export')}:</label>
                                                <div class="controls">
                                                    <select name="language">
                                            {foreach $languages as $language}
                                                <option value="$language->identif" {if $language->default == 1}selected="selected"{/if}>{echo $language->lang_name}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>-->

                                            <div class="control-group">
                                                <span class="controls span2">
                                                    <input class="attributes" type="hidden" name="attributes" value="" />
                                                    <input class="btn btn-small disable action_on" type="submit" value="{lang('Start import','import_export')}">
                                                </span>
                                            </div>
                                            <!-- End. Let's go Button ;) -->
                                        </div>
                                        <input type="hidden" value=";" name="delimiter" />
                                        <input type="hidden" value="&#34;" name="enclosure"/>
                                        <input type="hidden" value="utf-8" name="encoding"/>
                                        <input type="hidden" value="ProductsImport" name="import_type"/>
                                        <input type="hidden" value="{echo $languages[0]->identif}" name="language"/>
                                        <input type="hidden" value="{echo $currencies[0]->id}" name="currency"/>
                                        {form_csrf()}
                                    </form>
                                    <!-- End. Choose file and load to server on checked slot  -->
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div id="progressBlock" style="display:none;margin-top:15px;">
                                    <label id="progressLabel"></label>
                                    <div class="progress progress-striped active" style="margin-top:15px;">
                                        <div id="percent" class="bar" style="width: 1%;">
                                            <div style="position: relative; top:1px">
                                                <span id="ratio"></span>
                                            </div>                                                
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
