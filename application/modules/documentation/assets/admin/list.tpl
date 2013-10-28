<div class="modal hide fade" id="pages_action_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 id="mvMv">{lang("Copy/Move pages", 'documentation')}</h3>
    </div>
    <div class="modal-body">
        {lang("Categories", 'documentation')}:
        <select id="CopyMoveCategorySelect" url="{$BASE_URL}admin/pages/GetPagesByCategory/">
            <option value="0">{lang("Without a category",'documentation')}</option>
            {$this->view("cats_select.tpl", array('tree' => $this->template_vars['tree'] ));}
        </select>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel",'documentation')}</a>
        <a href="#" id="confirmMove" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('{$BASE_URL}admin/pages/move_pages/copy')" >{lang('Confirm','documentation')}</a>
    </div>
</div>

<div class="modal hide fade" id="pages_delete_dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Delete pages','documentation')}</h3>
    </div>
    <div class="modal-body">
        {lang('Delete selected pages?', 'documentation')}
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang("Cancel",'documentation')}</a>
        <a href="#" class="btn btn-primary" onclick="pagesAdmin.confirmListAction('{$BASE_URL}admin/pages/delete_pages/')" >{lang("Delete",'documentation')}</a>
    </div>
</div>

<form method="post" action="" class="listFilterForm" id="pagesFilterForm">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Documentation', 'documentation')}</span>
            </div>

            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'documentation')}</span></a>
                    <a href="{$BASE_URL}admin/components/cp/documentation/settings" class="btn btn-small action_on"><i class="icon-wrench"></i>{lang('Settings','documentation')}</a>
                </div>
            </div>
        </div>
        <div class="clearfix">
            <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                <a href="#content_list" class="btn btn-small active">{lang("Content list", 'documentation')}</a>
                <a href="#menu_categories" class="btn btn-small ">{lang("Menu categories", 'documentation')}</a>
                <a href="#menu_manage" class="btn btn-small ">{lang("Menu manage", 'documentation')}</a>
            </div>
        </div>
        <div class="tab-content content_big_td">
            <div class="tab-pane active" id="content_list">
                <div class="row-fluid">
                    {if $show_cat_list == 'yes'}
                        <div class="span3">
                            <ul class="nav nav-tabs nav-stacked m-t_10">
                                <li {if '0' == $cat_id} class="active" {/if} ><a href="{$BASE_URL}admin/components/cp/documentation/byCategory/0" class="pjax">{lang("Without a category",'documentation')}</a></li>
                                <li {if 'all' === $cat_id} class="active" {/if}><a href="{$BASE_URL}admin/components/cp/documentation/byCategory/" class="pjax">{lang('All categories','documentation')}</a></li>
                            </ul>
                            <ul class="nav nav-tabs nav-stacked">
                                {foreach $tree as $cat}
                                    <li {if $cat_id==$cat.id} class="active" {/if}>
                                        <a  href="{$BASE_URL}admin/components/cp/documentation/byCategory/{$cat.id}" class="pjax">{$cat.name}</a>
                                    </li>
                                    {if $cat.subtree}
                                        {foreach $cat.subtree as $sc1}
                                            <li {if $cat_id==$sc1.id} class="active" {/if}>
                                                <a  href="{$BASE_URL}admin/components/cp/documentation/byCategory/{$sc1.id}" class="pjax">&nbsp;&nbsp;&nbsp;
                                                    <span class="simple_tree">↳</span>{$sc1.name}
                                                </a>
                                            </li>
                                            {if $sc1.subtree}
                                                {foreach $sc1.subtree as $sc2}
                                                    <li {if $cat_id==$sc2.id} class="active" {/if}>
                                                        <a  href="{$BASE_URL}admin/components/cp/documentation/byCategory/{$sc2.id}" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <span class="simple_tree">↳</span>{$sc2.name}
                                                        </a>
                                                    </li>
                                                    {if $sc2.subtree}
                                                        {foreach $sc2.subtree as $sc3}
                                                            <li {if $cat_id==$sc3.id} class="active" {/if}>
                                                                <a  href="{$BASE_URL}admin/components/cp/documentation/byCategory/{$sc3.id}" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <span class="simple_tree">↳</span>{$sc3.name}
                                                                </a>
                                                            </li>
                                                            {if $sc3.subtree}
                                                                {foreach $sc3.subtree as $sc4}
                                                                    <li {if $cat_id==$sc4.id} class="active" {/if}>
                                                                        <a  href="{$BASE_URL}admin/components/cp/documentation/byCategory/{$sc4.id}" class="pjax">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <span class="simple_tree">↳</span>{$sc4.name}
                                                                        </a>
                                                                    </li>
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
                                <th class="span4">{lang('Title','documentation')}</th>
                                <th class="span2">{lang('Created','documentation')}</th>
                                <th class="span2">{lang('Last update','documentation')}</th>
                                <th class="span1">{lang('Status','documentation')}</th>
                            </tr>
                        </thead>
                        <tbody data-url="" class="sortable ui-sortable">
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
                                            <a href="{$BASE_URL}{$page.cat_url}{$page.url}" target="_blank" class="go_to_site pull-right btn btn-small" data-rel="tooltip" data-placement="top" data-original-title="{lang("go to site",'documentation')}"><i class="icon-share-alt"></i></a>
                                            <a href="{$BASE_URL}admin/components/cp/documentation/history/{$page.id}" class="title pjax" data-rel="tooltip" data-original-title="{lang("Editing",'documentation')}">{$page.title}</a>
                                        </td>
                                        <td>
                                            {date('d-m-Y H:i', $page.created)}
                                        </td>
                                        <td>
                                            {date('d-m-Y H:i', $page.updated)}
                                        </td>
                                        <td>
                                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $page['post_status'] == 'publish'}{lang("show",'documentation')}{else:}{lang('dont show')}{/if}" onclick="change_page_status('{$page.id}');">
                                                <span class="prod-on_off {if $page['post_status'] != 'publish'}disable_tovar{/if}" style="{if $page['post_status'] != 'publish'}left: -28px;{/if}"></span>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                            {else:}
                                <tr>
                                    <td colspan="6">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="alert alert-info" style="margin: 18px;">{lang('Your search did not found', 'documentation')}</div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
            </div>
            <div class="tab-pane" id="menu_categories">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                        <thead>
                            <tr>
                                <th class="span1">ID</th>
                                <th class="span8">{lang('Title','documentation')}</th>
                                <th class="span8">{lang('Category menu','documentation')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $categories as $category}
                                <tr data-id="{echo $category['id']}">
                                    <td class="t-a_c">
                                        <span>{echo $category['id']}</span>
                                    </td>
                                    <td>
                                        {echo $category['name']}
                                    </td>
                                    <td class="share_alt">
                                        <div class="p_r o_h frame_price categoryMenuBlock">
                                            <input type="text"
                                                   maxlength="32"
                                                   value="{echo $category['menu_cat']}"
                                                   class="js_price"
                                                   data-value="{echo $category['menu_cat']}">
                                            <button class="btn btn-small documentationUpdateMenuCategory"
                                                    data-id="{echo $category['id']}"
                                                    type="button">
                                                <i class="icon-refresh"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="tab-pane" id="menu_manage">
                <div class="row-fluid">
                    <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                        <thead>
                            
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>



        </div>
    </section>
</form>