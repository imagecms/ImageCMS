<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cart Controller
 * 
 * @uses ShopController
 * @package Shop
 * @version 0.1
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net> 
 */
class Cart extends ShopController {

    public $maxRange = 10; // Max number of quantity.

	public function __construct()
	{
	    parent::__construct();
        $this->load->library('Form_validation');
        // TODO: load maxRange value from database setting.
	}

    /**
     * Display cart page.
     * 
     * @access public
     */
	public function index()
	{
        $this->load->helper('Form');
        $this->core->set_meta_tags(ShopCore::t('Корзина'));

        if ($_POST['makeOrder'] == 1)
        {
            $this->_makeOrder();
        }

        if ($_POST['recount'] == 1)
        {
            ShopCore::app()->SCart->recount();
            redirect('shop/cart', 'refresh');
        }

        ShopCore::app()->SCart->totalItems();

        $ranges = range(1,$this->maxRange); 

        $this->render('cart', array(
            'items'=>ShopCore::app()->SCart->loadProducts(),
            'deliveryMethods'=>SDeliveryMethodsQuery::create()->enabled()->orderByName()->find(),
            'ranges'=>array_combine($ranges,$ranges),
        ));
    }

    /**
     * Add product to cart from POST data.
     * 
     * @access public
     */
    public function add()
    {
        // Search for product and its variant
        $model = SProductsQuery::create()
            ->findPk((int) $_POST['productId']);

        if ($model !== null)
        {
            ShopCore::app()->SCart->add(array(
                'model'=>$model,
                'variantId'=>(int) $_POST['variantId'],
                'quantity'=>(int)$_POST['quantity'],
            ));
        }

        $this->_redirectBack();
    }

    public function delete()
    {
        ShopCore::app()->SCart->removeOne($this->uri->segment($this->uri->total_segments()));
        $this->redirectToCart();
    }

    protected function _makeOrder()
    {
        // Check if delivery method exists.
        $deliveryMethod = SDeliveryMethodsQuery::create()
            ->findPk((int) $_POST['deliveryMethodId']);

        if ($deliveryMethod === null)
        {
            $deliveryMethod = 0;
            $deliveryPrice = 0;
        }
        else
        {
            $deliveryPrice = $deliveryMethod->getPrice();
        }

        $order = new SOrders;

        $order->setKey(self::createCode());
        $order->setDeliveryMethod($deliveryMethod);
        $order->setDeliveryPrice($deliveryPrice);
        $order->setStatus(0);
        $order->setUserFullName($_POST['userInfo']['fullName']);
        $order->setUserEmail($_POST['userInfo']['email']);
        $order->setUserPhone($_POST['userInfo']['phone']);
        $order->setUserDeliverTo($_POST['userInfo']['deliverTo']);
        $order->setUserComment($_POST['userInfo']['commentText']);
        $order->setDateCreated(time());
        $order->setDateUpdated(time());
        $order->setUserIp($this->input->ip_address());

        // Add products;
        foreach (ShopCore::app()->SCart->loadProducts() as $cartItem)
        {
            if ($cartItem['model'] instanceof SProducts)
            {
                $orderedItem = new SOrderProducts;
                $orderedItem->fromArray(array(
                    'ProductId'=>$cartItem['productId'],
                    'VariantId'=>$cartItem['variantId'],
                    'ProductName'=>$cartItem['model']->getName(),
                    'VariantName'=>$cartItem['variantName'],
                    'Quantity'=>$cartItem['quantity'],
                    'Price'=>$cartItem['price'],
                ));

                $order->addSOrderProducts($orderedItem);
            }
        }

        $order->save();
        // Get products and insert in db.
        //$products = ShopCore::app()->SCart->loadProducts();
        // Redirect to order view page.
        // Display errors.
    }

    /**
     * Create random code.
     * 
     * @param int $charsCount 
     * @param int $digitsCount 
     * @static
     * @access public
     * @return string
     */
    public static function createCode($charsCount=3,$digitsCount=7)
    {
        $chars = array('q','w','e','r','t','y','u','i','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m');
        
        if ($charsCount > sizeof($chars))
            $charsCount = sizeof($chars); 
        
        $result = array();
        if ($charsCount > 0)
        {
            $randCharsKeys = array_rand($chars, $charsCount);

            foreach($randCharsKeys as $key=>$val)
                array_push($result, $chars[$val]);
        }

        for($i=0;$i<$digitsCount;$i++)
            array_push($result, rand(0,9));

        shuffle($result);
       
        $result =  implode('', $result); 

        if (sizeof(SOrdersQuery::create()->filterByKey($result)->select(array('Key'))->limit(1)->find()) > 0)
            self::createCode($charsCount,$digitsCount);

        return $result;
    }

    protected function _validateUserInfo()
    {
        return true;
        /*
		$this->form_validation->set_rules('userInfo[fullName]', '', '');
		$this->form_validation->set_rules('userInfo[email]', '', '');
		$this->form_validation->set_rules('userInfo[phone]', '', '');
		$this->form_validation->set_rules('userInfo[deliverTo]', '', '');
		$this->form_validation->set_rules('userInfo[commentText]', '', '');
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
		}
		else
		{
			$this->load->view('formsuccess');
		}
        */
    }

    public function clear()
    {
        ShopCore::app()->SCart->removeAll();
        $this->redirectToCart();
    }
    
    protected function _redirectBack()
    {
        redirect($_SERVER['HTTP_REFERER']);
        exit;
    }

    protected function redirectToCart()
    {
        redirect(shop_url('cart'));
    }
}

/* End of file cart.php */
