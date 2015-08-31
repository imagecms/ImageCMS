<?php header('content-type: text/xml'); ?>
{echo "<?xml version='1.0' encoding='utf-8'?>"}
<!DOCTYPE yml_catalog SYSTEM 'shops.dtd'>
<yml_catalog date="{echo date('Y-m-d H:i', date('U'))}">
    <shop>
    <name>{echo $infoXml['site_title']}</name>
    <url>{echo $infoXml['base_url']}</url>
    <currencies>
        <currency id="{echo $infoXml['mainCurr']['code']}" rate="1"/>
    </currencies>
    <catalog>
        {foreach $infoXml['categories'] as $c}
            {$parent = ''}
            {if $c->getParentId()>0}
                {$parent = ' parentId="' . $c->getParentId() . '"'}
            {/if}
            <category id="{echo $c->getId()}" {echo $parent}>{echo encode($c->getName())}</category>
        {/foreach}
    </catalog>
    <items>
        {$trueArr = array('categoryId', 'price', 'description', 'name', 'url', 'vendor')}
        {foreach $infoXml['offers'] as $id => $offer}
            <item id="{echo $id}">            
                {foreach $offer as $k => $v}
                    {if $k == 'picture'}
                        {foreach $v as $picture}
                            <image>{echo $picture}</image>
                        {/foreach}                        
                    {/if}
                    {if in_array($k,$trueArr)}
                        <{echo $k}>{echo $v}</{echo $k}>
                    {/if}
                {/foreach}
            </item>
        {/foreach}
    </items>
    </shop>
</yml_catalog>{exit}