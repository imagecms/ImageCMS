 {$page_type = $CI->core->core_data['data_type'];}
 {if $CI->uri->segment(1) == 'shop' && $CI->uri->segment(2) == ''}
{redirect('/')}
{/if}
{$seo = getPage(83);}
{if is_object(ShopCore::$currentCategory)}
    {if trim(ShopCore::$currentCategory->getMetaTitle()) != ''}
        {$meta_title = ShopCore::$currentCategory->getMetaTitle()}
    {else:}
        {if count($model) > 0}{$meta_title = $model->getName()}{/if}
        {$noSeo = true}
    {/if}
{/if}   
        {if $page_type == 'main'}
            <title>{$site_title}</title>
            <meta name="description" content="{$site_description}" />
            <meta name="keywords" content="{$site_keywords}" />
        {else:}
        
        {if !empty($site_title) && $CI->uri->segment(2) == 'brand'}
        <title>{echo $site_title}</title>
         {else:}
         <title>{if $_GET['per_page']}{round($_GET['per_page'] / 12)+1} - {/if}{if $num}{echo $num; echo ' -';}{/if}{if $CI->uri->segment(2) == 'promotion'}{$site_title}{/if}{if $CI->uri->segment(2) == 'product' && count($model) > 0 }{echo $model->getId()} - {echo $model->getName ()} — купить, цена, отзывы, продажа в интернет-магазине "Спортек"{/if}{if $CI->uri->segment(2) != 'product'}{$meta_title}{/if}{if $CI->uri->segment(2) == 'brand' && !$site_title && count($model) > 0}{echo $model->getName()}{/if}{if $CI->uri->segment(2) != 'product'}— купить, цена в интернет-магазине "Спортек"{else:}{/if}</title>     
        {/if}
            {if $CI->uri->segment(2) == 'product' && !$site_description && count($model) > 0}
                <meta name="description" content="{echo $model->getId()} - {echo trim(substr(strip_tags(htmlspecialchars_decode($model->short_description)), 0, 120))}" />
                <meta name="keywords" content="{echo $model->getName()}" />
            {elseif $CI->uri->segment(2) == 'brand' && count($model) > 0}   
              
           {if !empty($site_description) && $CI->uri->segment(2) == 'brand'}
              <meta name="description" content="{echo $site_description}" />
                 {else:}
            <meta name="description" content="{if $num}{echo $num; echo ' - ';}{/if}{echo $model->getName()}. Купить в интернет-магазине туристического снаряжения Спортек: есть хорошие скидки и низкие цены." />
            
           {/if}   
                <meta name="keywords" content="{echo $model->getName()}" />
                
            {elseif $CI->uri->segment(2) == 'category' && !$site_description && count($model) > 0 && $noSeo}
                <meta name="description" content="{echo $model->getName()}. Купить в интернет-магазине туристического снаряжения Спортек: есть хорошие скидки и низкие цены." />
                <meta name="keywords" content="{echo $model->getName()}" />
            {elseif $CI->uri->segment(2) == 'promotion'}
                <meta name="description" content="{if $curPaginPage > 1}{$curPaginPage} - {/if}Акции и скидки на все товары — купить, цена, отзывы, продажа в интернет-магазине Спортек" />
                <meta name="keywords" content="{$site_keywords}" />            
            {else:}
                <meta name="description" content="{$site_description}" />
                <meta name="keywords" content="{$site_keywords}" />
            {/if}
        {/if}
    {if $CI->uri->segment(2) == 'cart'}<meta name="robots" content="noindex, nofollow" />{/if}    
    {/*}{if $CI->uri->segment(2) == 'category' && count($_GET) > 1 && $_GET.per_page || $CI->uri->segment(2) == 'category' && $customField != ''  || $CI->uri->segment(2) == 'category' && $_GET['rp']}{*/}
    {if $CI->uri->segment(2) == 'category' && !empty($_GET)}
        <link rel="canonical" href="{shop_url('category/'.$model->full_path)}"/>
    {/if}

    {if $CI->uri->segment(2) == 'promotion' && count($_GET) > 1 && $_GET.per_page || $CI->uri->segment(2) == 'promotion' && count($_GET) > 0 && !$_GET.per_page}
        <link rel="canonical" href="{shop_url('promotion')}"/>
    {/if}   
    
    
     {if isset($_GET['admin'])}
        <META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
        <link rel="canonical" href="{site_url('/')}"/>
    {/if} 
