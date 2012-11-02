<div class="container">
    
    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->    
    <div class="modal hide fade modal_del">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_menu_delete')}</h3>
        </div>
        <div class="modal-body">
            <p>{lang('a_delete_selected_menu')}</p>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" onclick="delete_function.deleteFunctionConfirm('/admin/components/cp/menu/delete_item')" >{lang('a_delete')}</a>
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
        </div>
    </div>

    <!-- ---------------------------------------------------Блок видалення---------------------------------------------------- -->
    
    <form method="post" action="#">
        <section class="mini-layout">
            <div class="frame_title clearfix">
                <div class="pull-left">
                    <span class="help-inline"></span>
                    <span class="title">{lang('a_menu')}: {echo $menu_title}</span>
                </div>
                <div class="pull-right">
                    <div class="d-i_b">
                        <a href="/admin/components/cp/menu" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                        <a type="button" class="btn btn-small btn-success createLink pjax" href="/admin/components/cp/menu/create_item/{$insert_id}"><i class="icon-list-alt icon-white"></i>{lang('a_create_link')}</a>
                        <button type="button" class="btn btn-small disabled action_on" onclick="delete_function.deleteFunction()"><i class="icon-trash"></i>{lang('a_delete')}</button>
                    </div>
                </div>                            
            </div>
            <div class="tab-content">
                <div class="row-fluid">
                    <div class="frame-table">
                        <div>
                            
                            <div class="row-category head">
                                <div class="t-a_c">
                                    <span class="frame_label">
                                        <span class="niceCheck" style="background-position: -46px 0px; ">
                                            <input type="checkbox">
                                        </span>
                                    </span>
                                </div>
                                <div>{lang('amt_id')}</div>
                                <div>{lang('amt_tname')}</div>
                                <div>{lang('amt_link')}</div>
                                <div>{lang('amt_type')}</div>
                            </div>
                        
                            <div class=" body_category frame_level">
                                <div class="sortable save_positions" data-url="/admin/components/cp/menu/save_positions">
                            
                            {$tree}
                            
                            {/*}
                            {foreach $menu_result as $item}
                                
                                <tr>
                                    <td class="t-a_c">
                                        <span class="frame_label">
                                            <span class="niceCheck b_n">
                                                <input type="checkbox" name="ids" value="{$item.id}"/>
                                            </span>
                                        </span>
                                    </td>
                                    <td><p>{$item.id}</p></td>
                                    <td>
                                        {if $item.padding == "0"}
                                            <a class="pjax" href="/admin/components/cp/menu/edit_item/{$item.id}/{$item.name}" style="padding-left:{$item.padding}px;">{$item.title}</a>
                                        {else:}
                                            {for $i=0; $i < $item['padding'];$i++}-&nbsp;{/for}<a href="/admin/components/cp/menu/edit_item/{$item.id}/{$item.name}" class="pjax" style="padding-left:{$item.padding}px;">{$item.title}</a>
                                        {/if}
                                        
                                    </td>
                                    <td class="share_alt">
                                        <a href="{site_url($item.url)}" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="перейти на сайт"><i class="icon-share-alt"></i></a>
                                        <a href="#">{$item.url}</a>
                                    </td>
                                    <td><p>{ switch $item['item_type'] }
                                            { case "page": }
                                            {lang('amt_page')}
                                            {break;}
                                            { case "category": }
                                            {lang('amt_category')}
                                            {break;}
                                            { case "module" }
                                            {lang('amt_module')}
                                            {break;}
                                            { case "url": }
                                            {lang('amt_url')}
                                            {break;}
                                            { /switch } </p></td>
                                    <td class="t-a_c">
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{lang('a_turn_on')}"  data-off="{lang('a_turn_off')}">
                                            <span class="prod-on_off item_hidden {if $item['hidden'] != "0"}disable_tovar{/if}" data-id="{$item['id']}"></span>
                                        </div>
                                    </td>
                                    <td class="t-a_c">
                                        {if count($langs) > 1}
                                            <a title="{lang('a_manu_item_translate')}" class="pjax" href="/admin/components/cp/menu/translate_window/{$item.id}"><img src="{$THEME}/images/translit.png" width="16" height="16" /></a> 	
                                        {/if}
                                    </td>
                                </tr>
                            {/foreach}
                            
                            {*/}
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>