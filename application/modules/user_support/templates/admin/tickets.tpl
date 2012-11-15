<div class="container">
    
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">User support</span>
            </div>
            </div>
            <div class="clearfix">
                <div class="btn-group m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="/admin/components/init_window/user_support" class="active pjax btn btn-small active">{lang('amt_all_tickets')}</a>
                    <a href="/admin/components/init_window/user_support/departments" class="pjax btn btn-small">{lang('amt_departments')}</a>
                </div>   
            </div>
        
        
            {if $tickets}
                <table id="tickets_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
                    <thead>
                        <th class="span1">ID</th>
                        <th class="span3">{lang('amt_theme')}</th>
                        <th class="span2">{lang('amt_dep')}</th>
                        <th class="span2">{lang('amt_author')}</th>
                        <th class="span2">{lang('amt_status')}</th>
                        <th class="span2">{lang('amt_prior')}</th>
                        <th >{lang('amt_cr')}</th>
                        <th >{lang('amt_up')}</th>
                        <th class="span2"></th>
                    </thead>
                    <tbody>

                {foreach $tickets as $t}
                        <tr id="{$page.number}">
                            <td>{$t.id}</td>
                            <td title="{$t.theme}">
                                <a href="/admin/components/cp/user_support/view_ticket/{$t.id}" class="pjax" >{truncate($t.theme, 70, '...')}</a>
                            </td>
                            <td>{get_department_name($t.department)}
                            </td>
                            <td>{$t.author}</td>
                            <td><font color="{get_status_color($t.status)}">{get_status_text($t.status)}</font></td>
                            <td><font color="{get_priority_color($t.priority)}">{get_priority_text($t.priority)}</font></td>
                            <td>{date('d-m-Y', $t.date)}</td>
                            <td>{date('d-m-Y', $t.updated)}</td>
                            <td>
                                <button onclick="USTickets.deleteOne({$t.id})" class="btn btn-small btn-danger"><i class="icon-white icon-trash"></i> {lang('a_delete')}</button>
                            </td>
                        </tr>
                            {/foreach}
                    </tbody>
              </table>

            {else:}
                <br/>
                <div class="alert alert-info">
                    No tickets avaliable
                </div>
            {/if}
</section>
</div>
<script src="/application/modules/user_support/templates/admin/admin.js"></script>