<div class="container">
    <section class="mini-layout">
        <div class="frame_title clearfix" style="top: 179px; width: 1168px;">
            <div class="pull-left">
                <span class="help-inline"></span>
                <span class="title">{lang('Additional settings of NewLevel module', 'new_level')}</span>
            </div>
            <div class="pull-right">
                <div class="d-i_b">
                    <a href="/admin/components/init_window/new_level" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('Go back', 'new_level')}</span></a>
                    <button type="button" class="btn btn-small btn-primary action_on formSubmit" data-form="#saveMenu" data-action="edit" data-submit><i class="icon-ok icon-white"></i>{lang('Save', 'new_level')}</button>
                </div>
            </div> 
        </div>
        <table id="tickets_table" class="table table-striped table-bordered table-hover table-condensed" style="clear:both;">
            <thead>
            <th class="span1">{lang('Settings', 'new_level')}</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <form method="post" class="form-horizontal" id="saveMenu">
                            <div class="inside_padd">
                                <div class="form-horizontal">
                                    <div class="row-fluid">
                                        <div class="control-group">
                                            <label class="control-label" for="template">{lang('Colour scheme', 'new_level')}:</label>
                                            <div class="controls">                                           
                                                <select onchange="changethema(this)" style="width:25% !important" name="thema" id="template">
                                                    {foreach $thema as $k => $tm}
                                                        <option value="{echo $tm}" {if $cur_thema == $tm} selected="selected" {/if} >{echo $k}</option>
                                                    {/foreach}
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls"> 
                                                <img id="logo" style="max-width: 200px" src="{echo $img . 'screenshot.png'}" />
                                            </div>
                                        </div>        
                                    </div>
                                </div>
                            </div>
                            {form_csrf()}
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>

