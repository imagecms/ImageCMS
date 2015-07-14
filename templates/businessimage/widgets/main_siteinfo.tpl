<ul class="b-siteinfo">
	{if trim(siteinfo('schedule')) != ""}
		<li class="b-siteinfo__item b-siteinfo__item_schedule">
			<i class="b-siteinfo__ico fa fa-map-marker fa-lg"></i>
			<p class="b-siteinfo__text">{echo siteinfo('schedule')}</p>
		</li>
	{/if}

	{if trim(siteinfo('address')) != ""}
		<li class="b-siteinfo__item b-siteinfo__item_address">
			<i class="b-siteinfo__ico fa fa-clock-o fa-lg"></i>
			<address class="b-siteinfo__text">{echo siteinfo('address')}</address>
		</li>
    {/if}

    {if trim(siteinfo('mainphone')) != ""}
    <li class="b-siteinfo__item">
    	<i class="b-siteinfo__ico fa fa-phone fa-lg"></i>
    	<div class="b-siteinfo__text b-siteinfo__text_phone">{echo siteinfo('mainphone')}</div>
    </li>
    {/if}
</ul>