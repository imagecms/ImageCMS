<div class="span3">
    <ul class="nav nav-tabs nav-stacked m-t_10 left-menu-ul">
        {foreach $leftMenu as $firstLevel}
            <li>
                <a class="firstLevelMenu">{$firstLevel.name}</a> 
            </li>
            <div class="submenu" style="display: none;">
                {foreach $firstLevel.items as $secondLevel}
                    <li>
                        <a href="{site_url('admin/components/cp/mod_stats/')}/{$secondLevel.controller}/{$secondLevel.action}{$queryString}" 
                           class="linkChart"
                           >&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">-</span> {$secondLevel.name}   
                        </a>
                    </li>
                {/foreach}
            </div>
        {/foreach}
    </ul>
    <div class="m-t_20">
        <span class="settingTitle"> {lang('Settings:','mod_stats')} </span>
        <div class="settingsContainer">
            <span id="saveSearchResultsSpan" class="frame_label no_connection m-r_15" style="display: block;">
                <span class="niceCheck"  style="background-position: -46px -17px;">

                    <input type="checkbox" {if $saveSearchResults == '1'}checked="checked" {/if} id="saveSearchResultsCheckbox">
                </span>
                {lang('save search results','mod_stats')}
            </span>

            <!--span id="saveUrlData" class="frame_label no_connection m-r_15" style="display: block;">
                <span class="niceCheck"  style="background-position: -46px -17px;">
                    <input type="checkbox" {if $savePageUrls == '1'}checked="checked" {/if} id="saveUrlDataCheckbox">
                </span>
            {lang('save page URLs','mod_stats')}
        </span-->

        </div>
    </div>
</div>