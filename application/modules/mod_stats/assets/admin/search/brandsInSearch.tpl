<table class="table table-condensed span12">
    <tbody>
        <tr>
            <td colspan="9">
                <div class="inside_padd">
                    <div class="form-horizontal">
                        <div class="row-fluid">
                            <div class="control-group">
                                <label class="control-label"> {lang('Quantity of words', 'mod_stats')} :</label>
                                <div class="controls number">
                                    <input id="quantityOfWordsStatsSearch" class="input-small required f_l" 
                                           value="{if $_COOKIE['words_quantity_search_stats'] != null}{echo $_COOKIE['words_quantity_search_stats']}{else:}0{/if}" 
                                           style="display: block; " type="text" name="value" maxlength="1"/>
                                    
                                    <span class="frame_label no_connection m-r_15 m-l_40 m-t_10">
                                        <span class="" style="background-position: -46px 0px;">
                                            <input type="checkbox" id="useLocaleCheckbox" {if $_COOKIE['use_locale_search_stats'] == 'true'} checked="checked" {/if}/>
                                        </span> 
                                        {lang('Consider the current language', 'mod_stats')}
                                    </span>
                                    
                                
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"> {lang('Count of results', 'mod_stats')} :</label>
                                <div class="controls number">
                                    <input id="resultsStatsSearch" class="input-small required" 
                                           value="{if $_COOKIE['results_quantity_search_stats'] != null}{echo $_COOKIE['results_quantity_search_stats']}{else:}0{/if}" 
                                           type="text" name="value" maxlength="2">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <a class="btn btn-small" id="startBrandsAnalisInSearch" style="margin-right: 80px;">
                                        <i class="icon-share-alt">
                                        </i>
                                        {lang('Starting the analysis','mod_stats')}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>
<div class="chartBlock" style="display: none;">                                    
    <div class="span2 chartTypeSwitcher">
        <div class="d-i_b">
            <select id="selectChartType">
                <option value="pieChart">{lang('pie', 'mod_stats')}   </option>
                <option value="barChart">{lang('bar', 'mod_stats')}   </option>
            </select>
        </div>
    </div>
    <div id="pieChart" class="hideChart">
        <svg style="height: 500px;"></svg>
    </div>
    <div id="barChart" class="hideChart span12" style="display: none;">
        <svg style="height: 500px; width: 800px;"></svg>
    </div>
</div>
