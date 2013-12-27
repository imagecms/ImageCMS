<!-- Show Banners in circle -->
{$CI->load->module('banners')->render()}
<!-- Show banners in circle -->
{\Category\RenderMenu::create()->setConfig(array('url.shop.category'=>'/mobile/category/'))->load('category_menu')}
