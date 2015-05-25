<link rel="stylesheet" type="text/css" href="/application/modules/admin_menu/assets/js/context_menu/jquery.contextMenu.css">
<script src="/application/modules/admin_menu/assets/js/context_menu/jquery.contextMenu.js"></script>
<script src="/application/modules/admin_menu/assets/js/context_menu/jquery.ui.position.js"></script>

<div class="modal hide fade modal_del">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Edit menu item','admin_menu')}</h3>
    </div>
    <div class="modal-body">

    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" >{lang('Save','admin_menu')}</a>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin_menu')}</a>
    </div>
</div>

<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Cms menus', 'admin_menu')}                
            </span>

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
                        onclick="AdminMenu.save(this)">
                    <i class="icon-ok-sign icon-white"></i>{lang('Save', 'admin')}
                </button>
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="row-fluid">
            <div id="workPlace">
                <div class="pull-left originMenu drag">
                    <ul>
                        {echo $full_menu}
                    </ul>
                </div>

                <div class="pull-right menusList">
                    <div class="corporate">
                        <h5>{lang('Corporate', 'admin_menu')}</h5>
                        <ul class="drop sortable">
                            {echo $corporate_menu}
                        </ul>
                    </div>
                    <div class="professional">
                        <h5>{lang('Professional', 'admin_menu')}</h5>
                        <ul class="drop sortable">
                            {echo $professional_menu}
                        </ul>
                    </div>
                    <div class="premium">
                        <h5>{lang('Premium', 'admin_menu')}</h5>
                        <ul class="drop sortable">
                            {echo $premium_menu}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>