<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang("Settings")}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back")}</span></a>
                <button name="button" class="btn formSubmit btn-primary" data-submit data-form="#gallery_settings_form">{lang("Save")}</button> 
            </div>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active" id="modules">
            <div class="row-fluid">
                <form method="post" action="{site_url('admin/components/cp/gallery/settings/update')}" id="gallery_settings_form">
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Categories and albums")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <div class="control-label">{lang("Sort")}:</div>
                                                <div class="controls">
                                                    <select name="order_by" class="input-large">
                                                        <option value="date" {if $settings.order_by == "date"} selected="selected" {/if}>{lang("By date")}</option>    
                                                        <option value="name" {if $settings.order_by == "name"} selected="selected" {/if}>{lang("in alphabetic order")}</option>    
                                                        <option value="position" {if $settings.order_by == "position"} selected="selected" {/if}>{lang("By position")}</option> 
                                                    </select>
                                                    <select name="sort_order" class="input-large">
                                                        <option value="desc" {if $settings.sort_order == "desc"} selected="selected" {/if}>{lang("in descending order")}</option> 
                                                        <option value="asc" {if $settings.sort_order == "asc"} selected="selected" {/if}>{lang("in  ascending order")}</option>    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Images")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="max_file_size">{lang("maximum file size")}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;{lang("In megabites")}</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.max_file_size}" name="max_file_size" id="max_file_size"/> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="max_width">{lang("Maximum width")}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;px</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.max_width}" name="max_width" id="max_width"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="max_height">{lang("Maximum height")}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;px</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.max_height}" name="max_height" id="max_height"/>
                                                    </div>
                                                </div>
                                            </div><div class="control-group">
                                                <label class="control-label" for="quality">{lang("Quality")}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;%</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.quality}" name="quality" id="quality" maxlength="3" data-max="100"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">{lang("Save ratio")}</div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1" {if $settings.maintain_ratio == TRUE}checked="checked"{/if}   name="maintain_ratio" />{lang("Yes")}</label>
                                                    <label class="d-i_b"><input type="radio" value="0" {if $settings.maintain_ratio == FALSE}checked="checked"{/if} name="maintain_ratio" />{lang("No")}</label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">{lang("Cut the borders")}</div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1" {if $settings.crop == TRUE}checked="checked"{/if}   name="crop" /> {lang("Yes")}</label>
                                                    <label class="d-i_b"><input type="radio" value="0" {if $settings.crop == FALSE}checked="checked"{/if} name="crop" /> {lang("No")}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Image preview")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="prev_img_width">{lang("height")}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;{lang("px")}</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.prev_img_width}" name="prev_img_width" id="prev_img_width"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="prev_img_height">{lang('amt_height')}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;{lang("px")}</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.prev_img_height}" name="prev_img_height" id="prev_img_height"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">{lang("Save ratio")}</div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1" {if $settings.maintain_ratio_prev == TRUE}checked="checked"{/if}   name="maintain_ratio_prev" /> {lang("Yes")}</label>
                                                    <label class="d-i_b"><input type="radio" value="0" {if $settings.maintain_ratio_prev == FALSE}checked="checked"{/if} name="maintain_ratio_prev" /> {lang("No")}</label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">{lang("Cut the borders")}</div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1" {if $settings.crop_prev == TRUE}checked="checked"{/if}   name="crop_prev" /> {lang("Yes")}</label>
                                                    <label class="d-i_b"><input type="radio" value="0" {if $settings.crop_prev == FALSE}checked="checked"{/if} name="crop_prev" /> {lang("No")}</label>
                                                </div>
                                            </div>
                                        </div>                                                
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Image icons")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="thumb_width">{lang("height")}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;{lang("px")}</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.thumb_width}" name="thumb_width" id="thumb_width"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="thumb_height">{lang('amt_height')}</label>
                                                <div class="controls">
                                                    <div class="pull-right help-block">&nbsp;&nbsp;{lang("px")}</div>
                                                    <div class="o_h number">
                                                        <input type="text" value="{$settings.thumb_height}" name="thumb_height" id="thumb_height"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">{lang("Save ratio")}</div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1" {if $settings.maintain_ratio_icon == TRUE}checked="checked"{/if} name="maintain_ratio_icon" /> {lang("Yes")}</label>
                                                    <label class="d-i_b"><input type="radio" value="0" {if $settings.maintain_ratio_icon == FALSE}checked="checked"{/if} name="maintain_ratio_icon" /> {lang("No")}</label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="control-label">{lang("Cut the borders")}</div>
                                                <div class="controls">
                                                    <label class="d-i_b m-r_15"><input type="radio" value="1" {if $settings.crop_icon == TRUE}checked="checked"{/if}   name="crop_icon" /> {lang("Yes")}</label>
                                                    <label class="d-i_b"><input type="radio" value="0" {if $settings.crop_icon == FALSE}checked="checked"{/if} name="crop_icon" /> {lang("No")}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-striped table-bordered table-hover table-condensed content_big_td">
                        <thead>
                            <tr>
                                <th colspan="6">
                                    {lang("Watermark")}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="6">
                                    <div class="inside_padd">
                                        <div class="row-fluid">
                                            <div class="control-group">
                                                <label class="control-label" for="wm_hor_alignment">{lang("horizontal alignment")}</label>
                                                <div class="controls">
                                                    <select name="wm_hor_alignment" id="wm_hor_alignment">
                                                        <option {if $settings.wm_hor_alignment == 'left'}selected="selected"{/if} value="left">{lang("left or on the left")}</option>
                                                        <option {if $settings.wm_hor_alignment == 'center'}selected="selected"{/if} value="center">{lang("in the center")}</option>
                                                        <option {if $settings.wm_hor_alignment == 'right'}selected="selected"{/if} value="right">{lang("on the right")}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="wm_vrt_alignment">{lang("vertical alignment")}</label>
                                                <div class="controls">
                                                    <select name="wm_vrt_alignment" id="wm_vrt_alignment">
                                                        <option {if $settings.wm_vrt_alignment == 'top'}selected="selected"{/if} value="top">{lang("at the top")}</option>
                                                        <option {if $settings.wm_vrt_alignment == 'middle'}selected="selected"{/if} value="middle">{lang("in the middle")}</option>
                                                        <option {if $settings.wm_vrt_alignment == 'bottom'}selected="selected"{/if} value="bottom">{lang("at the bottom")}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label" for="watermark_type">{lang("Type")}</label>
                                                <div class="controls">
                                                    <select name="watermark_type" onchange="show_watermark_block();" id="watermark_type">
                                                        <option value="text"  {if $settings.watermark_type == 'text'}selected="selected"{/if}  >{lang("Text")}</option>
                                                        <option value="overlay" {if $settings.watermark_type == 'overlay'}selected="selected"{/if} >{lang("Image")}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- Image settings -->
                                            <div id="image_settings" {if $settings.watermark_type == 'text'}style="display:none;"{/if}>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_image">{lang("Path to the image")}</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$settings.watermark_image}" name="watermark_image" id="watermark_image"/>
                                                        <span class="help-inline">{lang("File has to be located on the server. For example")}: ./uploads/images/logo.png</span>            
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_image_opacity">{lang("Transparency")}</label>
                                                    <div class="controls">
                                                        <div class="pull-right help-block">&nbsp;&nbsp;%</div>
                                                        <div class="o_h number">
                                                            <input type="text" value="{$settings.watermark_image_opacity}" name="watermark_image_opacity" id="watermark_image_opacity" maxlength="3" data-max="100"/>
                                                            <span class="help-inline">{lang("Select a digit from 1 to 100")}</span> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_padding">{lang("Offset")}</label>
                                                    <div class="controls">
                                                        <div class="pull-right help-block">&nbsp;&nbsp;{lang("px")}</div>
                                                        <div class="o_h">
                                                            <input type="text" value="{$settings.watermark_padding}" name="watermark_padding" id="watermark_padding"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="text_settings" {if $settings.watermark_type == 'overlay'}style="display:none;"{/if}>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_text">{lang("Text")}</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$settings.watermark_text}" name="watermark_text" id="watermark_text"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_font_size">{lang("Font size")}</label>
                                                    <div class="controls number">
                                                        <input type="text" value="{$settings.watermark_font_size}" name="watermark_font_size" id="watermark_font_size"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_color">{lang("Font colour")}</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$settings.watermark_color}" name="watermark_color" id="watermark_color" maxlength="6"/>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_padding2">{lang("Offset")}</label>
                                                    <div class="controls">
                                                        <div class="pull-right help-block">&nbsp;&nbsp;{lang("px")}</div>
                                                        <div class="o_h">
                                                            <input type="text" value="{$settings.watermark_padding}" name="watermark_padding" id="watermark_padding2"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="watermark_font_path">{lang("Path to font")}</label>
                                                    <div class="controls">
                                                        <input type="text" value="{$settings.watermark_font_path}" name="watermark_font_path" id="watermark_font_path"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</section>
{literal}
    <script type="text/javascript">
                                                        function show_watermark_block()
                                                        {
                                                            $('#text_settings, #image_settings').toggle();
                                                        }

    </script>
{/literal}




