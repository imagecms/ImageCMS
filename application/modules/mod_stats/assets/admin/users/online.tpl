<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back', 'admin')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9">
            <p id="online_deprecated_block" style="display: none; padding: 10px; text-align: center; color: #800">
                {lang('Data may be deprecated. Please refresh the page.','mod_stats')}
            </p>
            {if count($data) > 0}
                <table class="table table-striped table-bordered table-condensed content_big_td online-users-table">
                    <thead>
                        <tr>
                            <th style="width:7%;">{lang('Id', 'mod_stats')}</th>
                            <th style="width:15%;">{lang('Username', 'mod_stats')}</th>
                            <th style="width:23%;">{lang('Email', 'mod_stats')}</th>
                            <th style="width:20%;">{lang('Last activity', 'mod_stats')}</th>
                            <th style="width:35%;">{lang('Last page', 'mod_stats')}</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $data as $user}
                            <tr data-user_id='{$user.id_user}' class='main_row'>
                                <td>{if $user.id_user > 0}{$user.id_user}{/if}</td>
                                <td>{$user.username}</td>
                                <td>{$user.email}</td>
                                <td>{$user.last_activity}</td>
                                <td>
                                    <a href="/{$user.last_url}" target="_blank">
                                        {$user['page_name']}
                                    </a>
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            {else:}
                <p style="text-align: center; padding: 15px; font-size: 13pt;">There are no users online </p>
            {/if}
        </div>
    </div>
</section>
{literal}
    <script>
        setTimeout(function() {
            $('#online_deprecated_block').show();
        }, 120000);
    </script>
{/literal}
