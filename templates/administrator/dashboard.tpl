<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Tools panel', 'admin')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a class="btn btn-small pjax btn-success" href="/admin/pages/index"><i class="icon-plus-sign icon-white"></i>{lang("Create a page","admin")}</a>
                    <a class="btn btn-small pjax btn-success" href="/admin/categories/create_form"><i class="icon-plus-sign icon-white"></i>{lang("Create a category","admin")}</a>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span8">
                <h4>{lang("New pages","admin")}</h4>
                <table class="table  table-bordered table-hover table-condensed">
                    <thead>
                    <th>{lang("Title","admin")}</th>
                        {if count($latest)>0}
                        <th>{lang("Categories","admin")}</th>
                        <th>URL</th>
                        <th>{lang("Time and date of creation","admin")}</th>
                        <th class="span1"></th>
                        {/if}
                    </thead>
                    <tbody>
                        {if count($latest)>0}
                            {foreach $latest as $l}
                                <tr>
                                    <td>
                                        <a href="{$BASE_URL}admin/pages/edit/{$l.id}" class="pjax" data-rel="tooltip" data-title="{lang("Editing","admin")}">{truncate($l.title, 40, '...')}</a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}admin/pages/GetPagesByCategory/{$l.category}" class="pjax">
                                            {truncate(get_category_name($l.category), 20, '...' . lang('Uncategorized','admin'))}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}{$l.cat_url}{$l.url}" target="_blank">{truncate($l.url, 20, '...')}</a>
                                    </td>
                                    <td>{date('Y-m-d H:i:s', $l['created'])}</td>
                                    <td>
                                        <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title="{lang("Editing","admin")}" href="{$BASE_URL}admin/pages/edit/{$l.id}/{$l.lang}">
                                            <i class="icon-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            {/foreach}
                        {else:}
                            <tr>
                                <td>
                                    <div class="alert alert-block">
                                        <h4>{lang('Error','admin')}</h4>
                                        {lang('No recently added pages','admin')}
                                    </div>
                                </td>
                            </tr>
                        {/if}
                    </tbody>
                </table>
                <h4>{lang("Updated pages","admin")}</h4>
                <table class="table  table-bordered table-hover table-condensed">
                    <thead>
                    <th>
                        {lang("Title","admin")}
                    </th>
                    {if count($latest)>0}
                        <th>{lang("Categories","admin")}</th>
                        <th>URL</th>
                        <th>{lang("Time and date of creation","admin")}</th>
                        <th class="span1">
                        </th>
                    {/if}
                    </thead>
                    <tbody>
                        {if count($updated)>0}
                            {foreach $updated as $l}
                                <tr>
                                    <td>
                                        <a href="{$BASE_URL}admin/pages/edit/{$l.id}" class="pjax" data-rel="tooltip" data-title="{lang("Editing","admin")}">{truncate($l.title, 40, '...')}</a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}admin/pages/GetPagesByCategory/{$l.category}" class="pjax">
                                            {truncate(get_category_name($l.category), 20, '...')}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{$BASE_URL}{$l.cat_url}{$l.url}" target="_blank">{truncate($l.url, 20, '...')}</a>
                                    </td>
                                    <td>{date('Y-m-d H:i:s', $l['created'])}</td>
                                    <td>
                                        <a class="btn btn-small my_btn_s pjax" data-rel="tooltip" data-title="{lang("Editing","admin")}" href="{$BASE_URL}admin/pages/edit/{$l.id}/{$l.lang}">
                                            <i class="icon-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            {/foreach}
                        {else:}
                            <tr>
                                <td>
                                    <div class="alert alert-block">
                                        <h4>{lang('Error','admin')}</h4>
                                        {lang('No recently updated pages','admin')}
                                    </div>
                                </td>
                            </tr>
                        {/if}
                    </tbody>
                </table>
            </div>
            <div class="span4">
                <table class="table table-bordered table-hover table-condensed content_big_td" style="margin-top: 40px;">
                    <thead>
                    <th>{lang("System","admin")}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    {lang("Version","admin")}: {$cms_number} <br />
                                    <a class="pjax" href="/admin/sys_update">
                                        {lang('Check version update' , 'admin')}
                                    </a>
                                    <br/>
                                    <a href="/admin/sys_info" class="pjax">{lang("Information","admin")}</a>
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="table  table-bordered table-hover table-condensed content_big_td">
                    <thead>
                    <th>{lang("Statistics","admin")}</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    {lang("Pages","admin")}: {$total_pages} <br />
                                    {lang("Categories","admin")}: {$total_cats} <br />
                                    {lang("Comments","admin")}: {$total_comments} <br />
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {if count($comments)>0}

                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th>{lang('Latest/recent comments', 'admin')}</th>
                        </thead>
                        <tbody>
                            {foreach $comments as $c}
                                <tr>
                                    <td>
                                        <span style="font-size:11px;">{date('d-m-Y H:i', $c.date)}</span>
                                        <br/>
                                        <i>{$c.user_name}:</i>
                                        <a class="pjax" href="/admin/components/cp/comments">
                                            {truncate($c.text, 50, '...')}
                                        </a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {/if}
                {if count($api_news) > 1}
                    <table class="table  table-bordered table-hover table-condensed content_big_td">
                        <thead>
                        <th>{lang('Interesting articles with blog ImageCMS',"admin")}</th>
                        </thead>
                        <tbody>
                            {foreach $api_news as $a}
                                <tr>
                                    <td>
                                        <span>{date('d-m-Y H:i', $a.publish_date)}
                                            <a style="padding-left:10px;" target="_blank" href="http://www.imagecms.net/{$a.cat_url}{$a.url}?utm_source=imagecms&utm_medium=admin&utm_campaign={str_replace(array("http://", "/"), "",site_url())}">>>></a>
                                        </span>
                                        <br/> {truncate(strip_tags($a.prev_text), 100)}
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {/if}
            </div>
        </div>
        {include_tpl('modules_additions')}
        {if !SHOP_INSTALLED}
            <a href="http://www.imagecms.net/kliuchevye-preimushchestva/vozmozhnosti?utm_source=imagecmscorporate&utm_medium=admin&utm_campaign=shopview" target="_blank">
                <img src="{$THEME}images/image.png"/>
            </a>
            {/if}
    </section>
</div>