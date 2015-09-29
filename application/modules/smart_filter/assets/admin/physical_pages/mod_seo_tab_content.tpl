{include_tpl('multi_creation_modal')}

<table class="table  table-bordered table-condensed content_big_td module-cheep content_big_td seo-filter-table">
    <thead>
    <tr>
        <th colspan="5">
            {lang('Physical URLs settings',"smart_filter")}
        </th>
        <th class="span4">
            <button onclick="SPPMultiCreation.showModal()" type="button" class="btn btn-small">
                {lang('Multi creation','smart_filter')}
            </button>

            <button onclick="SeoPhysicalPages.saveSettings(this)" type="button" class="btn btn-small btn-primary">
                <i class="icon-ok icon-white"></i>{lang('Save','admin')}
            </button>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td colspan="6">
            <div class="inside_padd pull-left">
                <div class="form-horizontal">
                    <div class="row-fluid">

                        <div class="btn-group" style="text-align: left;">
                            <div class="semantic_url_entity_finder input-prepend input-append">
                                <button data-entity_id="1" class="btn" type="button">
                                    {lang('Category',"smart_filter")}
                                </button>
                                <select name="category" id="category" onchange="SeoPhysicalPages.getBrands(this);SeoPhysicalPages.getProperties(this)">
                                    <option value="0">--{echo lang('Select category',"smart_filter")}--</option>
                                    {foreach $categories as $category}
                                        <option {if $category->getLevel() == 0}style="font-weight: bold;"{/if} value="{echo $category->getId()}">{str_repeat('-',$category->getLevel())}{echo ShopCore::encode($category->getName())}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <div style="display: none;" class="semantic_url_entity_finder brands_url_entity_finder input-prepend input-append">
                                <br>
                                <span class="help-block">{lang('Select category brands or properties', 'smart_filter')}</span>
                                <br>
                                <button class="btn" type="button">
                                    {lang('Brand',"smart_filter")}
                                </button>

                                <select class="brands-select" data-type="brand" onchange="SeoPhysicalPages.prependToNavs(this)"></select>
                            </div>

                            <div style="display: none;" class="semantic_url_entity_finder properties_url_entity_finder input-prepend input-append">
                                <button class="btn" type="button">
                                    {lang('Property',"smart_filter")}
                                </button>

                                <select class="properties-select" data-type="property" onchange="SeoPhysicalPages.prependToNavs(this)"></select>
                            </div>
                        </div>

                        <hr>
                        <div class="nav-tabs-seo-links-holder">
                            <div class="row-fluid news empty-urls-list" {if $links}style="display: none"{/if}>
                                <div class="span12">
                                    <div class="alert alert-info">
                                        <p>{lang('URLs list is empty','smart_filter')}.</p>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-bordered table-condensed content_big_td module-cheep content_big_td nav-tabs-seo-links">
                                <thead>
                                <tr>
                                    <th>{lang('Category', 'smart_filter')}</th>
                                    <th style="width: 40px">{lang('Type', 'smart_filter')}</th>
                                    <th class="span3">{lang('Name', 'smart_filter')}</th>
                                    <th style="padding-left: 10px; width: 55px">{lang('Operatioins', 'smart_filter')}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $links as $key => $link}
                                    <tr {if $key === 0}class="active"{/if} data-entitytype="{echo $link['type']}"
                                        data-entityid="{echo $link['entity_id']}"
                                        data-categoryid="{echo $link['category_id']}"
                                        data-id="{echo $link['id']}">

                                        <td>{echo $link['category_name']}</td>
                                        <td>
                                            {if $link['type'] === 'brand'}
                                                {lang('Brand', 'smart_filter')}
                                            {else:}
                                                {lang('Property', 'smart_filter')}
                                            {/if}
                                        </td>
                                        <td>
                                            {if $link['show_url']}
                                                <a href="{echo $link['show_url']}" target="_blank" data-rel="tooltip" data-title="{lang('Go to the page', 'smart_filter')}">
                                                    {if $link['type'] === 'brand'}
                                                        {echo $link['brand_name']}
                                                    {else:}
                                                        {echo $link['property_name']}
                                                    {/if}
                                                </a>
                                            {else:}
                                                {echo $link['property_name']}
                                            {/if}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-small editLink">
                                                <i class="icon-edit" style="z-index: 3;"></i>
                                            </button>
                                            <button onclick="SeoPhysicalPages.removeLink(this)" data-id="{echo $link['id']}" type="button" class="btn btn-small removeLinkBytton">
                                                <i class="icon-trash" style="z-index: 3;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="inside_padd pull-right">
                <div class="form-horizontal formSeoPhysicalPages">
                    {$link = $links[0];}
                    <input type="hidden" name="smart_filter[id]" value="{echo $link['id']}">
                    <input type="hidden" name="smart_filter[type]" value="{echo $link['type']}">
                    <input type="hidden" name="smart_filter[entity_id]" value="{echo $link['entity_id']}">
                    <input type="hidden" name="smart_filter[category_id]" value="{echo $link['category_id']}">

                    <div class="row-fluid smart-filter-form-fields">

                        <label class="control-group frame_label no_connection" style="display: block;">
                                    <span class="offset1 span2">
                                        {lang('Active','smart_filter')}:
                                    </span>
                                    <span class="span9 {if $link['active'] == 1}active{/if}">
                                        <span class="niceCheck b_n v-a_t">
                                            <input class="span4" name="smart_filter[active]" {if $link['active'] == 1} checked="checked" {/if} type="checkbox"/>
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
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>

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
                                        <input class="span9" type="text" name='smart_filter[h1]' id="smart_filter-h1" value="{echo $link['h1']}"/>
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
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>

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
                                        <textarea id="smart_filter-meta_title" name="smart_filter[meta_title]" style="max-height: 60px">{echo $link['meta_title']}</textarea>
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
                                        <textarea id="smart_filter-meta_keywords" name="smart_filter[meta_keywords]">{echo $link['meta_keywords']}</textarea>
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
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>

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
                                        <textarea id="smart_filter-meta_description" name="smart_filter[meta_description]">{echo $link['meta_description']}</textarea>
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
                                                    <b>%maxPrice%</b> - {lang("Minimal price in category",'mod_seo')}<br/>
                                                    <b>%minPrice%</b> - {lang("Maximal price in category",'mod_seo')}<br/>

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
                                        <textarea id="smart_filter-text" class="elRTE" name="smart_filter[seo_text]">{echo $link['seo_text']}</textarea>
                                    </span>
                        </label>


                    </div>
                </div>
            </div>
        </td>
    <tr>
    </tbody>
</table>
