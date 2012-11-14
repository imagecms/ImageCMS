<div class="container">
    <form method="post" action="{$ADMIN_URL}orderstatuses/savePositions" id="orderStatusesList">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('amt_poll_list')}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <a  href="/admin/components/cp/polls/create" class="pjax btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('a_create')}</a>
                    </div>
                </div>                            
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    
                    
                    {if $polls->num_rows()==0}
                        <br/>
                        <div class="alert alert-info">
                            {lang('amt_empty_poll_list')}
                        </div>
                    {else:}
                    
                    <table class="table table-striped table-bordered table-hover table-condensed">
                        <thead>
                            <tr>
                                <th class="span1">ID</th>
                                <th class="span4">{lang('a_name')}</th>
                                <th class="span1">{lang('a_delete')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $polls->result_array() as $poll}
                                
                            <tr>
                                <td>{$poll.id}</td>
                                <td>
                                    <a href="/admin/components/cp/polls/edit/{$poll.id}" data-rel="tooltip" data-title="{lang('a_edit_poll')}">{$poll.name}</a>
                                </td>
                                <td>
                                    <a href="#" onclick="polls.deleteOne({$poll.id}); return false;" class="btn btn-small btn-danger my_btn_s"> <i class="icon-trash icon-white"></i> {lang('a_delete')} </a>
                                </td>
                            </tr>
                            {/foreach}    
                        </tbody>
                    </table>
                        
                    {/if}    
                </div>
            </div>
        </section>
    </form>
</div>
<script src="/application/modules/polls/templates/admin/admin.js"></script>