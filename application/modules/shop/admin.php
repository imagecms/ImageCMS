<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Admin 
 * 
 * @uses Controller
 * @package Shop
 * @version $id$
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 * @license 
 */
class Admin extends Controller {

	public function __construct()
	{
	    parent::Controller();
	    cp_check_perm('module_admin');

        $adminController = $this->uri->segment(5);
        $adminClassName = 'ShopAdmin'.ucfirst($adminController);
        $adminMethod = $this->uri->segment(6);
        $adminClassFile = SHOP_DIR.'admin'.DS.$adminController.'.php'; 

        if (file_exists($adminClassFile))
        {
            if (!$adminMethod)
                $adminMethod='index';

            require $adminClassFile;

            $controller = new $adminClassName;
          
            $this->load->module('core');
            $args = $this->core->grab_variables(7);
       
            // Redirect all requests to the appropriate controller,
            // othewise we'll get 404.
            if (method_exists($controller, $adminMethod))
            {
                call_user_func_array(array($controller,$adminMethod), $args); 
                exit;
            }
        }
	}

    /**
     * Create and display ul list of shop categories.
     * 
     * @access public
     */
    public function ajaxCategoriesTree()
    {
        ob_start();
        $this->_walkArrayAdmin(ShopCore::app()->SCategoryTree->getTree(SCategoryTree::MODE_MULTI));
        $tree = ob_get_clean();
        
        if ($tree=='')
            echo '<a href="javascript:ajaxShop(\'categories/create\')">Создать категорию</a>';

        echo '<div class="rdTreeFirebug demotree">
        <ul id="desktop_tree">';
        echo $tree;
        echo '
        </ul>
        </div>
        <script type="text/javascript">
        var ShopCatsTree = new rdTree(\'desktop_tree\');
        ShopCatsTree.expandAll(); 
        </script>';
    }

    /**
     * Display categories ul list.
     * 
     * @param mixed $array categories tree
     * @access protected
     * @return void
     */
    protected function _walkArrayAdmin($array)
    {
		foreach($array as $key)
		{
			echo '<li><a href="#" onclick="ajaxShop(\'products/index/'.$key->getId().'\'); return false;">'.ShopCore::encode($key->getName()).'</a>';
			if(sizeof($key->getSubtree()))
			{
				echo '<ul>';
			    $this->_walkArrayAdmin($key->getSubtree());	
				echo '</ul>';
			}
			echo '</li>';
		} 
    }

    /**
     * Basic admin form generator.
     * TODO: delete from public release.
     * 
     * @param mixed $className 
     * @access public
     * @return void
     */
    public function gen($className)
    {
        $model = new $className;
        
        $methods = get_class_methods($model);
        $names = array();

        foreach($methods as $k=>$v)
        {
            if (substr($v, 0, 3) == 'get')
            {
                $v = substr($v, 3);  
                array_push($names,$v);
            }
            elseif(substr($v, 0, 3) == 'set')
            {
                break -1;
            }
        }

        if (!empty($names)) 
        {
            $formCode = '<form method="post" action="{$ADMIN_URL}"  style="width:100%">'."\n";
$labelsCode = "
\tpublic function attributeLabels()
\t{
\t\treturn array(\n";

            foreach ($names as $k=>$val)
            {
                if ($val==='Id')
                    continue;

$formCode .= '
    <div class="form_text">{echo $model->getLabel(\''.$val.'\')}:</div>
    <div class="form_input">
        <input type="text" name="'.$className.'['.$val.']" value="" class="textbox_long" />
    </div>
    <div class="form_overflow"></div>
'."\n";
            
$labelsCode.="\t\t\t'$val'=>ShopCore::t('$val'),\n";

            }

$formCode.='
    <div class="form_text"></div>
    <div class="form_input">
        <input type="submit" name="button" class="button_130" value="Создать" onclick="ajax_me(this.form);" />
    </div>
    <div class="form_overflow"></div>    
';
            $formCode.="\n".'{form_csrf()}'."\n".'</form>';

$labelsCode.="\t\t);\n\t}";

            echo '<pre>';
            echo htmlspecialchars($formCode);
            echo "\n\n-------------LABELS------------------\n\n";
            echo htmlspecialchars($labelsCode);
        }
    }
}

/* End of file admin.php */
