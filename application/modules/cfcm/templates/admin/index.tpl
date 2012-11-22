<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title w-s_n">{lang('a_field_constructor')}</span>
        </div>

        <div class="pull-right">
            <span class="help-inline"></span>
            <div class="d-i_b">
                <a href="/admin/components/cp/cfcm/create_field" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('a_add_field')}</a>
                <a href="/admin/components/cp/cfcm/create_group" class="btn btn-small btn-success pjax" ><i class=" icon-plus-sign icon-white"></i>{lang('a_create_group_')}</a>				
            </div>
        </div>                            
    </div>           
    <div class="row-fluid">
        <div class="span7" >
            <h4>{lang('a_additional_fields')}</h4>
            <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                <thead>
                    <tr>
                        <th class="span2">{lang('a_label')}</th>
                        <th class="span2">{lang('a_name')}</th>
                        <th class="span1">{lang('a_type')}</th>
                        <th class="span2">{lang('a_category')}</th>
                        <th class="span1">{lang('a_delete')}</th>
                    </tr>
                </thead>
                <tbody class="sortable">
                    {$groupRels = $this->CI->db->get('content_fields_groups_relations')->result_array()}
                    {foreach $fields as $f}
                    <tr>
                        <td>
                            <a href="/admin/components/cp/cfcm/edit_field/{$f.field_name}" class="pjax" data-rel="tooltip" data-title="{lang('a_edit')}">{$f.label}</a>
                        </td>
                        <td>{$f.field_name}</td>
                        <td>{$f.type}</td>
                        <td>
                            {$i=0}
                            {$arr = array()}
                            {foreach $groupRels as $gr}
                                {if $gr['field_name'] == $f.field_name}
                                    {if $arr[] = $gr['group_id']}
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
                        <td align="right">
                            <button onclick="CFAdmin.deleteOne('{$f.field_name}'); return false;" class="btn btn-small btn-danger my_btn_s" data-rel="tooltip" data-title="{lang('a_delete')}"> <i class="icon-trash icon-white"></i></button>
                        </td>
                    </tr>        
                    {/foreach}
                </tbody>
            </table>

        </div>
        <div class="span5">

            <h4>{lang('a_field_groups')}</h4>
            <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                <thead>
                    <tr>
                        <th class="span1">ID</th>
                        <th class="span1">{lang('a_name')}</th>
                        <th class="span2">{lang('a_description')}</th>
                        <th class="span1">{lang('a_fields')}</th>
                        <th class="span1">{lang('a_delete')}</th>
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
                        <td align="right">
                            <button onclick="CFAdmin.deleteOneGroup({$g.id}); return false;" class="btn btn-danger btn-small my_btn_s" data-rel="tooltip" data-title="{lang('a_delete')}"> <i class="icon-trash icon-white"></i></button>
                        </td>
                    </tr>        
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="span3" >

        </div>

    </div>
</section>