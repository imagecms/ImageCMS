<link rel="stylesheet" type="text/css" href="/application/modules/admin_menu/assets/js/context_menu/jquery.contextMenu.css">
<script src="/application/modules/admin_menu/assets/js/context_menu/jquery.contextMenu.js"></script>
<script src="/application/modules/admin_menu/assets/js/context_menu/jquery.ui.position.js"></script>

<div class="modal hide fade modal_edit_menu_item">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Edit menu item','admin_menu')}</h3>
    </div>
    <div class="modal-body" style="text-align: center; margin-left: 60px;">

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Identifier','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="identifier">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Title','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="text">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Link','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="link">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('HTLM class','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="class">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('HTML id','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="id">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Icon class','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="icon">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Callback method name','admin_menu')}:</label>

            <div class="controls">
                <input type="text" data-id="callback">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label pull-left" style="width: 100px;text-align: left;" for="Text">{lang('Enable pjax','admin_menu')}:</label>

            <div class="controls">
                <select data-id="pjax">
                    <option value="yes">{lang('Yes', 'admin_menu')}</option>
                    <option value="no">{lang('No', 'admin_menu')}</option>
                </select>
            </div>
        </div>


    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-success" onclick="AdminMenu.updateItemData(this)">{lang('Save','admin')}</a>
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
            <table class="table table-bordered table-condensed t-l_a table-admin-menu">
                <tbody>
                <tr>
                    <td>
                        <div id="workPlace">
                            <div class="full sortableBaseMenu">
                                <h4>{lang('Full menu', 'admin_menu')}</h4>
                                {echo $menus['full']}
                            </div>

                            {if count($menus) > 2}
                                <hr>
                                <div class="menuSelect">
                                    <form method="GET">
                                        <h4 style="float: left;margin-right: 10px;margin-top: 5px">{lang('Select menu to edit','admin_menu')}
                                            :</h4>
                                        <select id="menu_name" name="menu_name"
                                                onchange="$(this).closest('form').submit();">
                                            <option {if !isset($_GET['menu_name']) OR $_GET['menu_name']=='all'}selected="selected"{/if}
                                                    value="all">{echo lang('All', 'admin_menu')}</option>
                                            {foreach $menus as $menu_name => $menu}
                                                {if $menu_name != 'full' && $menu}
                                                    <option {if $_GET['menu_name']==$menu_name}selected="selected"{/if}
                                                            value="{echo $menu_name}">{echo $menu_name}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </form>
                                </div>
                            {/if}

                            {if $menus['premium']}
                                <div class="premium sortableMenu"
                                     {if $_GET['menu_name'] !== 'premium' AND ($_GET['menu_name']!=='all' AND isset($_GET['menu_name']))}style="display: none;"{/if}>
                                    <hr>
                                    <h4>{lang('Premium menu', 'admin_menu')}</h4>
                                    {echo $menus['premium']}
                                </div>
                            {/if}
                            {if $menus['professional']}
                                <div class="professional sortableMenu"
                                     {if $_GET['menu_name'] !== 'professional' AND ($_GET['menu_name']!=='all' AND isset($_GET['menu_name']))}style="display: none;"{/if}>
                                    <hr>
                                    <h4>{lang('Professional menu', 'admin_menu')}</h4>
                                    {echo $menus['professional']}
                                </div>
                            {/if}

                            {if $menus['corporate']}
                                <div class="corporate sortableMenu"
                                     {if $_GET['menu_name'] !== 'corporate' AND ($_GET['menu_name']!=='all' AND isset($_GET['menu_name']))}style="display: none;"{/if}>
                                    <hr>
                                    <h4>{lang('Corporate menu', 'admin_menu')}</h4>
                                    {echo $menus['corporate']}
                                </div>
                            {/if}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</section>
