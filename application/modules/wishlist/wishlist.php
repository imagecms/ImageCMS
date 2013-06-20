<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Wishlist
 * @property wishlist_model $wishlist_model
 */
class Wishlist extends MY_Controller {

    public $settings = array();
    public $dataModel;
    public $errors = array();
    public $userWishProducts;
    

    public function __construct() {
        parent::__construct();
        
        $this->writeCookies();
        $this->load->model('wishlist_model');
        $this->load->helper(array('form', 'url'));
        $this->settings = $this->wishlist_model->getSettings();
        $this->userWishProducts = $this->wishlist_model->getUserWishProducts();
    }
      private function writeCookies() {                  
        $this->load->helper('cookie');
        if (!strstr( $this->uri->uri_string(), 'wishlist')) {
            $cookie = array(
                'name' => 'url2',
                'value' => $this->uri->uri_string(),
                'expire' => '15000',
                'prefix' => ''
            );
            $this->input->set_cookie($cookie);
        }
    }

    private function checkPerm() {
        $permAllow = TRUE;
        if (!$this->dx_auth->is_logged_in())
            $permAllow = FALSE;

        return $permAllow;
    }

    public function index() {
//        if (!$this->checkPerm())
//            $this->core->error_404();

        $this->renderUserWL();
    }
    public function all() {
       $users = $this->getAllUsers();
       $lists = '';
       foreach($users as $user){
           $lists []= array(
               'user' => $user,
               'lists' => $this->getWLsByUserId($user['id'])
               );
           
       }
        
          \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('lists', $lists)
                ->render('all');
    }
    public function getAllUsers(){
        return $this->db->get('mod_wish_list_users')->result_array();
    }
     public function getWLsByUserId($user_id){
         return $all_lists = $this->db
                  ->where('user_id',$user_id)
                ->get('mod_wish_list')->result_array();
    }
    

