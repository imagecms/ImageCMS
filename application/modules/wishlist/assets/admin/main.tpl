<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Wish List settings', 'wishlist')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('Back', 'wishlist')}</span>
                </a>
                <a href="{$BASE_URL}admin/components/cp/wishlist" class="btn btn-small pjax">
                    {lang('Users', 'wishlist')}
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#wishlist_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('Save', 'wishlist')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/wishlist/update_settings')}" class="form-horizontal" id="wishlist_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                       {lang('Wish List settings', 'wishlist')}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">

                            <div class="control-group">
                                <label class="control-label" for="settings[maxUserName]">{lang('Maximum user name length', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxUserName]" class="textbox_short" value="{$settings['maxUserName']}" id="maxListName"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxListName]">{lang('Maximum list name length', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxListName]" class="textbox_short" value="{$settings['maxListName']}" id="maxListName"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxListsCount]">{lang('Maximum lists counts', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxListsCount]" class="textbox_short" value="{$settings['maxListsCount']}" id="maxListsCount"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxItemsCount]">{lang('Maximum items counts', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxItemsCount]" class="textbox_short" value="{$settings['maxItemsCount']}" id="maxItemsCount"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxCommentLenght]">{lang('Maximum comment length', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxCommentLenght]" class="textbox_short" value="{$settings['maxCommentLenght']}" id="maxCommentLenght"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxDescLenght]">{lang('Maximum description length', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxDescLenght]" class="textbox_short" value="{$settings['maxDescLenght']}" id="maxDescLenght"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxWLDescLenght]">{lang('Maximum Wish List description length', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxWLDescLenght]" class="textbox_short" value="{$settings['maxWLDescLenght']}" id="maxWLDescLenght"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxImageWidth]">{lang('Maximum image width', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxImageWidth]" class="textbox_short" value="{$settings['maxImageWidth']}" id="maxImageWidth"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxImageHeight]">{lang('Maximum image height', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxImageHeight]" class="textbox_short" value="{$settings['maxImageHeight']}" id="maxImageHeight"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxImageSize]">{lang('Maximum image size', 'wishlist')}</label>
                                <div class="controls number">
                                    <input type = "number" name = "settings[maxImageSize]" class="textbox_short" value="{$settings['maxImageSize']}" id="maxImageSize"/>
                                </div>
                            </div>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        {form_csrf()}
    </form>
</section>