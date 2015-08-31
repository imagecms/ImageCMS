<section class="mini-layout mod_stats">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>

    </div>
    <div class="row-fluid">
        {include_tpl('../include/left_block')}
        <div class="clearfix span9 content-statistic">
            {if count($data) > 0}
                <table class="table  table-bordered table-condensed online-users-table">
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
                <div class="alert alert-info">
                    {lang('There are no users online', 'mod_stats')}
                </div>
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
