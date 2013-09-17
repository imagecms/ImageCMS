<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Found less expensive', 'found_less_expensive')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a class="btn btn-small pjax" href="/admin/components/cp/found_less_expensive/settings"><i class="icon-wrench"></i>{lang('Settings', 'found_less_expensive')}</a>
            </div>
        </div>    
    </div>
    <div class="btn-group myTab m-t_20">
        <a class="btn btn-small pjax {if $status == 'all' OR $status== NULL}active{/if}" href="/admin/components/cp/found_less_expensive/index/status/all/0">{lang('All', 'found_less_expensive')}
            {if $countAll}
                <span id="countAll" data-statusTab="all" style="top:-13px;" class="badge badge-important">
                    {echo $countAll}
                </span>
            {/if}
        </a>
        <a class="btn btn-small pjax {if $status == 'new'}active{/if}" href="/admin/components/cp/found_less_expensive/index/status/new/0">{lang('New', 'found_less_expensive')}
                <span id="countNew" data-statusTab="new" style="top:-13px;" class="badge badge-important">{echo $countNew}</span>
        </a>
        <a class="btn btn-small pjax {if $status == 'approved'}active{/if}" href="/admin/components/cp/found_less_expensive/index/status/approved/0">{lang('Processed', 'found_less_expensive')}
            <span id="countAccepted" data-statusTab="accepted" style="top:-13px;" class="badge badge-important">
                {echo $countAccepted}
            </span>
        </a>
    </div>
    <div class="tab-content">
        {if count($data) > 0}
            <div class="tab-pane active" id="modules">
                <div class="row-fluid">
                   <table class="table table-striped table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="t-a_c span1"></th>
                            <th class="span1">{lang('ID', 'found_less_expensive')}</th>
                            <th class="span4">{lang('Contact information', 'found_less_expensive')}</th>
                            <th class="span4">{lang('Question', 'found_less_expensive')}</th>
                            <th class="span5">{lang('Product link', 'found_less_expensive')}</th>
                            <th class="span5">{lang('Page', 'found_less_expensive')}</th>
                            <th class="span3">{lang('Status', 'found_less_expensive')}</th>
                            <th class="span3">{lang('Date', 'found_less_expensive')}</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        {foreach $data as $d}
                            <tr data-id="{echo $d['id']}">
                                <td class="t-a_c span1">
                                    <span class="frame_label">
                                        <a href="#" class="btn btn-small my_btn_s" onclick="expensive.deleteOne({echo $d['id']}, this)"><i class="icon-trash"></i></a>
                                    </span>
                                </td>
                                <td>{echo $d['id']}</td>
                                <td>
                                {echo $d['name']}<br/>
                                {echo $d['email']}<br/>
                                {echo $d['phone']}</td>
                                <td>{echo $d['question']}</td>
                                <td><a href="{echo $d['link']}" target="blank">{echo $d['link']}</a></td>
                                <td><a href="{echo $d['productUrl']}" target="blank">{echo $d['productUrl']}</a></td>
                                <td> 
                                    <select class="statusSelect" data-id="">
                                        <option {if $d['status'] == '0'}selected{/if} data-status="countNew" data-statusNumber="0">{lang('New', 'found_less_expensive')}</option>
                                        <option {if $d['status'] == '1'}selected{/if} data-status="countAccepted" data-statusNumber="1">{lang('Processed', 'found_less_expensive')}</option>
                                    </select>
                                </td>
                                <td>{date('d-m-Y H:i:s',$d['date'])}</td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table> 
            </div>
        </div>
    {else:}
        </br>
        <div class="alert alert-info">
            {lang('No data has been found', 'found_less_expensive')}
        </div>
    {/if}
</div>
<div class="clearfix">
    {echo $pagination}
</div>
</section>
