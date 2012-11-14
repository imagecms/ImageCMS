<div class="container">
<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_poll_edit')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="{$BASE_URL}admin/components/cp/polls/" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_return')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#poll"><i class="icon-ok"></i>{lang('a_save')}</button>
                <button type="button" class="btn btn-small formSubmit" data-form="#poll" data-action="close"><i class="icon-check"></i>{lang('a_save_and_exit')}</button>
            </div>
        </div>

    </div>
            
    <div class="content_big_td clearfix m-t_20">
        <form method="post" action="{site_url('admin/components/cp/polls/edit/' . $poll.id)}" id="poll" class="form-horizontal span9">
        <div class="control-group">
            <label class="control-label" for="inputName">{lang('amt_tname')}:</label>
            <div class="controls">
                <input type="text" class="required" name="name" value="{$poll.name}"  id="inputName"/>
            </div>
        </div>
    
        {$n=1}
        {foreach $answers as $a}
            
        <div class="control-group">
            <label class="control-label">{lang('amt_answer')} {$n}:</label>
            <div class="controls">
                <div class="group_icon pull-right">
                    <div>
                        <button onclick="polls.deleteAnswer({$poll.id}, {$a.id}); return false;" class="btn btn-danger btn-small"><i class="icon-trash icon-white"></i> {lang('a_delete')}</button>
                    </div>
                </div>
                <div class="o_h">
                    <input type="text" class="textbox_long" name="answers[{$a.id}]" value="{encode($a.text)}" />
                </div>
            </div>
        </div>     
            
        {$n++}
        {/foreach}
          
        <div class="control-group addAnswerBtn">
            <div class="controls">
                <button class="btn btn-success btn-small" onclick="polls.addAnswerField(); return false;"><i class="icon-plus-sign icon-white"></i>{lang('a_add')}</button>
            </div>    
        </div>
        </form>
    </div>
            

</section> 
</div>
<div class="control-group" style="display: none" id="answerTpl">
    <label class="control-label">{lang('amt_answer')}</label>
    <div class="controls">
        <input type="text" class="textbox_long" name="new_answer[]" value="" />
    </div>
</div>
<script src="/application/modules/polls/templates/admin/admin.js"></script>