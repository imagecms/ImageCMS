<?php

class Found_less_expensive_model extends CI_Model
{

    public function __construct() {

        parent::__construct();
    }

    /**
     * Get
     * @param integer $row_count
     * @param integer $offset
     * @param integer $status
     * @return array
     */
    public function allByStatus($row_count, $offset, $status) {

        $this->db->order_by('date', 'desc');
        if ($row_count > 0 AND $offset >= 0) {
            $query = $this->db->where_in('status', $status)->get('mod_found_less_expensive', $row_count, $offset)->result_array();
        } else {
            $query = $this->db->where_in('status', $status)->get('mod_found_less_expensive')->result_array();
        }

        return $query;
    }

    /**
     * Get count of all messages about found less expensive
     * @param array $status
     * @return integer
     */
    public function getCountAll($status) {

        $res = $this->db->where_in('status', $status)->get('mod_found_less_expensive')->result_array();
        return count($res);
    }

    /**
     * @return array
     */
    public function getEmailPatterns() {

        $data = [
                 'id'                   => 10,
                 'name'                 => 'Found_less_expensive',
                 'type'                 => 'HTML',
                 'user_message_active'  => 1,
                 'admin_message_active' => 1,
                ];

        return $data;

    }

    /**
     * @return  array $data
     */
    public function getEmailPatternsI18n() {

        $data = [
                 'id'            => 10,
                 'locale'        => 'ru',
                 'user_message'  => '<p style=\"font-family: arial; font-size: 13px; margin-top: 10px;\">Здравствуйте, $userName$!</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Вы отправили заявку, что нашли товар дешевле  , по товару $productUrl </p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Ваша заявка будет рассмотрена и обработана..</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Спасибо что пользуетесь нашим сервисом.</p>',
                 'admin_message' => '<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Пользователь <span>$userName$ создал заявку на "Нашли дешевле" </p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">На товаре  $productUrl</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Ссылка предоставляемая пользователем  $userLink</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Комментарий пользователя $userMessage </p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Email пользователя $userEmail, Телефон пользователя $userPhone</p>\n<p style="font-family: arial; font-size: 13px; margin-top: 10px;">Дата $date</p>',
                 'description'   => '<p><span>Уведомление о модуле нашли дешевле</span></p>',
                 'variables'     => 'a:7:{s:10:"$userName$";s:31:"Имя пользователя";s:11:"$userEmail$";s:30:"Email пользователя";s:11:"$userPhone$";s:39:"Телефон пользователя";s:10:"$userLink$";s:70:"Ссылка предоставляемая пользователем";s:13:"$userMessage$";s:22:"Комментарий";s:6:"$date$";s:8:"Дата";s:12:"$productUrl$";s:33:"Страница продукта";}',
                ];

        return $data;
    }

}