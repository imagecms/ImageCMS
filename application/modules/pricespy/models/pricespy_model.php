<?php

/**
 * @property DX_Auth dx_auth
 */
class Pricespy_model extends CI_Model
{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Deleting user spys products from list
     * @param int $ids
     * @return object
     */
    public function delSpysbyIds($ids) {
        $this->db->where_in('productId', $ids);
        return $this->db->delete('mod_price_spy');
    }

    /**
     * Deleting user spys products from list
     * @param string $hash
     */
    public function delSpyByHash($hash) {
        return $this->db->delete('mod_price_spy', ['hash' => $hash]);
    }

    /**
     * @return array
     */
    public function getEmailPattern() {

        $data = [
                 'id'                   => 11,
                 'name'                 => 'pricespy',
                 'type'                 => 'HTML',
                 'user_message_active'  => 0,
                 'admin_message_active' => 0,
                ];

        return $data;
    }

    /**
     * @return array
     */
    public function getEmailPatternI18n() {

        $data = [

                 'id'           => 11,
                 'locale'       => 'ru',
                 'theme'        => 'Отслеживание Цен',
                 'user_message' => '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Здравствуйте, $userName$!</p>\n<pre class="sf-dump" data-indent-pad="  "><span class="sf-dump-str" title="359 characters">Цена на $</span><span>productName</span><span class="sf-dump-str" title="359 characters">$, что вы смотрели на сайте $siteUrl$ , изменилась.<br /><br /><a href="$linkModule$" target="_blank">Просмотр списка отслеживаемых товаров</a><br /></span></pre>\n<p style="font-family: arial; font-size: 13px; margin-top: 20px;"><a href="$unlinkSpy$" target="_blank">Отписаться от слежения за изменением цен</a></p>',
                 'variables'    => 'a:6:{s:6:"$hash$";s:13:"Хеш код";s:13:"$productName$";s:23:"Имя продукта";s:10:"$userName$";s:31:"Имя пользователя";s:9:"$siteUrl$";s:21:"Адрес сайта";s:12:"$linkModule$";s:30:"Ссылка на модуль";s:11:"$unlinkSpy$";s:36:"Отписатся от товара";}',
                ];

        return $data;
    }

    /**
     *
     * @param integer $varId
     * @return int
     */
    public function getProductById($varId) {
        return $this->db
            ->where('id', $varId)
            ->get('shop_product_variants')
            ->row();
    }

    /**
     * Insert new spy for user
     * @param int $id
     * @param int $varId
     * @param double $productPrice
     */
    public function setSpy($id, $varId, $productPrice) {
        return $this->db
            ->set('userId', $this->dx_auth->get_user_id())
            ->set('productId', $id)
            ->set('productVariantId', $varId)
            ->set('productPrice', $productPrice)
            ->set('oldProductPrice', $productPrice)
            ->set('hash', random_string('unique'))
            ->insert('mod_price_spy');
    }

}