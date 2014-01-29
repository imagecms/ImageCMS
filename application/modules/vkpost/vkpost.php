<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Work whis VK groups
 * @author Gula Andrij <a.gula@imagecms.net>
 * @version 1.0
 */
class Vkpost extends MY_Controller {

    protected $groupId;
    protected $appId;
    protected $secretKey;
    protected $accessToken;
    protected $accessSecret;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('vkpost');

        $this->groupId = ''; //$groupId;
        $this->appId = ''; //$appId;
        $this->secretKey = ''; //$secretKey;
        $this->accessToken = ''; //$accessToken;
        $this->accessSecret = ''; // $accessSecret;
    }

    public function index() {
        $this->wallPostMsg('Hello from ImageCMS');
    }

    public static function adminAutoload() {
        \CMSFactory\Events::create()->onAdminPageCreate()->setListener('pageCreate');
        \CMSFactory\Events::create()->onShopProductCreate()->setListener('productCreate');
    }

    public static function productCreate($data) {
        /* @var $ci MY_Controller */
        $ci = &get_instance();
        $ci->load->module('vkpost');
        /* @var $data SProducts */
        $photo = $data['model']->getFirstVariant()->getMainimage();
        if ($photo != '') {
            $attachments = $ci->vkpost->combineAttachments(
                    $ci->vkpost->createPhotoAttachment('./uploads/shop/products/origin/' . $photo), site_url('shop/product/' . $data['model']->getUrl())
            );
        }

        $ci->vkpost->wallPostAttachment($attachments, $data['model']->getName());
    }

    public static function pageCreate($data) {
        /* @var $ci MY_Controller */
        $ci = &get_instance();
        $ci->load->module('vkpost');
        $ci->vkpost->wallPostMsg(strip_tags($data['full_text']) . PHP_EOL . site_url($data['url']));
    }

    /**
     * Hack
     */
    public function getAccessData() {
        echo "<!doctype html><html><head><meta charset='utf-8'></head>
            <body><a href='http://api.vkontakte.ru/oauth/authorize?" .
        "client_id={$this->appId}&scope=offline,wall,groups,pages," .
        "photos,docs,audio,video,notes,stats,messages,notify,notifications,nohttps&amp;" .
        "redirect_uri=http://api.vkontakte.ru/blank.html&amp;response_type=code&amp;redirect_uri=https://oauth.vk.com/blank.html'
                target='_blank'>Получить CODE</a><br>Ссылка для получения токена:<br>
                <b>https://api.vkontakte.ru/oauth/access_token?client_id={$this->appId}" .
        "&amp;client_secret={$this->secretKey}&amp;code=CODE&amp;redirect_uri=https://oauth.vk.com/blank.html</b></body></html>";

        exit;
    }

    /**
     * @param string $method
     * @param mixed $parameters
     * @return mixed
     */
    public function callMethod($method, $parameters) {
        if (!$this->accessToken) {
            return false;
        }
        if (is_array($parameters)) {
            $parameters = http_build_query($parameters);
        }
        $queryString = "/method/$method?$parameters&access_token={$this->accessToken}";
        $querySig = md5($queryString . $this->accessSecret);
        return json_decode(file_get_contents(
                        "http://api.vk.com{$queryString}&sig=$querySig"
        ));
    }

    /**
     * @param string $message
     * @param bool $fromGroup
     * @param bool $signed
     * @return mixed
     */
    public function wallPostMsg($message, $fromGroup = true, $signed = false) {
        return $this->callMethod('wall.post', array(
                    'owner_id' => -1 * $this->groupId,
                    'message' => $message,
                    'from_group' => $fromGroup ? 1 : 0,
                    'signed' => $signed ? 1 : 0,
        ));
    }

    /**
     * @param string $attachment
     * @param null|string $message
     * @param bool $fromGroup
     * @param bool $signed
     * @return mixed
     */
    public function wallPostAttachment($attachment, $message = null, $fromGroup = true, $signed = false) {
        return $this->callMethod('wall.post', array(
                    'owner_id' => -1 * $this->groupId,
                    'attachment' => strval($attachment),
                    'message' => $message,
                    'from_group' => $fromGroup ? 1 : 0,
                    'signed' => $signed ? 1 : 0,
        ));
    }

    /**
     * @param string $file relative file path
     * @return mixed
     */
    public function createPhotoAttachment($file) {
        $result = $this->callMethod('photos.getWallUploadServer', array(
            'gid' => $this->groupId
        ));

        $ch = curl_init($result->response->upload_url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, array(
            'photo' => '@' . getcwd() . '/' . $file
        ));

        if (($upload = curl_exec($ch)) === false) {
            throw new Exception(curl_error($ch));
        }

        curl_close($ch);
        $upload = json_decode($upload);
        $result = $this->callMethod('photos.saveWallPhoto', array(
            'server' => $upload->server,
            'photo' => $upload->photo,
            'hash' => $upload->hash,
            'gid' => $this->groupId,
        ));

        return $result->response[0]->id;
    }

    public function combineAttachments() {
        $result = '';
        if (func_num_args() == 0)
            return '';
        foreach (func_get_args() as $arg) {
            $result .= strval($arg) . ',';
        }
        return substr($result, 0, strlen($result) - 1);
    }

    public function _install() {
        /** We recomend to use http://ellislab.com/codeigniter/user-guide/database/forge.html */
        /**
          $this->load->dbforge();

          $fields = array(
          'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
          'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
          'value' => array('type' => 'VARCHAR', 'constraint' => 100,)
          );

          $this->dbforge->add_key('id', TRUE);
          $this->dbforge->add_field($fields);
          $this->dbforge->create_table('mod_empty', TRUE);
         */
        /**
          $this->db->where('name', 'module_frame')
          ->update('components', array('autoload' => '1', 'enabled' => '1'));
         */
    }

    public function _deinstall() {
        /**
          $this->load->dbforge();
          $this->dbforge->drop_table('mod_empty');
         *
         */
    }

}

/* End of file sample_module.php */
