<div class="span3">
    <ul class="nav nav-tabs nav-stacked m-t_10">
        <!-- Start. Orders -->
        <li>
            <a class="firstLevelMenu">{lang('Orders', 'mod_stats')}</a> 
        </li>
        <div class="submenu">
            <li>
                <a href="{site_url('admin/components/cp/mod_stats/orders/amount')}" class="linkChart" id="startPage">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Count', 'mod_stats')}     
                </a>
            </li>
            <li>
                <a href="{site_url('admin/components/cp/mod_stats/orders/price')}" class="linkChart"> &nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Price', 'mod_stats')}                                        
                </a>
            </li>
            <li>
                <a href="{site_url('admin/components/cp/mod_stats/orders/info')}" class="linkChart" >&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Information', 'mod_stats')}                                      
                </a>
            </li>
        </div>
        <!-- End. Orders -->
        <!-- Start. Users -->
        <li>
            <a  class="firstLevelMenu">{lang('Users', 'mod_stats')}</a> 
        </li>
        <div class="submenu" style="display: none;">
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/users/online" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Online', 'mod_stats')}     
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/users/register" class="linkChart"> &nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Registered', 'mod_stats')}                                        
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/users/attendance" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Attendance', 'mod_stats')}                                      
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/users/information" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('User information', 'mod_stats')}                                      
                </a>
            </li>
        </div>
        <!-- End. Users -->
        <!-- Start. Products -->
        <li>
            <a class="firstLevelMenu">{lang('Products', 'mod_stats')}</a> 
        </li>
        <div class="submenu" style="display: none;">
            <li>
                <a href="{site_url('admin/components/cp/mod_stats/products/categories')}" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Categories', 'mod_stats')}     
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products/brands" class="linkChart"> &nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Brands', 'mod_stats')}                                        
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products/productInfo" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Product information', 'mod_stats')}                                      
                </a>
            </li>
        </div>
        <!-- End. Products -->
        <!-- Start. Product's categories -->
        <li>
            <a class="firstLevelMenu">{lang("Product's categories", 'mod_stats')}</a> 
        </li>
        <div class="submenu" style="display: none;">
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/categories/mostVisited" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Most visited', 'mod_stats')}     
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/categories/brandsInCategories" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Brands in category', 'mod_stats')}                                      
                </a>
            </li>
        </div>
        <!-- End. Product's categories -->
        <!-- Start. Search -->
        <li>
            <a class="firstLevelMenu">{lang("Search", 'mod_stats')}</a> 
        </li>
        <div class="submenu" style="display: none;">
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/keywordsSearched" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Searched keywords', 'mod_stats')}     
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/brandsInSearch" class="linkChart"> &nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang('Brands in search results', 'mod_stats')}                                        
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/categoriesInSearch" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang("Product's categories in search results", 'mod_stats')}                                      
                </a>
            </li>
            <li>
                <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/pageNotFound" class="linkChart">&nbsp;&nbsp;&nbsp;
                    <span class="simple_tree">↳</span>{lang("Page not found", 'mod_stats')}                                      
                </a>
            </li>
        </div>
        <!-- End. Search -->
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