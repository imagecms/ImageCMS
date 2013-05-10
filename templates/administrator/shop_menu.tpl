{if !$ADMIN_URL}
    {$ADMIN_URL = '/admin/components/run/shop/'}
{/if}
<nav class="navbar navbar-inverse">
    <ul class="nav">
        <li class="homeAnchor" ><a href="{$ADMIN_URL}dashboard" class="pjax "><i class="icon-home"></i><span>{lang('Main')}</span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i>{lang('Orders')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="nav-header">{lang("Orders")}</li>
                <li><a href="{$ADMIN_URL}orders/index" class="pjax">{lang('All orders')}</a></li>
                <li><a href="{$ADMIN_URL}orderstatuses" class="pjax">{lang('Order status')}</a></li>
                <li class="nav-header">{lang('a_callbacks')}</li>
                <li><a href="{$ADMIN_URL}callbacks" class="pjax">{lang('Callback')}</a></li>
                <li><a href="{$ADMIN_URL}callbacks/statuses" class="pjax">{lang('Callback statuses')}</a></li>
                <li><a href="{$ADMIN_URL}callbacks/themes" class="pjax">{lang('Callback themes')}</a></li>
                <li class="nav-header">{lang("Arrival notification")}</li>
                <li><a href="{$ADMIN_URL}notifications" class="pjax">{lang('Reports of the appearance')}</a></li>
                <li><a href="{$ADMIN_URL}notificationstatuses/index" class="pjax">{lang('Statuses of the appearance')}</a></li>
                <li class="nav-header">{lang('Others')}</li>                                  
                <li><a class="pjax" href="/admin/components/cp/comments">{lang('Comments')}</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>{lang('Products catalog')}<b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li><a href="/admin/components/run/shop/categories/index" class="pjax">{lang('Categories')}</a>    </li>
                <li><a href="/admin/components/run/shop/search/index" class="pjax">{lang('Products')}</a></li>
                <li><a href="/admin/components/run/shop/properties/index" class="pjax">{lang('Products properties')}</a></li>
                <li><a href="/admin/components/run/shop/kits/index" class="pjax">{lang('Products sets')}</a></li>
                <li><a href="/admin/components/run/shop/search/index?WithoutImages=1" class="pjax">{lang('Products without images')}</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>{lang('Users')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{$ADMIN_URL}users/index" class="pjax">{lang('Users list')}</a></li>
                <li><a href="/admin/rbac/roleList" class="pjax">{lang('Management of access rights')}</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i>{lang('Components')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/brands/index" class="pjax">{lang('Brands')}</a></li>
                <li><a href="/admin/components/run/shop/warehouses/index" class="pjax">{lang('Warehouse')}</a></li>
                <li><a href="/admin/components/run/shop/banners/index" class="pjax">{lang('Banners')}</a></li>
                <li><a href="/admin/components/run/shop/discounts/index" class="pjax">{lang("Regular discounts")}</a></li>
                <li><a href="/admin/components/run/shop/comulativ/index" class="pjax">{lang('Progressive discounts')}</a></li>
                <li><a href="/admin/components/run/shop/gifts" class="pjax">{lang('Gift Certificates')}</a></li>
                <li><a href="/admin/components/run/shop/customfields" class="pjax">{lang('Additional fields')}</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i>{lang('Settings')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/settings" class="pjax">{lang('Global settings')}</a></li>
                <li><a href="/admin/components/run/shop/currencies" class="pjax">{lang('Currency')}</a></li>
                <li><a href="/admin/components/run/shop/deliverymethods/index" class="pjax">{lang('Delivery method')}</a></li>
                <li><a href="/admin/components/run/shop/paymentmethods/index" class="pjax">{lang('Payd method')}</a></li>
                <li><a href="/admin/components/run/shop/system/import">{lang('Automation')}</a></li>
            </ul>
        </li>
    </ul>
        <a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> {lang('Administer site')} </a>
</nav>
