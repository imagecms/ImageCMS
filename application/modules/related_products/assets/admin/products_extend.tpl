<table class="table  table-bordered table-hover table-condensed content_big_td">
    <thead>
        <tr>
            <th colspan="6">{lang('Related products', 'related_products')}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6">
                <div class="inside_padd">
                    <div class="form-horizontal">
                        <div class="control-group">
                            <label class="control-label">{lang('Product', 'related_products')}:</label>
                            <div class="controls">

                                <div class="related-out-prod">
                                    <div class="clearfix">
                                        <div class="photo-block">
                                            <span class="helper"></span>
                                            {if $product->getfirstvariant()->getSmallPhoto()}
                                                <img src="{site_url($product->getfirstvariant()->getSmallPhoto())}">
                                            {else:}
                                                <img src="{$THEME}images/select-picture.png" class="img-polaroid">
                                            {/if}
                                        </div>
                                        <div class="title">{echo $product->getName()}</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {$colorField = ShopCore::app()->CustomFieldsHelper->getOneCustomFieldsByName('color','product', $product->getId())->asHtml(FALSE)}
                        {if $colorField}
                            <div class="control-group">
                                <label class="control-label">{lang('Color of main product', 'related_products')}:</label>
                                <div class="controls">
                                    <div class="related-input-ins">
                                        {echo $colorField}
                                    </div>
                                </div>
                            </div>

                        {/if}
                        <div class="control-group">
                            <label class="control-label">{lang('Relate width product', 'related_products')}:</label>
                            <div class="controls">
                                <div>
                                    <input type="text" class="span4" id="related_products_search_product" data-productid="{echo $product->getId()}">
                                </div>

                                <select id="related_products_products_select" multiple="multiple" class="notchosen" style="display: none; min-width: 356px; min-height: 100px; max-height: 100px">
                                </select>

                                <select id="related_products_products_list" multiple="multiple" class="notchosen" style="display: none; height:250px !important; width:620px">
                                    {foreach $related_products as $product}
                                        <option data-hrefadmin="{echo site_url('admin/components/run/shop/products/edit')}/{echo $product->getId()}" data-hreffront="{echo site_url('shop/product')}/{echo $product->getUrl()}" value="{echo $product->getId()}">{echo $product->getId()} - {echo $product->getName()}</option>
                                    {/foreach}
                                </select>

                                <select id="related_products_products_input" name="related_products[products][]" multiple="multiple" style="display: none;">
                                    {foreach $related_products as $product}
                                        <option selected="selected" value="{echo $product->getId()}">{echo $product->getId()} - {echo $product->getName()}</option>
                                    {/foreach}
                                </select>

                                <div class="text-el tell-me-inf">{lang('ID', 'admin')}/{lang('Name', 'admin')}/{lang('Article', 'admin')}</div>
                                <div class="related-table" {if !count($related_products)}style="display: none;"{/if}>
                                    <div class="title">{lang('Chosed products', 'related_products')}</div>
                                    <div class="related-table-body">
                                        {foreach $related_products as $product}
                                            <div class="item-related">
                                                <button class="btn deleteRelatedProduct" type="button" data-productId="{echo $product->getId()}">
                                                    <i class="icon-trash"></i>
                                                </button>
                                                <a href="{echo site_url('admin/components/run/shop/products/edit')}/{echo $product->getId()}">
                                                    <span class="photo-block">
                                                        <span class="helper"></span>
                                                        {if $product->getfirstvariant()->getSmallPhoto()}
                                                            <img src="{site_url($product->getfirstvariant()->getSmallPhoto())}">
                                                        {else:}
                                                            <img src="{$THEME}images/select-picture.png" class="img-polaroid">
                                                        {/if}
                                                    </span>
                                                    <span class="title">{echo $product->getName()}</span>
                                                </a>
                                                <div class="description">
                                                    <div class="frame-price">
                                                        <span class="price">{echo number_format($product->firstVariant->getPriceInMain(), 5, ".", "")}</span>
                                                        <span class="curr">{echo ShopCore::app()->SCurrencyHelper->getSymbolById($product->firstVariant->getCurrency())}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </tbody>
</table>