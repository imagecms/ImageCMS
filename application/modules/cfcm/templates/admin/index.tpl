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
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table t-l_a">
                            <thead>
                                <tr>
                                    <th>{lang("Label", 'cfcm')}</th>
                                    <th>{lang("Name", 'cfcm')}</th>
                                    <th>{lang("Type", 'cfcm')}</th>
                                    <th>{lang("Categories", 'cfcm')}</th>
                                    <th>{lang("Delete", 'cfcm')}</th>
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
                        <table class="table table-striped table-bordered table-hover table-condensed pages-table t-l_a">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>{lang("Name", 'cfcm')}</th>
                                    <th>{lang("Description", 'cfcm')}</th>
                                    <th>{lang('Fields', 'cfcm')}</th>
                                    <th>{lang("Delete", 'cfcm')}</th>
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