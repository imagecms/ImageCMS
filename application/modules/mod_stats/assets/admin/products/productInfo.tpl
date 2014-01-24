<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../left_block')}
        <div class="clearfix span9">
            {include_tpl('../time_and_filter_block_without_groupby_and_with_product_for_productInfo')}
            {if $product}
                <table class="table table-striped table-bordered table-condensed content_big_td">
                    <thead>
                        <tr>
                            <th class="span8">{lang('Product name','mod_stats')}</th>
                            <th>{lang('Count of purchasses','mod_stats')}</th>
            <!--                <th>{lang('Count of comments','mod_stats')}</th>-->
                            <!--<th>{lang('Rating','mod_stats')}</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$product['name']}</td>
                            <td>{$product['CountOfPurchasses']}</td>
                        </tr>
                    </tbody>
                </table>
            {else:}
                <p style="text-align: center;">There are no chosen products</p>
            {/if}
        </div>
    </div>

</section>
