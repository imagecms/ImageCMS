<div class="container">
    
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">User support</span>
            </div>
                            <div class="pull-right">
                    <div class="d-i_b">
                        <a href="/admin/components/init_window/user_support/create_department" class="pjax btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('amt_create_department')}</a>
                    </div>
                </div>
            </div>
            <div class="clearfix">
                <div class="btn-group m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="/admin/components/init_window/user_support" class=" pjax btn btn-small">{lang('amt_all_tickets')}</a>
                    <a href="/admin/components/init_window/user_support/departments" class=" active pjax btn btn-small">{lang('amt_departments')}</a>
                </div>   
            </div>
       
            {if $departments}
                <table id="departments_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
                    <thead>
                    <th class="span2">ID</th>
                        <th>{lang('amt_tname')}</th>
                        <th class="span2"></th>
                    </thead>
                <tbody>

		{foreach $departments as $d}
            <tr>
                <td>{$d.id}</td>
                <td>
                    <a href="/admin/components/cp/user_support/edit_department/{$d.id}" class="pjax">{truncate($d.name, 70, '...')}</a>
                </td>
                <td>
                    <button onclick="USTickets.deleteDepartment({$d.id})" class="btn btn-small btn-danger"><i class="icon-white icon-trash"></i> {lang('a_delete')}</button>
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