    /**
     *
     * @param type $title
     * @param type $access
     * @param type $description
     * @param type $user_id
     * @param type $user_image
     * @param type $user_birthday
     */
    public function createWL($title, $access, $description, $user_id, $user_image, $user_birthday) {

        $this->db->set('title', $title);
        $this->db->set('access', $access);
        $this->db->set('description', $description);
        $this->db->set('user_id', $user_id);
        $this->db->set('user_image', $user_image);
        $this->db->set('user_birthday', $user_birthday);
        $this->db->insert('mod_wish_list');

        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    /**
     * Edit WL
     */
    public function editWL() {

        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    /**
     * delete full WL
     * @return type
     */
    public function deleteWL() {
        $forReturn = TRUE;

        $forReturn = $this->wishlist_model->delWishListById($this->input->post(WLID));

        if ($forReturn) {
            $forReturn = $this->wishlist_model->delWishListProductsByWLId($this->input->post(WLID));

            if (!$forReturn)
                $this->errors[] = 'Невозможно удалить товары из списка';
        }
        else
            $this->errors[] = 'Невозможно удалить Список Желания';

        return $forReturn;
    }

 /**
  * add item to wish list
  *
  * @return boolean
  */
    public function addItem($varId) {
        $listId = $this->input->post('wishlist');
        $listName = $this->input->post('wishListName');

        if(!$listId){
            $listId = "";
        }

        if($listName == 'Создать список'){
            $listName= "";
        }

        if( strlen($listName)>$this->settings['maxListName']){
            $listName = substr($listName, 0, (int)$this->settings['maxListName']);
            $this->errors[] = 'Поле имя будет изменено до длини ' . $this->settings['maxListName'] . ' символов </br>';
        }
        
        $this->wishlist_model->addItem($varId, $listId, $listName);

        if(count($this->errors)){
            return false;
        } else {
            return true;
        }
    }

    public function deleteItem() {
        $forReturn = $this->db->delete('modв_wish_list_products', array(
            'variant_id' => $this->input->post(varID),
            'wish_list_id' => $this->input->post(WLID),
        ));
        if (!$forReturn)
            $this->errors[] = 'Невозможно удалить товар из Списка Желания';

        return $forReturn;
    }

    public function editItem($id, $varId) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    public function moveItem($id, $varId) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    function editWLName($id, $newName) {
        if (true)
            echo json_encode(array(
                'answer' => 'sucesfull',
            ));
        else
            echo json_encode(array(
                'answer' => 'error',
            ));
    }

    public function getWLbyHash($hash) {

    }

    public function renderUserWL($userId, $type = '') {
        $wishlists = $this->db
                ->where('mod_wish_list.user_id', 49)
                ->join('mod_wish_list_products', 'mod_wish_list_products.wish_list_id=mod_wish_list.id')
                ->join('shop_product_variants', 'shop_product_variants.id=mod_wish_list_products.variant_id')
                ->join('shop_product_variants_i18n', 'shop_product_variants_i18n.id=shop_product_variants.id')
                ->join('shop_products', 'shop_products.id=shop_product_variants.product_id')
                ->join('shop_products_i18n', 'shop_products_i18n.id=shop_products.id')
                ->get('mod_wish_list')
                ->result_array();
        $w = array();
        foreach ($wishlists as $wishlist)
            $w[$wishlist[title]][] = $wishlist;

//        var_dump($w);
        \CMSFactory\assetManager::create()
                ->registerScript('wishlist')
                ->registerStyle('style')
                ->setData('wishlists', $w)
                ->render('wishlist');
    }

    public function renderWLByHash($hash) {

    }

    /**
     * Render Wish List button
     * @param type $varId
     */
    public function renderWLButton($varId) {
        if (!in_array($varId, $this->userWishProducts))
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', 'Добавить в Список Желания')
                    ->setData('class', 'btn')
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->render('button', true);
        else
            \CMSFactory\assetManager::create()
                    ->registerScript('wishlist')
                    ->setData('data', $data)
                    ->setData('varId', $varId)
                    ->setData('value', 'Уже в Списке Желания')
                    ->setData('max_lists_count', $this->settings['maxListsCount'])
                    ->setData('class', 'btn inWL')
                    ->render('button', true);
    }

    /**
     *
     * @param type $id array()
     */
    public function deleteItemByIds($id) {
        if (!$id)
            return;
    }

    public function autoload() {

    }

    public static function adminAutoload() {
        parent::adminAutoload();
    }

    public function _install() {

        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '254',
                'null' => FALSE
            ),
            'access' => array(
                'type' => 'ENUM',
                'constraint' => "'public','private','shared'",
                'default' => "shared"
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'user_id' => array(
                'type' => 'INT',
                'null' => FALSE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_wish_list');

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'wish_list_id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'variant_id' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'comment' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_wish_list_products');
        
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'auto_increment' => TRUE
            ),
           'user_image' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'user_birthday' => array(
                'type' => 'INT',
                'null' => FALSE
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('mod_wish_list_users');
        

        $this->db
                ->where('identif', 'wishlist')
                ->update('components', array(
                    'settings' => '',
                    'enabled' => 1,
                    'autoload' => 1,
        ));
    }

    public function _deinstall() {
        $this->load->dbforge();
        ($this->dx_auth->is_admin()) OR exit;
        $this->dbforge->drop_table('mod_wish_list_products');
        $this->dbforge->drop_table('mod_wish_list');
    }

    public function renderPopup($varId) {
        $wish_lists = $this->wishlist_model->getWishLists();
        $back_linck = $_SERVER['HTTP_REFERER'];

        $data = array('wish_lists' => $wish_lists, 'backlinck' => $back_linck );

        return $popup = \CMSFactory\assetManager::create()
                ->registerStyle('style')
                ->setData('value', 'Добавить в Список Желания')
                ->setData('class', 'btn')
                ->setData('varId', $varId)
                ->setData($data)
                ->setData('max_lists_count', $this->settings['maxListsCount'])
                ->render('wishPopup');
        return json_encode(array('popup' => $popup));
    }

    function do_upload() {
        $upload_dir = 'uploads/'; // Directory for file storing
        $preview_url = '/uploads/';
        $filename = '';
        $result = 'ERROR';
        $result_msg = '';
        $allowed_image = array('image/gif', 'image/jpeg', 'image/jpg', 'image/pjpeg', 'image/png');
        define('PICTURE_SIZE_ALLOWED', 2242880); // bytes

        if (isset($_FILES['picture'])) {  // file was send from browser
            if ($_FILES['picture']['error'] == UPLOAD_ERR_OK) {  // no error
                if (in_array($_FILES['picture']['type'], $allowed_image)) {
                    if (filesize($_FILES['picture']['tmp_name']) <= PICTURE_SIZE_ALLOWED) { // bytes
                        $filename = $_FILES['picture']['name'];
                        move_uploaded_file($_FILES['picture']['tmp_name'], $upload_dir . $filename);

//phpclamav clamscan for scanning viruses
//passthru('clamscan -d /var/lib/clamav --no-summary '.$upload_dir.$filename, $virus_msg); //scan virus
                        $virus_msg = 'OK'; //assume clamav returing OK.
                        if ($virus_msg != 'OK') {
                            unlink($upload_dir . $filename);
                            $result_msg = $filename . " : " . FILE_VIRUS_AFFECTED;
                            $result_msg = '<font color=red>' . $result_msg . '</font>';
                            $filename = '';
                        } else {
// main action -- move uploaded file to $upload_dir
                            $result = 'OK';
                        }
                    } else {
                        $filesize = filesize($_FILES['picture']['tmp_name']); // or $_FILES['picture']['size']
                        $filetype = $_FILES['picture']['type'];
                        $result_msg = PICTURE_SIZE;
                    }
                } else {
                    $result_msg = SELECT_IMAGE;
                }
            } elseif ($_FILES['picture']['error'] == UPLOAD_ERR_INI_SIZE)
                $result_msg = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            else
                $result_msg = 'Unknown error';
        }

// This is a PHP code outputing Javascript code.
        echo '<script language="JavaScript" type="text/javascript">' . "\n";
        echo 'var parDoc = window.parent.document;';
        if ($result == 'OK') {
            echo 'parDoc.getElementById("picture_error").innerHTML =  "";';
        } else {
            echo "parDoc.getElementById('picture_error').innerHTML = '" . $result_msg . "';";
        }

        if ($filename != '') {
            echo "parDoc.getElementById('picture_preview').innerHTML = '<img src=\'$preview_url$filename\' id=\'preview_picture_tag\' heigh=\'300\' width=\'300\' name=\'preview_picture_tag\' />';";
        }

        echo "\n" . '</script>';
        exit(); // do not go futher
    }

}

/* End of file wishlist.php */
