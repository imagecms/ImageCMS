<?php

/**
 * 
 *
 * @author kolia
 */
final class Premmerce extends MY_Controller {

    const EXCEPTION_ERROR = 1;
    const EXCEPTION_SUCCESS = 2;

    private $email;
    private $token;

    public function index() {
        try {



            if ($this->dx_auth->is_logged_in()) {
                throw new \Exception('Already logged in', self::EXCEPTION_SUCCESS);
            }

            if (!isset($_GET['email']) || !isset($_GET['token'])) {
                throw new \Exception('No params', self::EXCEPTION_ERROR);
            }


            $this->email = $_GET['email'];

            $this->token = $_GET['token'];
          
            //$this->checkReferer();
            $this->checkInputParams();

            $userId = $this->getUserId();

            $status = $this->dx_auth->_create_autologin($userId);

            if ($status == TRUE) {
                throw new \Exception('Succesfully logged in', self::EXCEPTION_SUCCESS);
            } else {
                throw new \Exception('Error', self::EXCEPTION_ERROR);
            }
        } catch (\Exception $ex) {

            // Please forgive me gods of code - I know that html in controller is bad. I'm sinner...

            $clr = $ex->getCode() == self::EXCEPTION_SUCCESS ? 'green' : 'red';
            $msg = $ex->getMessage();

            echo "<div style='color:{$clr}'>{$msg}</div>";
            echo "<script>setTimeout(function(){window.close();},1000);</script>";
        }
    }

    

    /**
     * Перевірка чи прийшов саме із premmerce.com та із свого аккаунту
     * @throws \Exception
     */
    private function checkReferer() {
        // @TODO треба буде зробити якусь нормальну перевірку
        if (!isset($_SERVER['HTTP_REFERER'])) {
            throw new \Exception('No referer', self::EXCEPTION_ERROR);
        }
        if (strpos($_SERVER['HTTP_REFERER'], 'premmerce') !== false) {
            throw new \Exception('Wrong referer', self::EXCEPTION_ERROR);
        }
    }

    /**
     * Перевірка чи співпадає емейл і токен
     * @throws \Exception
     */
    private function checkInputParams() {
        $encKey = \CI::$APP->config->item('encryption_key');

        // тута має використовуватись такий самий алгоритм створення токену 
        // як на біллінгу
        $token = md5($this->email . $encKey . 'lead me to the light');

        if ($token !== $this->token) {
            throw new \Exception('Invalid input data 1', self::EXCEPTION_ERROR);
        }
    }

    /**
     * Повертає ід користувача 
     * (логування йде за ід)
     * + перевірка чи він має роль адміна
     * @throws \Exception
     */
    private function getUserId() {

        $email = strip_tags($this->email);
        $email = htmlspecialchars($email);
        $email = mysql_real_escape_string($email);

        $result = $this->db
                ->select(array('id', 'role_id'))
                ->where('email', $email)
                ->limit(1)
                ->get('users');
               
        if (!$result) {
            throw new \Exception('Invalid input data 2', self::EXCEPTION_ERROR);
        }

        return $result->row()->id;
    }

}
