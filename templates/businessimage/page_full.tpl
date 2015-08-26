<div class="g-container">
	<h1 class="b-content__title">
		{$page.title}
	</h1>
	<div class="b-content__section g-text">
		{$page.full_text}
	</div>
	{if $page.comments_status == 1}
		{$Comments = $CI->load->module('comments')->show()}
	{/if}
</div>