<div id="setingsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <form method="post" action="/admin/components/init_window/red_helper/saveSettings" enctype="multipart/form-data" id="settingsForm">
            <div>
                <label for="login">Your login:</label>
                <input name="login" type="text" id="login"/>
            </div>
            <div>
                <button class="btn btn-success pull-right" href="#">Go</button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('#setingsModal').modal('hide')">Close</a>
        <button class="btn btn-primary formSubmit submitButton" 
                data-form="#settingsForm" 
                data-submit 
                data-dismiss="modal" 
                aria-hidden="true">{lang("Save settings", 'sendsms')}
        </button>
    </div>
</div>
<div id="registerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Modal header</h3>
    </div>
    <div class="modal-body">
        <div>
            <label for="login">Your login:</label>
            <input type="text" id="login"/>
        </div>
        <div>
            <label for="email">Your email:</label>
            <input type="text" id="email"/>
        </div>
        <div>
            <label for="pass">Choose pass:</label>
            <input type="password" id="pass"/>
        </div>
        <div>
            <div id='result'></div>    
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('#registerModal').modal('hide')">Close</a>
        <a href="#" id="go" class="btn btn-primary">Save changes</a>
    </div>
</div>
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Redirect', 'red_helper')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/modules_table" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
            </div>
            <div class="d-i_b">
                <a data-toggle="modal" href="#setingsModal" class="btn btn-primary btn-small">
                    {lang('Settings', 'red_helper')}
                </a>
                <a data-toggle="modal" href="#registerModal" class="btn btn-primary btn-small">
                    {lang('Registration', 'red_helper')}
                </a>
            </div>
        </div>                            
    </div>

    <div class="row-fluid">
    </div>
</section>