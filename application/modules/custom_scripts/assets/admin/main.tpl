<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Custom scripts', 'custom_scripts')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="{$BASE_URL}admin/components/"
                       class="t-d_n m-r_15 pjax">
                        <span class="f-s_14">←</span>
                        <span class="t-d_u">{lang('Back', 'admin')}</span>
                    </a>
                    <button  data-form="#customScripts"  class="btn btn-small btn-primary formSubmit"><i class="icon-ok"></i>{lang('Save', 'custom_scripts')}</button>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <form id="customScripts" method="post">

            <table class="table  table-bordered table-hover table-condensed content_big_td">

                <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">

                                <div class="row-fluid">
                                    <div class="control-group">
                                        <h5>&lt;head&gt</h5>
                                        <textarea name="header">{$headerScript}</textarea>
                                        <h5>&lt;/head&gt</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="table  table-bordered table-hover table-condensed content_big_td">

                <tbody>
                <tr>
                    <td colspan="6">
                        <div class="inside_padd">
                            <div class="form-horizontal">

                                <div class="row-fluid">
                                    <div class="control-group">
                                        <h5>&lt;body&gt</h5>
                                        <textarea name="body">{$bodyScript}</textarea>
                                        <h5>&lt;/body&gt</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            </form>

    </section>
</div>