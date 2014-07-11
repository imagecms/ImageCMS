<?php header('content-type: text/xml'); ?>
{"<?xml version='1.0' encoding='utf-8'?>"}
{"<!DOCTYPE yml_catalog SYSTEM 'shops.dtd'>"}
<yml_catalog date="{echo date('Y-m-d H:i')}">
    <shop>
        <name>{echo $infoXml['site_short_title']}</name>
        <company>{echo $infoXml['site_title']}</company>
        <url>{echo $infoXml['base_url']}</url>
        <platform>ImageCMS</platform>
        <version>{echo $infoXml['imagecms_number']}</version>
        <email>{echo $infoXml['siteinfo_adminemail']}</email>
        <currencies>
            <currency id="{echo $infoXml['currencyCode']}" rate="1"/>
        </currencies>
        <categories>
            {foreach $infoXml['categories'] as $c}
                {$parent = ''}
                {if $c->getParentId()>0}
                    {$parent = ' parentId="' . $c->getParentId() . '"'}
                {/if}
                <category id="{echo $c->getId()}" {echo $parent}>{echo encode($c->getName())}</category>
                {/foreach}
        </categories>
        <offers>
            {foreach $infoXml['offers'] as $id => $offer}
                <offer id="{echo $id}" available="true">            
                    {foreach $offer as $k => $v}
                        {if $k == 'param'}
                            {foreach $v as $prop}
                                <param name="{echo str_replace(':', '', $prop['Name'])}">{echo $prop['Value']}</param>
                            {/foreach}
                        {elseif $k == 'picture'}
                            {foreach $v as $picture}
                                <picture>{echo $picture}</picture>
                            {/foreach}
                        {else:}
                            <{echo $k}>{echo $v}</{echo $k}>
                        {/if}
                    {/foreach}
                </offer>
            {/foreach}
        </offers>
    </shop>
</yml_catalog>