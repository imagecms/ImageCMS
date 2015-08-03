<!DOCTYPE html>
<html lang="{current_language()}">
<head>
	
	<!-- Meta data -->
	<meta charset="UTF-8">
	<title>{$site_title}</title>
	<meta name="description" content="{$site_description}">
	<meta name="keywords" content="{$site_keywords}">
	<meta name="generator" content="ImageCMS">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Stylesheet data -->
	<base href="{$THEME}">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,700,400&amp;subset=cyrillic-ext,latin'>
	<link rel="stylesheet" href="_css/reset.css">
	<link rel="stylesheet" href="_css/globals.css">
	<link rel="stylesheet" href="_css/layout.css">
	<link rel="shortcut icon" href="{siteinfo('siteinfo_favicon_url')}" type="image/x-icon">

</head>
<body>
	<!-- Footer to bottom -->
	<div class="b-footer-bottom-helper">
		<div class="b-footer-bottom-helper-2">

			<div class="b-main">
				
				<!-- Header -->
				{include_tpl('widgets/main_header')}
					
				<!-- Home Page Content  -->
				{if $CI->core->core_data['data_type'] == 'main'}
						
					<!-- Banner -->
					{include_tpl('widgets/main_banner')}
						
					<!-- Tizers -->
					{include_tpl('widgets/main_dashboard')}
						
					<!-- Main page content -->
					{if $CI->core->settings['main_type'] == 'category'}
						<!-- Category -->
						{include_tpl('widgets/main_category')}
					{else:}
						<!-- Page -->
						{include_tpl('widgets/main_page')}
					{/if}
					
					<!-- Latest photos -->
					{widget('main_gallery')}
					
					<!-- Latest Reviews -->
					{widget('main_reviews')}
					
					<!-- Latest Blog posts -->
					{widget('main_blog')}
					
					<!-- Partners Logos Slider -->
					{include_tpl('widgets/main_partners')}
					
				<!-- Inside Pages Content -->
				{else:}
				
					<!-- Bread Crumbs -->
					{widget('breadcrumbs')}
					
					<!-- Main Body Content -->
					<div class="b-content">
						{$content}
					</div>
				
				{/if}
				
			</div>

		</div>
	</div>

	<!-- Footer -->
	{include_tpl('widgets/main_footer')}
	

	<!-- JS data -->
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="//cdn.jsdelivr.net/jquery.slick/1.4.1/slick.min.js"></script>
	<script src="http://yastatic.net/jquery/fancybox/2.1.4/jquery.fancybox.min.js"></script>
	<script src="_lib/doubletaptogo/doubletaptogo.min.js"></script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="_js/scripts.js"></script>

</body>
</html>