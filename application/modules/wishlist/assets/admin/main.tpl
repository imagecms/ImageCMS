<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang(wish_list_settings)}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/modules_table"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14">←</span>
                    <span class="t-d_u">{lang('a_back')}</span>
                </a>
                <a href="{$BASE_URL}admin/components/cp/wishlist"
                   class="t-d_n m-r_15 pjax">
                    <span class="f-s_14"></span>
                    <span class="t-d_u">{lang(user_lists)}</span>
                </a>
                <button type="button"
                        class="btn btn-small btn-primary action_on formSubmit"
                        data-form="#wishlist_settings_form"
                        data-action="tomain">
                    <i class="icon-ok"></i>{lang('a_save')}
                </button>
            </div>
        </div>
    </div>
    <form method="post" action="{site_url('admin/components/cp/wishlist/update_settings')}" class="form-horizontal" id="wishlist_settings_form">
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="6">
                        {lang(wish_list_settings)}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">

                            <div class="control-group">
                                <label class="control-label" for="settings[maxListName]">{lang(max_list_name_length)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxListName]" class="textbox_short" value="{$settings['maxListName']}" id="maxListName"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxListsCount]">{lang(max_lists_counts)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxListsCount]" class="textbox_short" value="{$settings['maxListsCount']}" id="maxListsCount"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxItemsCount]">{lang(max_items_counts)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxItemsCount]" class="textbox_short" value="{$settings['maxItemsCount']}" id="maxItemsCount"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxCommentLenght]">{lang(max_comment_length)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxCommentLenght]" class="textbox_short" value="{$settings['maxCommentLenght']}" id="maxCommentLenght"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxDescLenght]">{lang(max_description_length)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxDescLenght]" class="textbox_short" value="{$settings['maxDescLenght']}" id="maxDescLenght"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxImageWidth]">{lang(max_image_width)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxImageWidth]" class="textbox_short" value="{$settings['maxImageWidth']}" id="maxImageWidth"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="settings[maxImageHeight]">{lang(max_image_height)}</label>
                                <div class="controls">
                                    <input type = "number" name = "settings[maxImageHeight]" class="textbox_short" value="{$settings['maxImageHeight']}" id="maxImageHeight"/>
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