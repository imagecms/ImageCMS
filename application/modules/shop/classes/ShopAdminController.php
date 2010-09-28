<?php 
/**
 * ShopAdminController 
 * 
 * @uses Controller
 * @package 
 * @version $id$
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 * @license 
 */
class ShopAdminController extends Controller {

    public $baseAdminUrl = '/admin/components/run/shop/';
    public $shopThemeUrl = '/application/modules/shop/admin/templates/assets/';

    public function __construct()
    {
        parent::Controller();

        $this->template->add_array(array(
            'ADMIN_URL'=>$this->baseAdminUrl,
            'SHOP_THEME'=>$this->shopThemeUrl,
            'Controller'=>$this,
        ));
    }

    /**
     * Display rendered template file. 
     * 
     * @param string $viewName name of template file to display.
     * @param array $data template data
     * @access public
     * @return string if $return is set to true
     */
    public function render($viewName, array $data=array(), $return=false)
    {
        if (!empty($data))
            $this->template->add_array($data);

        $this->template->display('file:'.$this->getViewFullPath($viewName));
    }

    /**
     * Create full path to template file based on class name and view file name.
     * 
     * @param string $viewName 
     * @access public
     * @return string
     */
    public function getViewFullPath($viewName)
    {
        // Remove "ShopAdmin" from controller name
        $controllerName = str_replace('ShopAdmin', '', get_class($this));

        // Make first charater lowercase
        $controllerName{0} = strtolower($controllerName{0});

        // Create full path to template file
        return SHOP_DIR.'admin'.DS.'templates'.DS.$controllerName.DS.$viewName.'.tpl';
    }

    /**
     * Create url to admin controller. 
     *
     * Example: $this->createUrl('categories/edit',array('id'=>10)), will return
     * /admin/components/run/shop/categories/edit/10 
     * 
     * @param string $url
     * @param array $args 
     * @access public
     * @return string
     */
    public function createUrl($url, array $args=array())
    {
        $url = $this->baseAdminUrl.$url;

        if (!empty($args))
            $url.='/'.implode('/',$args);

        return $url;
    }

    /**
     * Show 404 page
     * 
     * @param string $message Error message
     *
     * @access public
     */
    public function error404($message)
    {
        echo '<div id="notice_error">'.$message.'</div>';
        exit;
    }

    /**
     * Update admin html block
     * 
     * @param string $url 
     * @access public
     */
    public function ajaxShopDiv($url)
    {
        echo '
        <script type="text/javascript">
            ajaxShop("'.$url.'");
        </script>    
        ';
    }
}
