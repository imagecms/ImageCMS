<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_event_journal')}</span>
            </div>                                                   
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="modules">
                <div class="row-fluid">
                    <div class="form-horizontal">
                        <table class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                                <tr>                                              
                                    <th class="span2">{lang('a_us_in_admin')}</th>
                                    <th class="span3">{lang('a_d_m_admin')}</th>
                                    <th class="span5">{lang('a_action_admin')}</th>
                                </tr>
                            </thead>
                            <tbody class="sortable ui-sortable">
                                {foreach $messages as $m}                                  
                                <td><p>{$m.username}</p></td>
                                <td><p>{date('d-m-Y H:i:s', $m.date)}</p></td>
                                <td><p>{$m.message}</p></td>
                                </tr>
                            {/foreach}                                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>   
            <div class="clearfix">
                    {$paginator}
            </div>
    </section>
</div>