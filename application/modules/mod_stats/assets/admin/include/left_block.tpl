<div class="span3">

    <!-- Hidden <FORM> to submit the SVG data to the server, which will convert it to SVG/PDF/PNG downloadable file.
     The form is populated and submitted by the JavaScript below. -->
    <form id="svgform" method="post" action="http://d3export.cancan.cshl.edu/download.pl">
        <input type="hidden" id="output_format" name="output_format" value="png">
        <input type="hidden" id="data" name="data" value="&lt;svg width=&quot;360&quot; height=&quot;180&quot;&gt;&lt;circle class=&quot;little&quot; cx=&quot;280.7653628848493&quot; cy=&quot;169.69426963012666&quot; r=&quot;12&quot; fill=&quot;#c3426b&quot;&gt;&lt;/circle&gt;&lt;circle class=&quot;little&quot; cx=&quot;62.859246069565415&quot; cy=&quot;67.64177473727614&quot; r=&quot;12&quot; fill=&quot;#2f4409&quot;&gt;&lt;/circle&gt;&lt;circle class=&quot;little&quot; cx=&quot;298.011907087639&quot; cy=&quot;114.28427068982273&quot; r=&quot;12&quot; fill=&quot;#9d8d4d&quot;&gt;&lt;/circle&gt;&lt;/svg&gt;">
    </form>

    <ul class="nav nav-tabs nav-stacked m-t_10 left-menu-ul">
        <li>
            <a class='firstLevelMenu' href="/admin/components/cp/mod_stats/">{lang('Start page','mod_stats')}</a> 
        </li>
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

                        >
                        <span class="simple_tree">-</span> {$secondLevel.name}   
                    </a>
                </li>
            {/foreach}
        </div>
    {/foreach}
</ul>
<div class="">
    <span class="settingTitle"> {lang('Settings','mod_stats')} </span>
    <div class="settingsContainer">
        <span class="frame_label no_connection m-r_15 shortSettingsSpan" style="display: block;">
            <span class="niceCheck"  style="background-position: -46px -17px;">
                <input type="checkbox" {if $saveSearchResults == '1'}checked="checked" {/if} class="shortSettingsCheckbox" data-sname="save_search_results">
            </span>
            {lang('Save search results', 'mod_stats')}
        </span>
        
        <span class="frame_label no_connection m-r_15 shortSettingsSpan" style="display: block;">
            <span class="niceCheck"  style="background-position: -46px -17px;">
                <input type="checkbox" {if $saveSearchResultsAC == '1'}checked="checked" {/if} class="shortSettingsCheckbox" data-sname="save_search_results_ac">
            </span>
            {lang('Save autocomplete search results', 'mod_stats')}
        </span>

        <span class="frame_label no_connection m-r_15 shortSettingsSpan" style="display: block;">
            <span class="niceCheck"  style="background-position: -46px -17px;">
                <input type="checkbox" {if $saveUsersAttendance == '1'}checked="checked" {/if} class="shortSettingsCheckbox" data-sname="save_users_attendance">
            </span>
            {lang("Save users attendance", "mod_stats")}
        </span>

        <span class="frame_label no_connection m-r_15 shortSettingsSpan" style="display: block;">
            <span class="niceCheck"  style="background-position: -46px -17px;">
                <input type="checkbox" {if $saveRobotsAttendance == '1'}checked="checked" {/if} class="shortSettingsCheckbox" data-sname="save_robots_attendance">
            </span>
            {lang("Save robotss attendance", "mod_stats")}
        </span>

    </div>
</div>
</div>