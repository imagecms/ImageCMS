<table class="table table-condensed span9">
    <tbody>
        <tr>
            <td colspan="9">
                <div class="inside_padd">
                    <div class="form-horizontal">
                        <div class="row-fluid">
                            <div class="control-group">
                                <label class="control-label"> {lang('Quantity of words', 'mod_stats')} :</label>
                                <div class="controls number">
                                    <input id="quantityOfWordsStatsSearch" class="input-small required f_l" style="display: block; " type="text" name="value" maxlength="1">
                                    <span class="frame_label no_connection m-r_15 m-l_40 m-t_10">
                                        <span class="niceCheck"style="background-position: -46px 0px;">
                                            <input type="checkbox" id="useLocaleCheckbox">
                                        </span> 
                                        {lang('Consider the current language', 'mod_stats')}
                                    </span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"> {lang('Count of results', 'mod_stats')} :</label>
                                <div class="controls number">
                                    <input id="resultsStatsSearch" class="input-small required" type="text" name="value" maxlength="2">
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
