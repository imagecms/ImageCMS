<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Search results','admin')}: "{$search_title}"</span>
        </div>                          
    </div>
    <div class="row-fluid">
        {if isset($users)}
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#pages" class="btn btn-small {if count($pages)} active{/if}">{lang("Pages","admin")} 
                        <span style="top:-13px;" class="badge {if count($pages)}badge-important{/if}">{count($pages)}</span>
                    </a>
                    <a href="#users" class="btn btn-small {if !count($pages) && count($users)} active{/if}">{lang("User","admin")}
                        <span style="top:-13px;" class="badge {if count($users)} badge-important{/if}">{count($users)}</span>
                    </a>
                </div>
            </div>
        {/if}

        <div class="tab-content">
            <div class="tab-pane {if count($pages) || !count($users)} active {/if} " id="pages">
                {if count($pages)}
                    <table class="table  table-bordered table-hover table-condensed pages-table t-l_a">
                        <thead>
                            <tr>
                                <th class="span1">ID</th>
                                <th>{lang("Title","admin")}</th>
                                <th>{lang("URL","admin")}</th>
                                <th>{lang('Category','admin')}</th>
                                <th>{lang("Status","admin")}</th>
                            </tr>
                        </thead>
                        <tbody >

                            {foreach $pages as $page}
                                <tr data-id="{$page.id}">
                                    <td><span>{$page.id}</span></td>
                                    <td class="share_alt">
                                        <a href="{$BASE_URL}{$page.cat_url}{$page.url}" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="{lang("Go to site","admin")}"><i class="icon-share-alt"></i></a>
                                        <div class="o_h">
                                            <a href="{$BASE_URL}admin/pages/edit/{$page.id}" class="title pjax">{$page.title}</a>
                                        </div>
                                    </td>
                                    <td><span>{truncate($page.url, 40, '...')}</span></td>
                                    <td><span>
                                            {$categories[$page.category]}
                                        </span></td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $page['post_status'] == 'publish'}{lang("show","admin")}{else:}{lang("don't show", 'admin')}{/if}" onclick="change_page_status('{$page.id}');">
                                            <span class="prod-on_off {if $page['post_status'] != 'publish'}disable_tovar{/if}" style="{if $page['post_status'] != 'publish'}left: -28px;{/if}"></span>
                                        </div>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {else:}
                    <div class="alert alert-info" style="margin: 18px;">{lang("No relevant data has been found","admin")}</div>
                {/if}   
            </div>

            <div class="tab-pane  {if !count($pages) && count($users)} active{/if}" id="users">
                {if count($users)}

                    <table class="table  table-bordered table-hover table-condensed t-l_a" style="clear: both;">
                        <thead>
                            <tr>
                                <th class="span1">{lang("ID","admin")}</th>
                                <th>{lang("User","admin")}</th>
                                <th>{lang("E-mail")}</th>
                                <th>{lang("Group","admin")}</th>
                                <th>{lang("Banned","admin")}</th>
                                <th>{lang("Last IP","admin")}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $users as $user}
                                <tr>
                                    <td><p>{echo $user.id}</p></td>
                                    <td><a href="/admin/components/cp/user_manager/edit_user/{echo $user.id}" class="pjax">{echo $user.username}</a></td>                            
                                    <td>{$user.email}</td>
                                    <td><p>{$user.role_alt_name}</p></td>
                                    <td>
                                        <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" onclick="change_status('{$BASE_URL}admin/components/cp/user_manager/actions/{echo $user.id}');" >
                                            <span class="prod-on_off {if $user.banned == 1}disable_tovar{/if}" ></span>
                                        </div>
                                        </div>
                                    </td>
                                    <td><p>{$user.last_ip}</p></td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>

                {else:}
                    <div class="alert alert-info" style="margin: 18px;">{lang("No relevant data has been found","admin")}</div>
                {/if}
            </div>
        </div>

    </div>
    {if $pagination > ''}
        <div class="clearfix">
            {$pagination}
        </div>
    {/if}
</section>