<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Image CMS
 * Module Sample
 */
class Sample_Module extends MY_Controller {

    /** Подготовим необходимые свойства для класса */
    private $key = FALSE;
    private $mailTo = FALSE;
    private $useEmailNotification = FALSE;

    public function __construct() {
        parent::__construct();
        $lang = new MY_Lang();
        $lang->load('sample_module');
        $this->load->module('core');

        /** Запускаем инициализацию переменых. Значения будут взяты з
         *  Базы Данных, и присвоены соответствующим переменным */
        $this->initSettings();
    }

    public function index() {
        $this->core->error_404();
    }

    /**
     * Метод относится к стандартным методам ImageCMS.
     * Будет вызван каждый раз при обращении к сайту.
     * Запускается при условии включении "Автозагрузка модуля-> Да" в панели
     * уплавнеия модулями.
     */
    public function autoload() {
        if ('TRUE' == $this->useEmailNotification)
//            \CMSFactory\Events::create()->setListener('handler', 'Sample_Module:__construct');
            \CMSFactory\Events::create()->setListener('handler', 'Commentsapi:newPost');
    }

    public function changeStatus($commentId, $status, $key) {
        /** Проверим входные данные */
        ($commentId AND in_array($status, array(0, 1, 2)) AND $key == $this->key) OR $this->core->error_404();

        /** Обновим статус */
        $this->db
                ->where('id', intval($commentId))
                ->set('status', intval($status))
                ->update('comments');

        $comment = $this->db->where('id', $commentId)->get('comments')->row();
        if ($comment->module == 'core')
        /** Используем помощник get_page($id) который аргументом принимает ID страницы.
         *  Помощник включен по умолчанию. Больше о функция помощника
         *  читайте здесь http://ellislab.com/codeigniter/user-guide/general/helpers.html */
            $comment->source = get_page($comment->item_id);


        /** Сообщаем пользователю что статус обновлён успешно */
        \CMSFactory\assetManager::create()
                ->setData('comment', $comment)
                ->render('successful');
    }

    /**
     * Метод обработчик
     * @param type $commentId <p>ID коментария который был только что создан.</p>
     */
    public static function handler(array $param) {
        $instance = new Sample_Module();
        $instance->composeAndSendEmail($param);
    }

    private function composeAndSendEmail($arg) {
        $comment = $this->db->where('id', $arg['commentId'])->get('comments')->row();
        if ($comment->module == 'core')
        /** Используем помощник get_page($id) который аргументом принимает ID страницы.
         *  Помощник включен по умолчанию. Больше о функция помощника
         *  читайте здесь http://ellislab.com/codeigniter/user-guide/general/helpers.html */
            $comment->source = get_page($comment->item_id);

        /** Теперь переменная содержит HTML тело нашего письма */
        $message = \CMSFactory\assetManager::create()->setData(array('comment' => $comment, 'key' => $this->key))->fetchTemplate('emailPattern');

        /** Настроявием отправку Email http://ellislab.com/codeigniter/user-guide/libraries/email.html */
        $this->load->library('email');
        $this->email->initialize(array('mailtype' => 'html'));
        $this->email->from('robot@sitename.com', 'Comments Robot');
        $this->email->to($this->mailTo);
        $this->email->subject('New Comment received');
        $this->email->message($message);
        $this->email->send();
//        echo $this->email->print_debugger();
    }

    private function initSettings() {
        $request = $this->db->get('mod_sample_settings');
        if ($request) {
            $DBSettings = $request->result_array();
            foreach ($DBSettings as $record)
                $this->$record['name'] = $record['value'];
        }
    }

    /**
     * Метод относиться  к стандартным методам ImageCMS.
     * Будет вызван при установке модуля пользователем
     */
    public function _install() {
        /** Подключаем класс Database Forge содержащий функции,
         *  которые помогут вам управлять базой данных.
         *  http://ellislab.com/codeigniter/user-guide/database/forge.html */
        $this->load->dbforge();

        /** Создаем массив полей и их атрибутов для БД */
        $fields = array(
            'id' => array('type' => 'INT', 'constraint' => 11, 'auto_increment' => TRUE,),
            'name' => array('type' => 'VARCHAR', 'constraint' => 50,),
            'value' => array('type' => 'VARCHAR', 'constraint' => 100,));

        /** Указываем на поле, которое будет с ключом Primary */
        $this->dbforge->add_key('id', TRUE);
        /** Добавим поля в таблицу */
        $this->dbforge->add_field($fields);
        /** Запускаем запрос к базе данных на создание таблицы */
        $this->dbforge->create_table('mod_sample_settings', TRUE);

        /** Заполним поля таблицы временными данными */
        $data = array(
            array('name' => 'mailTo', 'value' => 'admin@site.com'),
            array('name' => 'useEmailNotification', 'value' => 'TRUE'),
            array('name' => 'key', 'value' => 'UUUsssTTTeee'));
        /** ...и добавим их в Базу Данных */
        $this->db->insert_batch('mod_sample_settings', $data);


        /** Обновим метаданные модуля, включим автозагрузку модуля и доступ по URL */
        $this->db->where('name', 'sample_module')
                ->update('components', array('autoload' => '1', 'enabled' => '1'));
    }

    /**
     * Метод относиться  к стандартным методам ImageCMS.
     * Будет вызван при удалении модуля пользователем
     */
    public function _deinstall() {
        $this->load->dbforge();
        $this->dbforge->drop_table('mod_sample_settings');
    }

}

/* End of file sample_module.php */
