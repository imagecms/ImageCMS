<div class="b-addinfo">
	<div class="b-addinfo__list g-clearfix">

		<div class="b-addinfo__item">
			<i class="b-addinfo__item-icon fa fa-user" title="{tlang('Posted by')}"></i>
			<span class="b-addinfo__item-text">{$page.author}</span>
		</div>

		<div class="b-addinfo__item">
			<i class="b-addinfo__item-icon fa fa-clock-o" title="{tlang('Publication Date')}"></i>
			<time class="b-addinfo__item-text" datetime="{date('Y-m-d', $page.publish_date)}">{locale_date("d F y", $page.publish_date)}</time>
		</div>
		<div class="b-addinfo__item">
			<i class="b-addinfo__item-icon fa fa-eye" title="{tlang('Number of views')}"></i>
			<span class="b-addinfo__item-text">{$page.showed}</span>
		</div>
		{if $page.comments_status != 0}
		<div class="b-addinfo__item">
			{if $page.comments_count > 0}
				<i class="b-addinfo__item-icon fa fa-comment" title="{tlang('Number of comments')}"></i>
			{/if}
			{if $page.comments_count <= 0}
				<i class="b-addinfo__item-icon fa fa-comment-o" title="{tlang('Number of comments')}"></i>
			{/if}
				<span class="b-addinfo__item-text">{$page.comments_count}</span>
		</div>
		{/if}
	</div>
</div>