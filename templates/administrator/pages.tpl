    <div class="modal hide fade" id="pages_action_dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 id="mvMv">{lang('a_copy_move_title')}</h3>
        </div>
        <div class="modal-body">
            {lang('a_category')}:
            <select id="CopyMoveCategorySelect" url="{$BASE_URL}admin/pages/GetPagesByCategory/">
                <option value="0">{lang('a_without_cat')}</option>
                { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'] )); }
            </select>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
            <a href="#" id="confirmMove" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('{$BASE_URL}admin/pages/move_pages/copy')" >{lang('a_submit')}</a>
        </div>
    </div>

    <div class="modal hide fade" id="pages_delete_dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3>{lang('a_delete_pages_title')}</h3>
        </div>
        <div class="modal-body">
            {lang('a_delete_pages_promt')}
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('a_cancel')}</a>
            <a href="#" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('{$BASE_URL}admin/pages/delete_pages/')" >{lang('a_delete')}</a>
        </div>
    </div>

<form method="post" action="" class="listFilterForm" id="pagesFilterForm">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_cont_list')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <button type="button" class="btn btn-small disabled action_on listFilterSubmitButton " disabled="disabled" ><i class="icon-filter"></i>{lang('a_filtrate')}</button>
                    <button onclick="$('#pages_action_dialog').modal();" type="button" class="btn btn-small disabled action_on pages_action" ><i class="icon-asterisk"></i> {lang('a_copy_product')}</button>
                    <button onclick="$('#pages_action_dialog').modal();pagesAdmin.updDialogMove();" type="button" class="btn btn-small disabled action_on pages_action" ><i class="icon-move"></i>{lang('a_repalce')}</button>
                    <button onclick="$('#pages_delete_dialog').modal();pagesAdmin.updDialogCopy();" type="button" class="btn btn-small btn-danger disabled action_on pages_action pages_delete" ><i class="icon-trash icon-white"></i>{lang('a_delete')}</button>
                    <!--<button type="button" class="btn btn-small btn-success" onclick="window.location.href='{$BASE_URL}admin/pages'"><i class="icon-plus-sign icon-white"></i>{lang('a_create_page')}</button>-->
                    <a class="btn btn-small btn-success pjax" href='{$BASE_URL}admin/pages'><i class="icon-plus-sign icon-white"></i>{lang('a_create_page')}</a>
                </div>
            </div>                            
        </div>
        <div class="row-fluid">    
        {if $show_cat_list == 'yes'}
            <div class="span3">
                <ul class="nav nav-tabs nav-stacked">
                    <li class="nav-header">All categories</li>
                    <li {if '0'==$cat_id} class="active" {/if} ><a href="/admin/pages/GetPagesByCategory/0" class="pjax">{lang('a_without_cat')}</a></li>
                    <li {if 'all'==$cat_id} class="active" {/if}><a href="/admin/pages/GetPagesByCategory" class="pjax">Все категории</a></li>
                    </ul>
                    <ul class="nav nav-tabs nav-stacked">
                    {foreach $tree as $cat}
                    <li {if $cat_id==$cat.id} class="active" {/if}> <a  href="/admin/pages/GetPagesByCategory/{$cat.id}" class="pjax">{$cat.name}</a></li>
                    {if $cat.subtree}
                        {foreach $cat.subtree as $sc1}
                        <li {if $cat_id==$sc1.id} class="active" {/if}> <a  href="/admin/pages/GetPagesByCategory/{$sc1.id}" class="pjax">&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span>{$sc1.name}</a></li>
                            {if $sc1.subtree}
                                {foreach $sc1.subtree as $sc2}
                                    <li {if $cat_id==$sc2.id} class="active" {/if}> <a  href="/admin/pages/GetPagesByCategory/{$sc2.id}" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span>{$sc2.name}</a></li>
                                    {if $sc2.subtree}
                                        {foreach $sc2.subtree as $sc3}
                                            <li {if $cat_id==$sc3.id} class="active" {/if}> <a  href="/admin/pages/GetPagesByCategory/{$sc3.id}" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span>{$sc3.name}</a></li>
                                            {if $sc3.subtree}
                                                {foreach $sc3.subtree as $sc4}
                                                    <li {if $cat_id==$sc4.id} class="active" {/if}> <a  href="/admin/pages/GetPagesByCategory/{$sc4.id}" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="simple_tree">↳</span>{$sc4.name}</a></li>
                                                {/foreach}
                                            {/if}
                                        {/foreach}
                                    {/if}
                                {/foreach}
                            {/if}
                        {/foreach}
                    {/if}
                    {/foreach}
                  </ul>
            </div>
            {/if}
            <table class="table table-striped table-bordered table-hover table-condensed pages-table span9" {if $show_cat_list != 'yes'} style="width:100%;"{/if}>
                <thead>
                    <tr>
                        <th class="t-a_c span1">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox"/>
                                </span>
                            </span>
                        </th>
                        <th class="span1">ID</th>
                        <th class="span4">{lang('a_title')}</th>
                        <th class="span3">{lang('a_url')}</th>
                        {if $show_cat_list != 'yes'}<th class="span2">{lang('a_category')}</th>{/if}
                        <th class="span2">{lang('a_date_create')}</th>
                        <th class="span1">{lang('a_status')}</th>
                    </tr>
                    <tr class="head_body">
                        <td>
                        </td>
                        <td class="number">
                            <input type="text" name="id" data-original-title="{lang('a_numbers_only')}" value="{$_POST['id']}"/>
                        </td>
                        <td>
                            <input type="text" name="title" value="{$_POST['title']}"/>
                        </td>
                        <td>
                            <input type="text" name="url" value="{$_POST['url']}"/>
                        </td>
                        {if $show_cat_list != 'yes'}
                        <td>
                            <select id="categorySelect" url="{$BASE_URL}admin/pages/GetPagesByCategory/">
                                <option value="">Все категории</option>
                                <option value="0" {if $cat_id === "0"}selected="selected"{/if}>Без категории</option>
                                { $this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'], 'sel_cat' => $this->template_vars['cat_id'])); }
                            </select>
                        </td>{/if}
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody class="sortable" data-url="">
                    {if count($pages)}
                    {foreach $pages as $page}
                    <tr data-id="{$page.id}">
                        <td class="t-a_c">
                            <span class="frame_label">
                                <span class="niceCheck b_n">
                                    <input type="checkbox" data-id="{$page.id}" name="ids" value="{$page.id}"/>
                                </span>
                            </span>
                        </td>
                        <td><span>{$page.id}</span></td>
                        <td class="share_alt">
                            <a href="{$BASE_URL}{$page.cat_url}{$page.url}" target="_blank" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="{lang('a_goto_site')}"><i class="icon-share-alt"></i></a>
                            <a href="{$BASE_URL}admin/pages/edit/{$page.id}" class="title pjax" data-rel="tooltip" data-original-title="{lang('a_edit')}">{$page.title}</a>
                        </td>
                        <td><span>{truncate($page.url, 40, '...')}</span></td>
                        {if $show_cat_list != 'yes'}
                        <td>
                        <span>{if $category }{$category.name}{else:}
                                
                                {if 0 == $page.category}
                                    {lang('a_without_cat')}
                                {else:}
                                
                                    {foreach $cats  as $c} 
                                        {if $c.id == $page.category}
                                            {$c.name}
                                        {/if}
                                    {/foreach}
                                    
                                {/if}
                                {/if}</span>
                        </td>{/if}
                        <td>
                        {date('d-m-Y, H:i', $page.publish_date)}
                        </td>
                        <td>
                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $page['post_status'] == 'publish'}{lang('a_show')}{else:}{lang('a_dont_show')}{/if}" onclick="change_page_status('{$page.id}');">
                                <span class="prod-on_off {if $page['post_status'] != 'publish'}disable_tovar{/if}" style="{if $page['post_status'] != 'publish'}left: -28px;{/if}"></span>
                            </div>
                        </td>
                    </tr>
                    {/foreach}
                    {else:}
                    <tr>
                        <td colspan="6">
                            <div class="alert alert-info" style="margin: 18px;">По Вашему запросу ничего не найдено</div>
                        </td>
                    </tr>
                    {/if}
                </tbody>
            </table>
        </div>
        {if $paginator > ''}
        <div class="clearfix">
            {$paginator}
        </div>
        {/if}
    </section>
</form>