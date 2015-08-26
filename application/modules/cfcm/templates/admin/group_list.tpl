<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang("Field constructor", 'cfcm')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="#" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Go back", 'cfcm')}</span></a>
                <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#add_page_form"><i class="icon-ok"></i>{lang("Save", 'cfcm')}</button>
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
    <div class="tab-content">

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
                    <a  data-rel="tooltip" data-title="{lang("Edit custom group", 'cfcm')}" href="javascript:ajax_div('page', base_url + 'admin/components/cp/cfcm/edit_group/{$g.id}');">{$g.name}</a>
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
{*/}