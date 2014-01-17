<div class="span8">
    <label> {lang('Product / ID', 'mod_stats')} :</label>
    <div class="span6 d_i-b m-l_0">
        <input id="productForStats" type="text" value="" class="ui-autocomplete-input d-i_b" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
        <input id="statsProductId" type="hidden" name="productId" value="">
    </div>
    <div class="span2"> 
        <a class="btn btn-small" id="productInfoButtonShow">
            <i class="icon-share-alt">
            </i>
            {lang('Show','mod_stats')}
        </a>
    </div>
</div>
<div id="productInfoTableContainer" style="display: none;">
    <table class="table table-striped table-bordered table-condensed content_big_td">
        <thead>
            <tr>
                <th class="span8">{lang('Product name','mod_stats')}</th>
                <th>{lang('Count of purchasses','mod_stats')}</th>
<!--                <th>{lang('Count of comments','mod_stats')}</th>-->
                <th>{lang('Rating','mod_stats')}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td id="productInfoTableValueName"></td>
                <td id="productInfoTableValueCountOfPurchasses"></td>
<!--               <td id="productInfoTableValueCommentsCount"></td>-->
                <td id="productInfoTableValueRating"></td>
            </tr>
        </tbody>
    </table>
</div>