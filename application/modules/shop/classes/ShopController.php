<?php 
/**
  Shop Controller class file.
**/

class ShopController extends Controller {

    protected $template_name = null;
    protected $template_path = null;

    public function __construct()
    {
        parent::Controller();
   
        $this->template_name = 'default';
        $this->template_path = realpath(dirname(__FILE__).'/../templates/'.$this->template_name).'/';

        $this->template->assign('SHOP_THEME', media_url('/application/modules/shop/templates/'.$this->template_name).'/');
    }

    /**
     * Fetch teplate file and display it in main.tpl
     * 
     * @param string $name template file name
     * @param array $data template data
     * @access public
     */
    public function render($name, $data = array())
    {
        $this->template->add_array($data);
		$content = $this->template->fetch('file:'.$this->template_path.$name.'.tpl');

        $this->template->assign('shop_content', $content);
        $this->template->display('file:'.$this->template_path.'main.tpl');

        //$this->load->library('Profiler');
        //echo $this->profiler->run();
    }

    /**
     * Display 404 error page.
     * 
     * @access public
     */
    public function error404()
    {
        $this->render('error404',array(
            'error'=>ShopCore::t('Страница не найдена'),           
        ));
        exit;
    }
}
