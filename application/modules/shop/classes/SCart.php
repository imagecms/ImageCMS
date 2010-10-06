<?php
/**
 * SCart class file
 * 
 * @package Shop
 * @copyright 2010 Siteimage
 * @author <dev@imagecms.net>
 */

class SCart {

    protected $model; // SProducts model.
    public $quantityMax = 10; // TODO: load maxRange value from database setting. 
    public $sessKey = 'ShopCartData'; // Session key to store cart items list.

    public function __construct()
    {

    }

    /**
     * Add product to cart.
     * 
     * @param array $data Product Data
     *
     * array(SProducts model,variantId,quantity)
     *
     * @access public
     * @return bool
     */
    public function add($data = array())
    {
        $data = (object) $data;

        if ($data->model instanceof SProducts)
        {    
            // Set price. If user choosed variant, price will be change to variant price.
            $data->price = $data->model->getPrice();

            // Check if variant exists
            if ($data->variantId > 0)
            {
                $variant = SProductVariantsQuery::create()
                    ->filterByProductId($data->model->getId())
                    ->findPk($data->variantId);

                if ($variant)
                {
                    $data->variantId = $variant->getId();
                    // Change price to variant.
                    $data->price = $variant->getPrice();
                }
            }
            else
            {
                $data->variantId = 0;
            }

            $itemData = array(
                'productId'=>$data->model->getId(),
                'variantId'=>$data->variantId,
                'quantity'=>$data->quantity,
                'price'=>$data->price,
            );

            $this->_addToCart($itemData);
        }
        else
            return false;
    }

    /**
     * Add product to session data.
     * 
     * @param array $data
     * @access protected
     * @return bool always returns true
     */
    protected function _addToCart($data)
    {
        $sessionData = $this->getData();
        $key = $data['productId'] . '_' . $data['variantId'];

        if ($data['quantity'] < 1)
            $data['quantity'] = 1; 

        if (array_key_exists($key, $sessionData))
        {
            $data['quantity'] = $sessionData[$key]['quantity'] + 1;

            //Check quantity
            if ($sessionData[$key]['quantity'] >= $this->quantityMax)
                $data['quantity'] = $this->quantityMax;
        }
 
        if ($data['variantId'] > 0)
        {
            $variant = SProductVariantsQuery::create()
                ->filterByProductId($data['productId'])
                ->findPk($data['variantId']);

            if ($variant)
            {
                $data['variantName'] = ShopCore::encode($variant->getName());
            }
            else
            {
                $data['variantName'] = false;
            }   
        }

        $sessionData[$key] = $data;
        ShopCore::$ci->session->set_userdata($this->sessKey, $sessionData);

        return true;
    }

    /**
     * Remove all items.
     * 
     * @access public
     * @return void
     */
    public function removeAll()
    {
        ShopCore::$ci->session->set_userdata($this->sessKey, false); 
    }

    public function removeOne($key)
    {
        $data = $this->getData();

        if (isset($data[$key]))
            unset($data[$key]);

        //$this->setData(array_values($data));
        $this->setData($data);

        return true;
    }

    /**
     * Get total items count.
     * 
     * @access public
     * @return integer
     */
    public function totalItems()
    {
        $total = 0;
        $data = $this->getData();
        
        foreach ($data as $item)
            $total += $item['quantity'];

        return $total;
    }

    /**
     * Get total price.
     * 
     * @access public
     * @return float
     */
    public function totalPrice()
    {
        $data = $this->getData();
        $result = 0;

        if (sizeof($data) > 0)
        {
            foreach ($data as $item)
            {
                $result += $item['price'] * $item['quantity'];
            }
        }

        return money_format('%i',$result);
    }

    /**
     * Recount items quantity from post.
     * 
     * @access public
     * @return void
     */
    public function recount()
    {
        $newData = array();
        $data = $this->getData();

        $key = 0;
        foreach ($data as $key=>$item)
        {
            if (isset($_POST['products'][$key]) && $_POST['products'][$key] > 0)
                $item['quantity'] = (int) $_POST['products'][$key];
            else
                $item['quantity'] = 1;

            $newData[$key] = $item;
            $key++;
        }

        $this->setData($newData);
    }

    /**
     * Get session data
     * 
     * @access public
     * @return array
     */
    public function getData()
    {
        $data = ShopCore::$ci->session->userdata($this->sessKey);

        if ($data === false)
            return array();
        else
            return $data;
    }

    protected function setData(array $data)
    {
        ShopCore::$ci->session->set_userdata($this->sessKey, $data);  
    }

    /**
     * Load products from $this->getData ids array.
     * 
     * @access public
     * @return void
     */
    public function loadProducts()
    {
        $data = ShopCore::$ci->session->userdata($this->sessKey);

        if ($data === false)
            return array();
        else
        {
            $newData = array();
            $newCollection = array();
            $ids = array_map("array_shift", $data);

            if (sizeof($ids) > 0)
            {
                // Load products
                $collection = SProductsQuery::create()
                   ->findPks(array_unique($ids));
            }
            else
                return false;
            
            for ($i=0;$i<sizeof($collection);$i++)
            {
                $newCollection[$collection[$i]->getId()] = $collection[$i];
            }
            
            foreach ($data as $key=>$item)
            {
                if ($newCollection[$item['productId']] !== null)
                {
                    $item['model'] = $newCollection[$item['productId']];
                    $item['totalAmount'] = money_format('%i',$item['price'] * $item['quantity']);
                    $newData[$key] = $item;
                }
            }

            return $newData;
        }
    }
}
