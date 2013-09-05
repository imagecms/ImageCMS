{if !$ADMIN_URL}
    {$ADMIN_URL = '/admin/components/run/shop/'}
{/if}
<nav class="navbar navbar-inverse">
    <ul class="nav">
        <li class="homeAnchor" ><a href="{$ADMIN_URL}dashboard" class="pjax "><i class="icon-home"></i><span>{lang('Main','admin')}</span></a></li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-shopping-cart"></i>{lang('Orders','admin')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="nav-header">{lang("Orders","admin")}</li>
                <li><a href="{$ADMIN_URL}orders/index" class="pjax">{lang('All orders','admin')}</a></li>
                <li><a href="{$ADMIN_URL}orderstatuses" class="pjax">{lang('Order status','admin')}</a></li>
                <li class="nav-header">{lang('Callbacks','admin')}</li>
                <li><a href="{$ADMIN_URL}callbacks" class="pjax">{lang('Callback','admin')}</a></li>
                <li><a href="{$ADMIN_URL}callbacks/statuses" class="pjax">{lang('Callback statuses','admin')}</a></li>
                <li><a href="{$ADMIN_URL}callbacks/themes" class="pjax">{lang('Callback themes','admin')}</a></li>
                <li class="nav-header">{lang("Arrival notification","admin")}</li>
                <li><a href="{$ADMIN_URL}notifications" class="pjax">{lang('Reports of the appearance','admin')}</a></li>
                <li><a href="{$ADMIN_URL}notificationstatuses/index" class="pjax">{lang('Statuses of the appearance','admin')}</a></li>
                <li class="nav-header">{lang('Others','admin')}</li>                                  
                <li><a class="pjax" href="/admin/components/cp/comments">{lang('Comments','admin')}</a></li>

            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-list-alt"></i>{lang('Products catalog','admin')}<b class="caret"></b></a>
            <ul class="dropdown-menu">

                <li><a href="/admin/components/run/shop/categories/index" class="pjax">{lang('Categories','admin')}</a>    </li>
                <li><a href="/admin/components/run/shop/search/index" class="pjax">{lang('Products','admin')}</a></li>
                <li><a href="/admin/components/run/shop/properties/index" class="pjax">{lang('Products properties','admin')}</a></li>
                <li><a href="/admin/components/run/shop/kits/index" class="pjax">{lang('Products sets','admin')}</a></li>
                <li><a href="/admin/components/run/shop/search/index?WithoutImages=1" class="pjax">{lang('Products without images','admin')}</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i>{lang('Users','admin')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="{$ADMIN_URL}users/index" class="pjax">{lang('Users list','admin')}</a></li>
                <li><a href="/admin/rbac/roleList" class="pjax">{lang('Management of access rights','admin')}</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-briefcase"></i>{lang('Components','admin')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/brands/index" class="pjax">{lang('Brands', 'admin')}</a></li>
                <li><a href="/admin/components/run/shop/warehouses/index" class="pjax">{lang('Warehouse','admin')}</a></li>
                <li><a href="/admin/components/run/shop/banners/index" class="pjax">{lang('Banners','admin')}</a></li>
                <li><a href="/admin/components/run/shop/discounts/index" class="pjax">{lang("Regular discounts","admin")}</a></li>
                <li><a href="/admin/components/run/shop/comulativ/index" class="pjax">{lang('Progressive discounts','admin')}</a></li>
                <li><a href="/admin/components/run/shop/gifts" class="pjax">{lang('Gift Certificates','admin')}</a></li>
                <li><a href="/admin/components/run/shop/customfields" class="pjax">{lang('Additional fields','admin')}</a></li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i>{lang('Settings','admin')}<b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/admin/components/run/shop/settings" class="pjax">{lang('Global settings','admin')}</a></li>
                <li><a href="/admin/components/run/shop/currencies" class="pjax">{lang('Currency','admin')}</a></li>
                <li><a href="/admin/components/run/shop/deliverymethods/index" class="pjax">{lang('Delivery method','admin')}</a></li>
                <li><a href="/admin/components/run/shop/paymentmethods/index" class="pjax">{lang('Payd method','admin')}</a></li>
                <li><a href="/admin/components/run/shop/system/import">{lang('Automation','admin')}</a></li>
            </ul>
        </li>
    </ul>
        <a class="btn btn-small pull-right btn-info" onclick=" loadBaseInterface();"  href="#"><span class="f-s_14">←</span> {lang('Administer site','admin')} </a>
</nav>
