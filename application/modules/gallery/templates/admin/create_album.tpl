<section class="mini-layout">
    <div class="frame_title clearfix">
        <div class="pull-left">
            <span class="help-inline"></span>
            <span class="title">{lang('amt_create_album')}</span>
        </div>
        <div class="pull-right">
            <div class="d-i_b">
                <a href="/admin/components/cp/gallery" class="t-d_n m-r_15"><span class="f-s_14">←</span> <span class="t-d_u">{lang('a_back')}</span></a>
                <button type="button" name="button" class="btn formSubmit" data-form="#create_album_form" data-submit>{lang('amt_create_album')}</button> 
            </div>
        </div>
    </div>
    <div class="inside_padd">
        <div class="form-horizontal row-fluid">
            <div class="span7">
                <form method="post" action="{site_url('admin/components/cp/gallery/create_album')}" id="create_album_form">
                    <div class="control-group">
                        <label class="control-label" for="category_id">{lang('amt_category')}:</label>
                        <div class="controls">
                            <select name="category_id" id="category_id">
                                <!-- <option value="0">Нет</option> -->
                                {foreach $categories as $item}
                                <option value="{$item.id}">{$item.name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="name">{lang('amt_name')}:</label>
                        <div class="controls">
                            <input type="text" name="name" id="name" value=""/>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="description">{lang('amt_description')}:</label>
                        <div class="controls">
                            <textarea name="description" id="description" class="mceEditor"></textarea>
                        </div>
                    </div>
                    {form_csrf()}
                </form>
            </div>
        </div>
    </div>
</section>