<form method="post"
      action="/admin/components/init_window/xbanners/edit_banner/{echo $banner->getId()}/{echo $locale}"
      enctype="multipart/form-data"
      id="edit_banner_form" class="m-t_10">

    <table class="table  table-bordered table-hover table-condensed content_big_td">
        <thead>
        <tr>
            <th colspan="6">
                {lang('Options', 'xbanners')}
            </th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    <div class="form-horizontal">
                        <div class="control-group">

                            <label class="control-label" for="Name">{lang('Name', 'xbanners')}:</label>

                            <div class="controls">
                                <input type="text" name="banner[name]" class="input-long" value="{echo htmlspecialchars($banner->getName())}"/>
                            </div>
                            <!-- -->
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>

    <table class="table table-edit-effects table-bordered table-hover table-condensed content_big_td">
        <thead>
        <tr>
            <th colspan="6">
                {lang('Effects', 'xbanners')}

            </th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('autoplay', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <span class="frame_label">
                                    <span class="niceCheck" style="background-position: -46px 0px;">
                                        <input type="checkbox" name="options[autoplay]" class="input-long show-autoplay" {if $options['autoplay']} checked {/if}/>
                                    </span>
                                </span>
                                <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                <div class="d_n">
                                    <p>{echo lang('If this option selected banner slides will be scrolled automatically without user actions.', 'xbanners')}</p>
                                </div>
                            </div>
                        </div>
                        <div class="control-group show-control-group" {if $options['autoplay']}style="display: block;"{/if}>
                            <label class="control-label" for="Name">{lang('autoplaySpeed, (sec)', 'xbanners')}
                                :</label>

                            <div class="controls number">
                                <input onkeyup="checkLenghtStr('autoplaySpeed', 11, 3, event.keyCode)" id="autoplaySpeed" type="text"  name="options[autoplaySpeed]" class="input-long" value='{echo $options['autoplaySpeed']}'/>
                                <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                <div class="d_n">
                                    <p>{echo lang('This option determines automatic scroll speed, time interval through which next slide should be shown.', 'xbanners')}</p>
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('arrows', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <span class="frame_label">
                                    <span class="niceCheck" style="background-position: -46px 0px;" onclick="">
                                         <input type="checkbox" name="options[arrows]" class="input-long" {if $options['arrows']} checked="checked" {/if}/>
                                    </span>
                                </span>
                                <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                <div class="d_n">
                                    <p>{echo lang('If this option enabled arrows navigation through slides will be used.', 'xbanners')}</p>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('dots', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <span class="frame_label">
                                    <span class="niceCheck" style="background-position: -46px 0px;" onclick="">
                                         <input type="checkbox" name="options[dots]" class="input-long" {if $options['dots']} checked="checked" {/if}/>
                                    </span>
                                </span>
                                <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                <div class="d_n">
                                    <p>{echo lang('If this option enabled dots navigation through slides will be used.', 'xbanners')}</p>
                                </div>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('fade', 'xbanners')}
                                :</label>

                            <div class="controls">
                                 <span class="frame_label">
                                    <span class="niceCheck" style="background-position: -46px 0px;" onclick="">
                                        <input type="checkbox" name="options[fade]" class="input-long" {if $options['fade']} checked {/if}/>
                                    </span>
                                </span>

                                <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                <div class="d_n">
                                    <p>{echo lang('Switching banners will be a smooth change rather than scrolling from side to side', 'xbanners')}</p>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('infinite', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <span class="frame_label">
                                    <span class="niceCheck" style="background-position: -46px 0px;" onclick="">
                                        <input type="checkbox" name="options[infinite]" class="input-long" {if $options['infinite']} checked {/if}/>
                                    </span>
                                </span>

                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('Scroll speed(sec)', 'xbanners')}
                                :</label>

                            <div class="controls number">
                                <input onkeyup="checkLenghtStr('scrollSpeed', 11, 3, event.keyCode)" id="scrollSpeed" type="text" name="options[scrollSpeed]" class="input-long" value="{$options['scrollSpeed']}"/>
                                <i class="icon-info-sign popover_ref" data-title="" data-original-title=""></i>

                                <div class="d_n">
                                    <p>{echo lang('Speed with which slide will be changed.', 'xbanners')}</p>
                                </div>

                            </div>
                        </div>

                        { /* }

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('centerMode', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[centerMode]" class="input-long" {if $options['centerMode']} checked {/if}/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('draggable', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[draggable]" class="input-long" {if $options['draggable']} checked {/if}/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('easing', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <select name="options[easing]" class="input-long">
                                    {foreach $options->getEasingTypes() as $type }
                                        <option {if $options['easing'] == $type }selected{/if}>{$type}</option>
                                    {/foreach}
                                </select>
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('pauseOnHover', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[pauseOnHover]" class="input-long" {if $options['pauseOnHover']} checked {/if}/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('pauseOnDotsHover', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[pauseOnDotsHover]" class="input-long" {if $options['pauseOnDotsHover']} checked {/if}/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('swipe', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[swipe]" class="input-long" {if $options['swipe']} checked {/if}/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('touchMove', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[touchMove]" class="input-long" {if $options['touchMove']} checked {/if}/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('vertical', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[vertical]" class="input-long" {if $options['vertical']} checked {/if}/>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="Name">{lang('rtl', 'xbanners')}
                                :</label>

                            <div class="controls">
                                <input type="checkbox" name="options[rtl]" class="input-long" {if $options['rtl']}checked{/if}/>

                            </div>
                        </div>
                        { */ }

                        <!-- -->
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</form>