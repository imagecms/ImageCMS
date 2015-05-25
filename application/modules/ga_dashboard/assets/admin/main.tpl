<div class="container">

    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <form id="tokenForm" action="{site_url($CI->uri->uri_string().'/saveToken') }" method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Google Analytics Dashboard</h3>
            </div>
            <div class="modal-body">
                <p><a class='login' href='{$authUrl}' target="_blank">Connect Me!</a></p>
                <p><input type="text" name="token"></p>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary" type="submit" >Save changes</button>
            </div>
            {form_csrf()}
        </form>
    </div>

    <section class="mini-layout">
        <div class="frame_title clearfix">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">Google Analytics Dashboard</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/modules_table" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                </div>
                <div class="d-i_b">
                    <a href="#myModal" data-toggle="modal" target="_blank" class="btn btn-small btn-success"><i class="icon-plus-sign icon-white"></i>{lang('Auth', 'google_analytics_dashboard')}</a>
                </div>
            </div>
        </div>

        <div class="row-fluid">

            <main class="Site-main">
                <div id="embed-api-auth-container"></div>
                <div id="view-selector-container"></div>
                <div class="Dashboard Dashboard--full">
                    <div class="FlexGrid" style="overflow: hidden; width: 100%;">
                        <div class="FlexGrid-item" style="float: left;width: 38%; padding: 10px;">
                            <div id="main-chart-container"></div>
                        </div>
                        <div class="FlexGrid-item" style="float: left;width: 48%;padding: 10px;">
                            <div id="breakdown-chart-container"></div>
                        </div>
                    </div>
                </div>
            </main>

            <script>
                var token = '{$access_token}';
            </script>
        </div>
    </section>
</div>
