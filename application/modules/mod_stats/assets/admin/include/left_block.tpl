<div class="span3">
    <ul class="nav nav-tabs nav-stacked m-t_10 left-menu-ul">
        {foreach $leftMenu as $firstLevel}
            <li>
                <a class="firstLevelMenu">{$firstLevel.name}</a> 
            </li>
            <div class="submenu" {if !strpos($_SERVER['REQUEST_URI'], implode("/", array($firstLevel.controller,'')))} style="display: none;"{/if}>
                {foreach $firstLevel.items as $secondLevel}
                    <li>
                        <a href="{site_url('admin/components/cp/mod_stats/')}/{$secondLevel.controller}/{$secondLevel.action}{$queryString}" 
                           class="linkChart 
                           {if strpos($_SERVER['REQUEST_URI'], implode("/", array($secondLevel.controller,$secondLevel.action)))} active{/if}"

                           >&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">-</span> {$secondLevel.name}   
                        </a>
                    </li>
                {/foreach}
            </div>
        {/foreach}
    </ul>
    <div class="m-t_20">
        <span class="settingTitle"> {lang('Settings','mod_stats')} </span>
        <div class="settingsContainer">
            <span class="frame_label no_connection m-r_15 shortSettingsSpan" style="display: block;">
                <span class="niceCheck"  style="background-position: -46px -17px;">
                    <input type="checkbox" {if $saveSearchResults == '1'}checked="checked" {/if} class="shortSettingsCheckbox" data-sname="save_search_results">
                </span>
                {lang('save search results','mod_stats')}
            </span>

            <span class="frame_label no_connection m-r_15 shortSettingsSpan" style="display: block;">
                <span class="niceCheck"  style="background-position: -46px -17px;">
                    <input type="checkbox" {if $saveUsersAttendance == '1'}checked="checked" {/if} class="shortSettingsCheckbox" data-sname="save_users_attendance">
                </span>
                {lang("save user's attendance","mod_stats")}
            </span>

        </div>
    </div>
</div>