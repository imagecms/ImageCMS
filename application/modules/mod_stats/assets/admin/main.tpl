<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Stats', 'mod_stats')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Back')}</span></a>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span3">
            <ul class="nav nav-tabs nav-stacked m-t_10">
                <!-- Start. Orders -->
                <li>
                    <a class="firstLevelMenu">{lang('Orders', 'mod_stats')}</a> 
                </li>
                <div class="submenu">
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/orders/count" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Count', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/orders/price" class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Price', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/orders/info" data-href="admin/components/init_window/mod_stats/getStatsTemplate/orders/brands_and_cat" class="linkChart" >&nbsp;&nbsp;&nbsp;
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
                            <span class="simple_tree">↳</span>{lang('Register', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/users/attendance" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Attendance', 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/users/user_information" class="linkChart">&nbsp;&nbsp;&nbsp;
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
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products/categories" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Categories', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products/brands" class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Brands', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products/product_info" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Product info', 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products/receipt_of_goods" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Receipt of goods', 'mod_stats')}                                      
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
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products_categories/most_visited" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Most visited', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products_categories/products_in_categories" class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Products in categories', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/products_categories/brands_in_categories" class="linkChart">&nbsp;&nbsp;&nbsp;
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
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/keywords_searched" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Keywords searched', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/brands_in_search" class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Brands in search results', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/categories_in_search" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang("Product's categories in search results", 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/products_in_search" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang("Products in search results", 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a data-href="admin/components/init_window/mod_stats/getStatsTemplate/search/no_result" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang("No results", 'mod_stats')}                                      
                        </a>
                    </li>
                </div>
                <!-- End. Search -->
            </ul>

        </div>
        <div id="chartContainer" class="span9"></div>
    </div>
</section>
