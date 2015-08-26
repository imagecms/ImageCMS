<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Tariffs menus', 'admin_menu')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'admin')}</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-success"
                        onclick="AdminMenu.saveTariffs(this)">
                    <i class="icon-plus-sign icon-white"></i>{lang('Save', 'admin')}
                </button>

                <button type="button"
                        class="btn btn-small btn-danger"
                        onclick="AdminMenu.uploadTariffs(this)">
                    <i class="icon-upload icon-white"></i>
                    {lang('Upload menus to server', 'admin')}
                </button>

            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <div class="search">
                <input type="text" id="searchTariff" onkeyup="AdminMenu.searchTariff(this)" placeholder="{echo lang('Search tariff', 'admin_menu')}...">
            </div>
            <div id="workPlace">
                <div class="pull-left originMenu drag">
                    <ul>
                        {echo $full_menu}
                    </ul>
                </div>

                <div class="pull-right menusList">
                    {foreach $tariffs as $tariff}
                        <div class="tariff" tariff_id="{echo $tariff->id}">
                            <h5>{echo $tariff->i18n->name} ({echo $tariff->saasCountry->i18n->name})</h5>

                            <ul class="drop sortable">
                                {echo $tariff->menu}
                            </ul>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</section>