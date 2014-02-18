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
        {include_tpl('include/left_block')}
        <div class="clearfix span9" id="chartArea">
            <table id="common-info-table">
                <tr>
                    <td>{lang('Unique visitors count (all time)','mod_stats')}</td>
                    <td>{$countUniqueUsers}</td>                    
                </tr>
                <tr>
                    <td>{lang('Count of robots (all time)','mod_stats')}</td>
                    <td>{$countUniqueRobots}</td>                    
                </tr>
                <!--tr>
                    <td>{lang('Count of redirects from search engines','mod_stats')}</td>
                    <td>{lang('No data','mod_stats')}</td>                    
                </tr>
                <tr>
                    <td>{lang('Count of redirects from other sites','mod_stats')}</td>
                    <td>{lang('No data','mod_stats')}</td>                    
                </tr-->
                <tr>
                    <td>{lang('Last viewed page','mod_stats')}</td>
                    <td>
                        {if !empty($lastPage)}
                            <a href="/{$lastPage['url']}">{$lastPage['page_name']}</a> by <strong> {$lastPage['username']} </strong>
                        {else:}
                            {lang('No data','mod_stats')}
                        {/if}

                    </td>                    
                </tr>
            </table>

        </div>
    </div>



</section>