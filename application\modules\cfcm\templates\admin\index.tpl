        <section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Field constructor", 'cfcm')}</span>
        </div>
    </div>
    <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
        <a href="#additional_fields" class="btn btn-small active" onclick="$('#allM').html('{lang("All modules", 'cfcm')}')">{lang("Additional fields", 'cfcm')}</a>
        <a href="#fields_groups" class="btn btn-small" onclick="$('#allM').html('{lang("Install modules", 'cfcm')}')">{lang('Fields groups', 'cfcm')}</a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="additional_fields">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_field" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('Add field', 'cfcm')}</a>
                        </div>
                    </div>                            
                    <h4>{lang("Additional fields", 'cfcm')}</h4>
                    {if !empty($fields)}
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                            <thead>
                                <tr>
                                    <th class="span2">{lang("Label", 'cfcm')}</th>
                                    <th class="span2">{lang("Name", 'cfcm')}</th>
                                    <th class="span1">{lang("Type", 'cfcm')}</th>
                                    <th class="span3">{lang("Categories", 'cfcm')}</th>
                                    <th class="span1">{lang("Delete", 'cfcm')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $fields as $f}
                                    <tr>
                                        <td>
                                            <a href="/admin/components/cp/cfcm/edit_field/{$f.field_name}" class="pjax" data-rel="tooltip" data-title="{lang("Editing", 'cfcm')}">{$f.label}</a>
                                        </td>
                                        <td>{$f.field_name}</td>
                                        <td>{$f.type}</td>
                                        <td>
                                            {$i=0}
                                            {$arr = array()}
                                            {foreach $groupRels as $gr}
                                                {if $gr['field_name'] == $f.field_name}
                                                    {if $gr.group_id == -1}{$arr[] =lang('Without catagory',"cfcm")}{/if}
                                                    {if $arr[] = $gr['name']}
                                                        {$i++}
                                                    {/if}
                                                {/if}
                                            {/foreach}
                                            {if !$i}
                                                0
                                            {else:} 
                                                {echo implode(', ', array_unique($arr))}
                                            {/if}
                                        </td>
                                        <td class="t-a_c">
                                            <button onclick="CFAdmin.deleteOne('{$f.field_name}');
                    return false;" class="btn btn-small btn-danger my_btn_s" data-rel="tooltip" data-title="{lang("Delete", 'cfcm')}"> <i class="icon-trash icon-white"></i></button>
                                        </td>
                                    </tr>        
                                {/foreach}
                            </tbody>
                        </table>
                    {else:}        
                        <div class="alert alert-info">
                            {lang('List of additional fields is empty', 'cfcm')}
                        </div>
                    {/if}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="fields_groups">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_group" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('Create group', 'cfcm')}</a>				
                        </div>
                    </div>
                    <h4>{lang('Field groups', 'cfcm')}</h4>
                    {if !$groups}
                        <div class="alert alert-info">
                           {lang("No groups", "cfcm")}
                        </div>
                    {else:}
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                            <thead>
                                <tr>
                                    <th class="span1">ID</th>
                                    <th class="span1">{lang("Name", 'cfcm')}</th>
                                    <th class="span2">{lang("Description", 'cfcm')}</th>
                                    <th class="span1">{lang('Fields', 'cfcm')}</th>
                                    <th class="span1">{lang("Delete", 'cfcm')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {foreach $groups as $g}
                                        <tr>
                                            <td>{$g.id}</td>
                                            <td>
                                                <a href="/admin/components/cp/cfcm/edit_group/{$g.id}" class="pjax">{$g.name}</a>
                                            </td>
                                            <td>{truncate($g.description, 35)}</td>
                                            <td>
                                                {echo $this->CI->db->get_where('content_fields_groups_relations', array('group_id' => $g.id))->num_rows()}
                                            </td>
                                            <td class="t-a_c">
                                                <button onclick="CFAdmin.deleteOneGroup({$g.id});
                        return false;" class="btn btn-danger btn-small my_btn_s" data-rel="tooltip" data-title="{lang("Delete", 'cfcm')}"> <i class="icon-trash icon-white"></i></button>
                                            </td>
                                        </tr>        
                                    {/foreach}
                            </tbody>
                        </table>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</section>3333
        
        <section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Field constructor", 'cfcm')}</span>
        </div>
    </div>
    <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
        <a href="#additional_fields" class="btn btn-small active" onclick="$('#allM').html('{lang("All modules", 'cfcm')}')">{lang("Additional fields", 'cfcm')}</a>
        <a href="#fields_groups" class="btn btn-small" onclick="$('#allM').html('{lang("Install modules", 'cfcm')}')">{lang('Fields groups', 'cfcm')}</a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="additional_fields">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_field" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('Add field', 'cfcm')}</a>
                        </div>
                    </div>                            
                    <h4>{lang("Additional fields", 'cfcm')}</h4>
                    {if !empty($fields)}
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                            <thead>
                                <tr>
                                    <th class="span2">{lang("Label", 'cfcm')}</th>
                                    <th class="span2">{lang("Name", 'cfcm')}</th>
                                    <th class="span1">{lang("Type", 'cfcm')}</th>
                                    <th class="span3">{lang("Categories", 'cfcm')}</th>
                                    <th class="span1">{lang("Delete", 'cfcm')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $fields as $f}
                                    <tr>
                                        <td>
                                            <a href="/admin/components/cp/cfcm/edit_field/{$f.field_name}" class="pjax" data-rel="tooltip" data-title="{lang("Editing", 'cfcm')}">{$f.label}</a>
                                        </td>
                                        <td>{$f.field_name}</td>
                                        <td>{$f.type}</td>
                                        <td>
                                            {$i=0}
                                            {$arr = array()}
                                            {foreach $groupRels as $gr}
                                                {if $gr['field_name'] == $f.field_name}
                                                    {if $gr.group_id == -1}{$arr[] =lang('Without catagory',"cfcm")}{/if}
                                                    {if $arr[] = $gr['name']}
                                                        {$i++}
                                                    {/if}
                                                {/if}
                                            {/foreach}
                                            {if !$i}
                                                0
                                            {else:} 
                                                {echo implode(', ', array_unique($arr))}
                                            {/if}
                                        </td>
                                        <td class="t-a_c">
                                            <button onclick="CFAdmin.deleteOne('{$f.field_name}');
                    return false;" class="btn btn-small btn-danger my_btn_s" data-rel="tooltip" data-title="{lang("Delete", 'cfcm')}"> <i class="icon-trash icon-white"></i></button>
                                        </td>
                                    </tr>        
                                {/foreach}
                            </tbody>
                        </table>
                    {else:}        
                        <div class="alert alert-info">
                            {lang('List of additional fields is empty', 'cfcm')}
                        </div>
                    {/if}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="fields_groups">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_group" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('Create group', 'cfcm')}</a>				
                        </div>
                    </div>
                    <h4>{lang('Field groups', 'cfcm')}</h4>
                    {if !$groups}
                        <div class="alert alert-info">
                           {lang("No groups", "cfcm")}
                        </div>
                    {else:}
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                            <thead>
                                <tr>
                                    <th class="span1">ID</th>
                                    <th class="span1">{lang("Name", 'cfcm')}</th>
                                    <th class="span2">{lang("Description", 'cfcm')}</th>
                                    <th class="span1">{lang('Fields', 'cfcm')}</th>
                                    <th class="span1">{lang("Delete", 'cfcm')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {foreach $groups as $g}
                                        <tr>
                                            <td>{$g.id}</td>
                                            <td>
                                                <a href="/admin/components/cp/cfcm/edit_group/{$g.id}" class="pjax">{$g.name}</a>
                                            </td>
                                            <td>{truncate($g.description, 35)}</td>
                                            <td>
                                                {echo $this->CI->db->get_where('content_fields_groups_relations', array('group_id' => $g.id))->num_rows()}
                                            </td>
                                            <td class="t-a_c">
                                                <button onclick="CFAdmin.deleteOneGroup({$g.id});
                        return false;" class="btn btn-danger btn-small my_btn_s" data-rel="tooltip" data-title="{lang("Delete", 'cfcm')}"> <i class="icon-trash icon-white"></i></button>
                                            </td>
                                        </tr>        
                                    {/foreach}
                            </tbody>
                        </table>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</section><section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Field constructor", 'cfcm')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'cfcm')}</span></a>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form"><i class="icon-ok"></i>{lang("Save", 'cfcm')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#add_page_form"><i class="icon-check"></i>{lang("Save and exit", 'cfcm')}</button>

                <div class="dropdown d-i_b">
                    <a class="btn dropdown-toggle btn-small" data-toggle="dropdown" href="#">
                        {lang("Russian", 'cfcm')}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">{lang("English", 'cfcm')}</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="tab-content content_big_td">

        dsfk jhfjdhgj fgdjhfjhg  C O N T E N T

    </div>
</section>




{/*}
{$top_navigation}

<!--
{foreach $fields as $f}
    <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_field/{$f.field_name}');">{$f.type} {$f.field_name}</a>
    <br />
{/foreach}
-->

<div style="clear:both"></div>

{if $groups}
<div id="sortable" >
    <table id="cfcfm_fields_table">
        <thead>
        <th style="width:15px;">{lang("ID", 'cfcm')}</th>
        <th>{lang("Name", 'cfcm')}</th>
        <th>{lang("Description", 'cfcm')}</th>
        <th>{lang("Fields", 'cfcm')}</th>
        <th width="100px"></th>
        </thead>
        <tbody>
            {foreach $groups as $g}
            <tr>
                <td>{$g.id}</td>
                <td>
                    <a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_group/{$g.id}');">{$g.name}</a>
                </td>
                <td>{truncate($g.description, 35)}</td>
                <td>
                    {echo $this->CI->db->get_where('content_fields_groups_relations', array('group_id' => $g.id))->num_rows()}
                </td>
                <td align="right">
                    <img onclick="ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_group/{$g.id}');" style="cursor:pointer" src="{$THEME}/images/edit_page.png" width="16" height="16" title="{lang("Edit", 'cfcm')}" />
                    <img onclick="confirm_delete_cfcfm_group('{$g.id}');" src="{$THEME}/images/delete.png"  style="cursor:pointer" width="16" height="16" title="{lang("Delete", 'cfcm')}" /> 
                </td>
            </tr>
            {/foreach}
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>

{literal}
<script type="text/javascript">
    window.addEvent('domready', function(){
        cfcfm_fields_table = new sortableTable('cfcfm_fields_table', {overCls: 'over', sortOn: -1 ,onClick: function(){}});
        cfcfm_fields_table.altRow();
    });
</script>
{/literal}

{else:}
<div id="notice">
    {lang("Empty group list or group list is empty", 'cfcm')}<a href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/create_group');">{lang("Create a group", 'cfcm')}</a>
</div>
{/if}

{literal}
<script type="text/javascript">
    function confirm_delete_cfcfm_group(id)
    {
        alertBox.confirm('<h1> </h1><p>' + {/literal} {lang('Delete group', 'cfcm')} {literal} + 'ID: '+ id + '? </p>', {onComplete:
                function(returnvalue) {
                if(returnvalue)
                {
                    var req = new Request.HTML({
                        method: 'post',
                        url: base_url + 'admin/components/cp/cfcm/delete_group/' + id,
                        onComplete: function(response) {
                            ajax_div('page', base_url + 'admin/components/cp/cfcm/list_groups');
                        }
                    }).post();
                }
                else
                {

                }
            }
        });
    }
</script>
{/literal}
{*/}3333
        
        <section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Field constructor", 'cfcm')}</span>
        </div>
    </div>
    <div class="btn-group myTab m-t_10" data-toggle="buttons-radio">
        <a href="#additional_fields" class="btn btn-small active" onclick="$('#allM').html('{lang("All modules", 'cfcm')}')">{lang("Additional fields", 'cfcm')}</a>
        <a href="#fields_groups" class="btn btn-small" onclick="$('#allM').html('{lang("Install modules", 'cfcm')}')">{lang('Fields groups', 'cfcm')}</a>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="additional_fields">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_field" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('Add field', 'cfcm')}</a>
                        </div>
                    </div>                            
                    <h4>{lang("Additional fields", 'cfcm')}</h4>
                    {if !empty($fields)}
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                            <thead>
                                <tr>
                                    <th class="span2">{lang("Label", 'cfcm')}</th>
                                    <th class="span2">{lang("Name", 'cfcm')}</th>
                                    <th class="span1">{lang("Type", 'cfcm')}</th>
                                    <th class="span3">{lang("Categories", 'cfcm')}</th>
                                    <th class="span1">{lang("Delete", 'cfcm')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach $fields as $f}
                                    <tr>
                                        <td>
                                            <a href="/admin/components/cp/cfcm/edit_field/{$f.field_name}" class="pjax" data-rel="tooltip" data-title="{lang("Editing", 'cfcm')}">{$f.label}</a>
                                        </td>
                                        <td>{$f.field_name}</td>
                                        <td>{$f.type}</td>
                                        <td>
                                            {$i=0}
                                            {$arr = array()}
                                            {foreach $groupRels as $gr}
                                                {if $gr['field_name'] == $f.field_name}
                                                    {if $gr.group_id == -1}{$arr[] =lang('Without catagory',"cfcm")}{/if}
                                                    {if $arr[] = $gr['name']}
                                                        {$i++}
                                                    {/if}
                                                {/if}
                                            {/foreach}
                                            {if !$i}
                                                0
                                            {else:} 
                                                {echo implode(', ', array_unique($arr))}
                                            {/if}
                                        </td>
                                        <td class="t-a_c">
                                            <button onclick="CFAdmin.deleteOne('{$f.field_name}');
                    return false;" class="btn btn-small btn-danger my_btn_s" data-rel="tooltip" data-title="{lang("Delete", 'cfcm')}"> <i class="icon-trash icon-white"></i></button>
                                        </td>
                                    </tr>        
                                {/foreach}
                            </tbody>
                        </table>
                    {else:}        
                        <div class="alert alert-info">
                            {lang('List of additional fields is empty', 'cfcm')}
                        </div>
                    {/if}
                </div>
            </div>
        </div>
        <div class="tab-pane" id="fields_groups">
            <div class="row-fluid">
                <div>
                    <div class="pull-right frame_zH_frame_title">
                        <span class="help-inline"></span>
                        <div class="d-i_b">
                            <a href="/admin/components/cp/cfcm/create_group" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('Create group', 'cfcm')}</a>				
                        </div>
                    </div>
                    <h4>{lang('Field groups', 'cfcm')}</h4>
                    {if !$groups}
                        <div class="alert alert-info">
                           {lang("No groups", "cfcm")}
                        </div>
                    {else:}
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                            <thead>
                                <tr>
                                    <th class="span1">ID</th>
                                    <th class="span1">{lang("Name", 'cfcm')}</th>
                                    <th class="span2">{lang("Description", 'cfcm')}</th>
                                    <th class="span1">{lang('Fields', 'cfcm')}</th>
                                    <th class="span1">{lang("Delete", 'cfcm')}</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {foreach $groups as $g}
                                        <tr>
                                            <td>{$g.id}</td>
                                            <td>
                                                <a href="/admin/components/cp/cfcm/edit_group/{$g.id}" class="pjax">{$g.name}</a>
                                            </td>
                                            <td>{truncate($g.description, 35)}</td>
                                            <td>
                                                {echo $this->CI->db->get_where('content_fields_groups_relations', array('group_id' => $g.id))->num_rows()}
                                            </td>
                                            <td class="t-a_c">
                                                <button onclick="CFAdmin.deleteOneGroup({$g.id});
                        return false;" class="btn btn-danger btn-small my_btn_s" data-rel="tooltip" data-title="{lang("Delete", 'cfcm')}"> <i class="icon-trash icon-white"></i></button>
                                            </td>
                                        </tr>        
                                    {/foreach}
                            </tbody>
                        </table>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</section>