    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('a_search_results')}: "{$search_title}"</span>
            </div>                          
        </div>
        <div class="row-fluid">
            {if isset($users)}
            <div class="clearfix">
                <div class="btn-group myTab m-t_20 pull-left" data-toggle="buttons-radio">
                    <a href="#pages" class="btn btn-small {if count($pages)} active{/if}">{lang('a_pages')} 
                        <span style="top:-13px;" class="badge {if count($pages)}badge-important{/if}">{count($pages)}</span>
                    </a>
                    <a href="#users" class="btn btn-small {if !count($pages) && count($users)} active{/if}">{lang('a_users')}
                        <span style="top:-13px;" class="badge {if count($users)} badge-important{/if}">{count($users)}</span>
                    </a>
                </div>
            </div>
            {/if}
            
            <div class="tab-content">
            <div class="tab-pane {if count($pages) || !count($users)} active {/if} " id="pages">
	    {if count($pages)}
            <table class="table table-striped table-bordered table-hover table-condensed pages-table">
                <thead>
                    <tr>
                        <th class="span1">ID</th>
                        <th class="span4">{lang('a_title')}</th>
                        <th class="span3">{lang('a_url')}</th>
                        <th class="span2">Категория</th>
                        <th class="span1">{lang('a_status')}</th>
                    </tr>
                </thead>
                <tbody >
                    
                    {foreach $pages as $page}
                    <tr data-id="{$page.id}">
                        <td><span>{$page.id}</span></td>
                        <td class="share_alt">
                            <a href="{$BASE_URL}{$page.cat_url}{$page.url}" target="_blank" class="go_to_site pull-right btn btn-small"  data-rel="tooltip" data-placement="top" data-original-title="{lang('a_goto_site')}"><i class="icon-share-alt"></i></a>
                            <a href="{$BASE_URL}admin/pages/edit/{$page.id}" class="title pjax">{$page.title}</a>
                        </td>
                        <td><span>{truncate($page.url, 40, '...')}</span></td>
                        <td><span>
			{$categories[$page.category]}
			</span></td>
                        <td>
                            <div class="frame_prod-on_off" data-rel="tooltip" data-placement="top" data-original-title="{if $page['post_status'] == 'publish'}{lang('a_show')}{else:}{lang('a_dont_show')}{/if}" onclick="change_page_status('{$page.id}');">
                                <span class="prod-on_off {if $page['post_status'] != 'publish'}disable_tovar{/if}" style="{if $page['post_status'] != 'publish'}left: -28px;{/if}"></span>
                            </div>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
	    {else:}
                <div class="alert alert-info" style="margin: 18px;">{lang('a_not_found')}</div>
            {/if}   
            </div>
            
            <div class="tab-pane  {if !count($pages) && count($users)} active{/if}" id="users">
                {if count($users)}
                    
                    <table class="table table-striped table-bordered table-hover table-condensed" style="clear: both;">
                        <thead>
                            <tr>
                                <th class="span1">{lang('a_ID')}</th>
                                <th class="span3">{lang('a_us_in_admin')}</th>
                                <th class="span3">{lang('a_email')}</th>
                                <th class="span2">{lang('a_u_man_group_sa_yser')}</th>
                                <th class="span1">{lang('a_banned')}</th>
                                <th class="span2">{lang('a_b_last_ip')}</th>
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
                    <div class="alert alert-info" style="margin: 18px;">{lang('a_not_found')}</div>
                {/if}
            </div>
            </div>
            
        </div>
        {if $paginator > ''}
        <div class="clearfix">
            {$paginator}
        </div>
        {/if}
    </section>