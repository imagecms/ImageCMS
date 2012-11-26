{$header}

<rss version="2.0">
<channel>
    <title>{$title}</title>
    <link>{site_url()}</link>
    <description><![CDATA[{$description}]]></description>

    <generator>{site_url()}</generator>
    <pubDate>{$pub_date}</pubDate>
    <lastBuildDate></lastBuildDate>
    <image>
        <link></link>
        <url></url>
        <title></title>
    </image>
        
        {foreach $items as $item} 
        <item>		
            <title><![CDATA[{$item.title}]]></title>
            <guid isPermaLink="true">{site_url($item.full_url)}</guid>
            <link>{site_url($item.full_url)}</link>			
            <description><![CDATA[{$item.prev_text}]]></description>
            
            <pubDate>{$item.publish_date}</pubDate>
            <author></author>

            <category>{$item.category}</category>
        </item>
        {/foreach}

</channel>
</rss> 
