<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('Link editing', 'trash')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/init_window/trash" class="t-d_n m-r_15 pjax"><span class="f-s_14">←</span> <span class="t-d_u">{lang("Back", 'admin')}</span></a>
                <button type="button" class="btn btn-small btn-primary formSubmit" data-form="#edit" data-action="save" data-submit><i class="icon-ok icon-white"></i>{lang("Save", 'trash')}</button>
                <button type="button" class="btn btn-small action_on formSubmit" data-form="#edit" data-action="exit"><i class="icon-check"></i>{lang("Save and exit", 'trash')}</button>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover table-condensed content_big_td m-t_15">
        <thead>
            <tr>
                <th colspan="6">
                    {lang('Link edit', 'trash')}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="6">
                    <div class="inside_padd">
                        <div class="form-horizontal">
                            <form id="edit" method="post" action="{$SELF_URL}/edit_trash/{echo $trash->id}">
                                <div class="span12">
                                    <div class="control-group">
                                        <label class="control-label" for="id">id:</label>
                                        <div class="controls">
                                            <input type="text" readonly="readonly" class="span1" name="id" id="id" value="{echo $trash->id}" required/>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="old_url">{lang('Old URL', 'trash')}: <span class="must">*</span></label>
                                        <div class="controls">
                                            <div class="input-prepend">
                                                <span class="add-on">{site_url()}</span>
                                                <input name="old_url" class="span6" type="text" value="{echo $trash->trash_url}" required="required">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="type">{lang('Type', 'trash')}:</label>
                                        <div class="controls">
                                            <span class="frame_label no_connection m-r_15" id="url">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="redirect_type" value="url" {if $trash->trash_redirect_type == 'url'}checked="checked"{/if}/>
                                                </span>
                                                Url
                                            </span>
                                            {if count($CI->db->get_where('components', array('name' => 'shop'))->row()) > 0}
                                                <span class="frame_label no_connection m-r_15" id="prod">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio" name="redirect_type" value="product" {if $trash->trash_redirect_type == 'product'}checked="checked"{/if}/>
                                                    </span>
                                                    {lang('Product', 'trash')}
                                                </span>
                                                <span class="frame_label no_connection m-r_15" id="cat">
                                                    <span class="niceRadio b_n">
                                                        <input type="radio" name="redirect_type" value="category" {if $trash->trash_redirect_type == 'category'}checked="checked"{/if}/>
                                                    </span>
                                                    {lang('Category', 'trash')}
                                                </span>
                                            {/if}
                                            <span class="frame_label no_connection m-r_15" id="base">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="redirect_type" value="basecategory" {if $trash->trash_redirect_type == 'basecategory'}checked="checked"{/if}/>
                                                </span>
                                                {lang('Category of Base', 'trash')}
                                            </span>
                                            <span class="frame_label no_connection m-r_15" id="404">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="redirect_type" value="404" {if $trash->trash_redirect_type == '404'}checked="checked"{/if}/>
                                                </span>
                                                404
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="type">{lang('Type', 'trash')}:</label>
                                        <div class="controls">
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="type" value="301" {if $trash->trash_type == '301'}checked="checked"{/if}/>
                                                </span>
                                                301
                                            </span>
                                            <span class="frame_label no_connection m-r_15">
                                                <span class="niceRadio b_n">
                                                    <input type="radio" name="type" value="302" {if $trash->trash_type == '302'}checked="checked"{/if}/>
                                                </span>
                                                302
                                            </span>
                                        </div>
                                    </div>

                                    <div class="control-group" id="forUrl" {if $trash->trash_redirect_type != 'url'}style="display: none"{/if}>
                                        <label class="control-label" for="redirect_url">{lang('Redirect Url', 'trash')} :</label>
                                        <div class="controls">
                                            <input type="text" name="redirect_url" id="redirect_url" value="{echo $trash->trash_redirect}"s/>
                                        </div>
                                    </div>
                                    {if count($CI->db->get_where('components', array('name' => 'shop'))->row()) > 0}
                                        <div class="control-group" id="forProd" {if $trash->trash_redirect_type != 'product'}style="display: none"{/if}>
                                            <label class="control-label" for="products">{lang('Product', 'trash')}:</label>
                                            <div class="controls">
                                                <select id="inputMainC" value="" name="products">
                                                    {foreach $products as $item}
                                                        <option {if $trash->trash_id == $item->id}selected{/if} value="{echo $item->id}">{echo $item->name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="control-group" id="forCat" {if $trash->trash_redirect_type != 'category'}style="display: none"{/if}>
                                            <label class="control-label" for="products">{lang('Categories', 'trash')}:</label>
                                            <div class="controls">
                                                <select id="inputMainC" value="" name="category">
                                                    {foreach $category as $item}
                                                        <option {if $trash->trash_id == $item->id}selected{/if} value="{echo $item->id}">{echo $item->name}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                        </div>
                                    {/if}
                                    <div class="control-group" id="forBase" {if $trash->trash_redirect_type != 'basecategory'}style="display: none"{/if}>
                                        <label class="control-label" for="products">{lang('Categories of Base', 'trash')}:</label>
                                        <div class="controls">
                                            <select id="inputMainC" value="" name="category_base">
                                                {foreach $category_base as $item}
                                                    <option {if $trash->trash_id == $item->id}selected{/if} value="{echo $item->id}">{echo $item->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</section>