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
                        <a  data-href="admin/components/init_window/mod_stats/orders/data" class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Data', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a  data-href="admin/components/init_window/mod_stats/orders/price" class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Price', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a  data-href="admin/components/init_window/mod_stats/orders/brands_and_cat" class="linkChart" >&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Brands and categories', 'mod_stats')}                                      
                        </a>
                    </li>
                </div>
                <!-- End. Orders -->
                <!-- Start. Users -->
                <li>
                    <a class="firstLevelMenu">{lang('Users', 'mod_stats')}</a> 
                </li>
                <div class="submenu" style="display: none;">
                    <li>
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Online', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Register', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Attendance', 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
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
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Categories', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Brands', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Product info', 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
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
                        <a class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Most visited', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Products in categories', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a  class="linkChart">&nbsp;&nbsp;&nbsp;
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
                        <a  class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Keywords searched', 'mod_stats')}     
                        </a>
                    </li>
                    <li>
                        <a  class="linkChart"> &nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang('Brands in search results', 'mod_stats')}                                        
                        </a>
                    </li>
                    <li>
                        <a  class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang("Product's categories in search results", 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a  class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang("Products in search results", 'mod_stats')}                                      
                        </a>
                    </li>
                    <li>
                        <a  class="linkChart">&nbsp;&nbsp;&nbsp;
                            <span class="simple_tree">↳</span>{lang("No results", 'mod_stats')}                                      
                        </a>
                    </li>
                </div>
                <!-- End. Search -->
            </ul>

        </div>
        <div id="chartContainer"></div>

    </div>
</section>
{literal}
    <script>
        var menuItemFirsLevelGlobal = '';
    </script>
{/literal}