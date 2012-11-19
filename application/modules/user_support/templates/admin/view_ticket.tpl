<section class="mini-layout">

    <div class="frame_title clearfix">
        <div class="w-s_n-w pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('amt_all_tickets')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/components/cp/user_support/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" class="btn btn-primary btn-small action_on formSubmit" data-form="#ticket_info_{$ticket.id}"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-action="close" data-form="#ticket_info_{$ticket.id}"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>                            
    </div>  

    <div class="clearfix">
        <div class="pull-right m-t_20">
            <a href="/user_support/ticket/{$ticket.id}" target="blank">{lang('a_view_on_site')}<span class="f-s_14">→</span></a>
        </div>
    </div>             
    <div id="content_big_td" class="tab-content">                

        <table class="table table-striped table-bordered table-hover table-condensed">

            <thead>
                <tr>
                    <th colspan="6">
                        {lang('a_info')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="span12">
                                <form action="{site_url('admin/components/cp/user_support/update_ticket/' . $ticket.id)}" method="POST" id="ticket_info_{$ticket.id}" class="form-horizontal">

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_ticket_theme')}: 
                                        </label>
                                        <div class="controls">
                                            {$ticket.theme}
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_ticket_num')}: 
                                        </label>
                                        <div class="controls">
                                            {$ticket.id}
                                        </div>
                                    </div>     

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_cr')}:
                                        </label>
                                        <div class="controls">
                                            {date('l, d F H:i', $ticket.date)}
                                        </div>
                                    </div>        
                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_up')}:
                                        </label>
                                        <div class="controls">
                                            {date('l, d F H:i', $ticket.updated)}
                                        </div>
                                    </div>              

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_description')}
                                        </label>
                                        <div class="controls">
                                            {$ticket.text}
                                        </div>
                                    </div>       

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_dep')}:
                                        </label>
                                        <div class="controls">
                                            <select name="department">
                                                {foreach $departments as $row}
                                                    <option value="{$row.id}" {if $row.id == $ticket.department}selected="selected"{/if}>{$row.name}</option>
                                                {/foreach}
                                            </select> 
                                        </div>
                                    </div>  

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_status')}:
                                        </label>
                                        <div class="controls">
                                            <select name="status">
                                                {foreach $statuses as $k => $v}
                                                    <option value="{$k}" {if $k == $ticket.status}selected="selected"{/if} style="color:{get_status_color($k)}">{get_status_text($k)}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>                

                                    <div class="control-group">
                                        <label class="control-label">
                                            {lang('amt_imp')}:
                                        </label>
                                        <div class="controls">
                                            <select name="priority">
                                                {foreach $priorities as $k => $v}
                                                    <option value="{$k}" {if $k == $ticket.priority}selected="selected"{/if} style="color:{get_priority_color($k)}">{get_priority_text($k)}</option>
                                                {/foreach}
                                            </select> 
                                        </div>
                                    </div>                


                                </form>

                              

                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <table class="table table-striped table-bordered table-hover table-condensed" id="comments">
        <thead>
            <tr>
                <th colspan="6">
                    {lang('amt_corresp')}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="span12">
                              {if $ticket.comments}
                                    {foreach $ticket.comments as $c}
                                            <div class="well row-fluid">
                                                <div class="span2">{lang('a_author')}:<br/>{$c.user_name}</div>    
                                                <div class="span5">{ucfirst(lang('a_message'))}:<br/>{$c.text}</div>
                                                <div class="span3">
                                                    {lang('amt_added')}:<br/> {date('Y-m-d H:i:s', $c.date)}
                                                </div>
                                                <div class="span2">
                                                    <button onclick="USTickets.deleteComment({$c.id})" class="btn btn-small btn-danger"><i class="icon-white icon-trash"></i> {lang('a_delete')}</button>
                                                </div>
                                            </div>
                                    {/foreach}
                                {/if}

                                <h4>{lang('amt_leave_message')}</h4>
                                <form action="{site_url('admin/components/cp/user_support/add_comment/' . $ticket.id)}" method="POST" id="add_ticket_comment_{$ticket.id}">
                                    <div class="form"> 
                                        <p>
                                            <textarea id="addMessage" name="text"></textarea>
                                            <br/>
                                            <button class="btn btn-success" onclick="USTickets.addComment({$ticket.id}, $('#addMessage').val()); return false;"><i class="icon-ok icon-white"></i> {lang('amt_send')}</button> 
                                        </p>
                                    </div>
                                </form>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</section>
<script src="/application/modules/user_support/templates/admin/admin.js"></script>