<script>
    var currency = '{$CS}'
</script>
<div class="m-t_20">
    <form method="get" id="productFilterForm">

        <div class="pull-right">
            <button type="submit" class="btn btn-small m_t_-10" type="button">
                <i class="icon-refresh"></i> {lang('Update','mod_stats')}
            </button>
        </div>




        <table class="table table-striped table-bordered table-hover table-condensed products_table">
            <thead>
                <tr style="cursor: pointer;">
                    <th class="span1 productListOrder" data-column="Id">{lang('ID','admin')}
                        {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'Id'}
                            {if $_GET.order == 'ASC'}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                            {else:}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                            {/if}
                        {/if}
                    </th>
                    <th class="span3 productListOrder" data-column="Name">{lang('Name','admin')}
                        {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'Name'}
                            {if $_GET.order == 'ASC'}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                            {else:}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                            {/if}
                        {/if}
                    </th>
                    <th class="span2 productListOrder" data-column="CategoryId">{lang('Categories','admin')}
                        {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'CategoryId'}
                            {if $_GET.order == 'ASC'}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                            {else:}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                            {/if}
                        {/if}
                    </th>
                    <th class="span1 productListOrder" data-column="AddedToCartCount">{lang('Added to cart', 'admin')}
                        {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'AddedToCartCount'}
                            {if $_GET.order == 'ASC'}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                            {else:}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                            {/if}
                        {/if}
                    </th>
                    <th class="span1 productListOrder" data-column="Views">{lang('Views', 'admin')}
                        {if isset($_GET.orderMethod) AND $_GET.orderMethod == 'Views'}
                            {if $_GET.order == 'ASC'}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↑</span>
                            {else:}
                                &nbsp;&nbsp;&nbsp;<span class="f-s_14">↓</span>
                            {/if}
                        {/if}
                    </th>
                </tr>
                <tr class="head_body">
                    <td class="number">
                        <div>
                            <input name="filterID" type="text" value="{$_GET.filterID}"/>
                        </div>
                    </td>
                    <td>
                        <input type="text" name="text" value="{$_GET.text}" maxlength="500"/>
                    </td>
                    <td>
                        <select class="" name="CategoryId">
                            <option value="0">{lang('All','admin')}</option>
                            {foreach $categories as $category}
                                {$selected = ''}
                                {if $category->getId() == (int)$_GET.CategoryId}
                                    {$selected='selected="selected"'}
                                {/if}
                                <option value="{echo $category->getId()}" {$selected} >{str_repeat('-',$category->getLevel())} {echo ShopCore::encode($category->getName())}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <!--<input type="text" name="number" value="{$_GET.number}"/>-->
                    </td>
                    <td>
                        <!--<input type="text" name="number" value="{$_GET.number}"/>-->
                    </td>

                </tr>
            <input type="hidden" name="orderMethod" value="{$_GET.orderMethod}"/>
            <input type="hidden" name="order" value="{$_GET.order}"/>
            </thead>
        </table>
    </form>

















<!--<span class="d-i_b m-r_10 m-l_10">{lang('Product', 'mod_stats')} </span>
        <span class="d-i_b">
            <label class="p_r">
                <input 
                    id="autocomleteProduct"
                    class="input-small required" 
                    style="width: 350px;"
                    autocomplete="off"
                    value="" 
                    type="text"/>
                <input 
                    id="autocomleteProductId"
                    type="hidden" 
                    name="pi" value="{$_GET['id']}"/>
            </label>
        </span>-->


</form>
</div>
<hr class="m-t_5" />
