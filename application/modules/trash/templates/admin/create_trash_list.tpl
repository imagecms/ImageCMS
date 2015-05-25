<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('New redirect list creation', 'trash')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/init_window/trash" class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang("Back", 'admin')}</span>
                    </a>
                    {/*<button type="button"
                            class="btn btn-small btn-success action_on formSubmit"
                            data-form="#mass_create"
                            data-action="create"
                            data-submit>
                        <i class="icon-plus-sign icon-white"></i>{lang("Create", 'admin')}
                    </button>*/}
                    <button type="button"
                            class="btn btn-small action_on formSubmit"
                            data-form="#mass_create"
                            data-action="exit">
                        <i class="icon-check"></i>{lang("Create and exit", 'admin')}
                    </button>
                </div>
            </div>
        </div>
        <form method="post" id="mass_create" action="/admin/components/init_window/trash/trash_list/" class="form-horizontal1 m-t_15">
            <textarea name="urls" rows="20"></textarea>
            <span class="control-label">
                <span data-title="&lt;b&gt;{lang('Example','trash')}&lt;/b&gt;" class="popover_ref" data-original-title="">
                    <i class="icon-info-sign"></i>
                </span>
                <div class="d_n">
                    <table class="table" style="width: auto;">
                        <thead>
                            <tr>
                                <th>{lang('Old URL', 'trash')}</th>
                                <th>{lang('New URL','trash')}</th>
                                <th>{lang('Redirect type','trash')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>
                                /product/tovar
                            </td>
                            <td>
                                /shop/product/tovar
                            </td>
                            <td>
                                301
                            </td>
                        </tbody>
                    </table>
                </div>
                {lang('Example', 'trash')}
            </span>
        </form>
    </section>
</div>