<div class="modal hide fade modal_multi_creation">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>{lang('Multi creation','admin')}</h3>
    </div>
    <div class="modal-body">
        <div class="pull-left leftContainer">
            <div class="semantic_url_entity_finder input-prepend input-append">
                <button data-entity_id="1" class="btn" type="button">
                    {lang('Category',"smart_filter")}
                </button>
                <select name="smart_filter[category]" id="category" onchange="SeoPhysicalPages.getBrands(this);SeoPhysicalPages.getProperties(this)">
                    <option value="0">--{echo lang('Select category',"smart_filter")}--</option>
                    {foreach $categories as $category}
                        <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())}{echo ShopCore::encode($category->getName())}</option>
                    {/foreach}
                </select>
            </div>

            <div style="display: none;" class="semantic_url_entity_finder brands_url_entity_finder input-prepend input-append">
                <span class="help-block">{lang('Select category brands or properties', 'smart_filter')}</span>
                <button class="btn" type="button">
                    {lang('Brands',"smart_filter")}
                </button>

                <select name="smart_filter[brands][]" class="brands-select" data-type="brand" multiple="multiple"></select>
            </div>

            <div style="display: none;" class="semantic_url_entity_finder properties_url_entity_finder input-prepend input-append">
                <button class="btn" type="button">
                    {lang('Properties',"smart_filter")}
                </button>

                <select name="smart_filter[properties][]" class="properties-select" data-type="property" multiple="multiple"></select>
            </div>

        </div>
        <div class="form-horizontal formSeoPhysicalPages pull-right rightContainer">
            <div class="row-fluid smart-filter-form-fields">

                <label class="control-group frame_label no_connection" style="display: block;">
                    <span class="offset1 span2">
                        {lang('Active','smart_filter')}:
                    </span>
                    <span class="span9">
                        <span class="niceCheck b_n v-a_t">
                            <input class="span4" name="smart_filter[active]" type="checkbox"/>
                        </span>
                    </span>
                </label>

                <label class="control-group">
                    <span class="offset1 span2">
                        <span data-title="{lang('Variables, can use to', 'mod_seo')}" class="popover_ref" data-original-title="" data-placement="left">
                            <i class="icon-info-sign"></i>
                        </span>
                        <div class="d_n">
                            <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                            <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                            <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                            <b>%brands%</b>
                            - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>

                            <br/>
                            {lang('Additional params for using with category name','mod_seo')}
                            :<br/>
                            <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                            <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                            {lang('Example','mod_seo')}:<br/>
                            <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                            <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                            <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                            <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                            <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                            <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                            <b>%name[1..6][t]%</b>
                            - {lang('Совместное использование', 'mod_seo')} <br/>
                        </div>
                        {lang('H1','smart_filter')}:
                    </span>
                    <span class="span9">
                        <input class="span9" type="text" name='smart_filter[h1]' id="smart_filter-h1"/>
                    </span>
                </label>

                <label class="control-group">
                    <span class="offset1 span2">
                        <span data-title="{lang('Variables, can use to', 'mod_seo')}" class="popover_ref" data-original-title="" data-placement="left">
                    <i class="icon-info-sign"></i>
                </span>
                <div class="d_n">
                    <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                    <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                    <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                    <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                    <b>%brands%</b>
                    - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>

                    <br/>
                    {lang('Additional params for using with category name','mod_seo')}
                    :<br/>
                    <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                    <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                    {lang('Example','mod_seo')}:<br/>
                    <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                    <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                    <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                    <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                    <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                    <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                    <b>%name[1..6][t]%</b>
                    - {lang('Совместное использование', 'mod_seo')} <br/>
                </div>
                        {lang('Meta title','smart_filter')}:
                    </span>
                    <span class="span9">
                        <textarea id="smart_filter-meta_title" name="smart_filter[meta_title]" style="max-height: 50px"></textarea>
                    </span>
                </label>

                <label class="control-group">
                    <span class="offset1 span2">
                        <span data-title="{lang('Variables, can use to', 'mod_seo')}" class="popover_ref" data-original-title="" data-placement="left">
                            <i class="icon-info-sign"></i>
                        </span>
                        <div class="d_n">
                            <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                            <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                            <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                            <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                            <b>%brands%</b>
                            - {lang('list of the top brands, separated by ','mod_seo')} <br/>
                        </div>
                        {lang('Meta keywords','smart_filter')}:
                    </span>
                    <span class="span9">
                        <textarea id="smart_filter-meta_keywords" name="smart_filter[meta_keywords]" style="max-height: 50px"></textarea>
                    </span>
                </label>

                <label class="control-group">
                    <span class="offset1 span2">
                        <span data-title="{lang('Variables, can use to', 'mod_seo')}" class="popover_ref" data-original-title="" data-placement="left">
                            <i class="icon-info-sign"></i>
                        </span>
                        <div class="d_n">
                            <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                            <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                            <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                            <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                            <b>%brands%</b>
                            - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>

                            <br/>
                            {lang('Additional params for using with category name','mod_seo')}
                            :<br/>
                            <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                            <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                            {lang('Example','mod_seo')}:<br/>
                            <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                            <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                            <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                            <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                            <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                            <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                            <b>%name[1..6][t]%</b>
                            - {lang('Совместное использование', 'mod_seo')} <br/>
                        </div>
                        {lang('Meta description','smart_filter')}:
                    </span>
                    <span class="span9">
                        <textarea id="smart_filter-meta_description" name="smart_filter[meta_description]" style="max-height: 70px"></textarea>
                    </span>
                </label>

                <label class="control-group">
                    <span class="offset1 span2">
                        <span data-title="{lang('Variables, can use to', 'mod_seo')}" class="popover_ref" data-original-title="" data-placement="left">
                            <i class="icon-info-sign"></i>
                        </span>
                        <div class="d_n">
                            <b>%ID%</b> - {lang('Category ID','mod_seo')}<br/>
                            <b>%name%</b> - {lang('Category name','mod_seo')}<br/>
                            <b>%desc%</b> - {lang('Category description','mod_seo')}<br/>
                            <b>%H1%</b> - {lang('field H1 of category','mod_seo')}<br/>
                            <b>%brands%</b>
                            - {lang('list of the top brands, separated by ','mod_seo')}"," <br/>

                            <br/>
                            {lang('Additional params for using with category name','mod_seo')}
                            :<br/>
                            <b>[t]</b> - {lang('Translit','mod_seo')}<br/>
                            <b>[1..6]</b> - {lang('Number case of word','mod_seo')}<br/>
                            {lang('Example','mod_seo')}:<br/>
                            <b>%name[1]%</b> - {lang('Именительный', 'mod_seo')}<br/>
                            <b>%name[2]%</b> - {lang('Родительный', 'mod_seo')}<br/>
                            <b>%name[3]%</b> - {lang('Частичный', 'mod_seo')}<br/>
                            <b>%name[4]%</b> - {lang('Дательный', 'mod_seo')}<br/>
                            <b>%name[5]%</b> - {lang('Винительный', 'mod_seo')}<br/>
                            <b>%name[6]%</b> - {lang('Творительный', 'mod_seo')}<br/>
                            <b>%name[1..6][t]%</b>
                            - {lang('Совместное использование', 'mod_seo')} <br/>
                        </div>
                        {lang('Seo text','smart_filter')}:
                    </span>
                    <span class="span9">
                        <textarea id="smart_filter-text" class="elRTE" name="smart_filter[seo_text]"></textarea>
                    </span>
                </label>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary formSubmit" onclick="SPPMultiCreation.save(this)">{lang('Save','admin')}</button>
        <a href="#" class="btn" onclick="$('.modal').modal('hide');">{lang('Cancel','admin')}</a>
    </div>
</div>