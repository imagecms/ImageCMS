<?php
require_once 'PHPUnit/Extensions/SeleniumTestCase.php';

class AdminPanelTest extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser('*firefox');
        $this->setBrowserUrl('http://imagecms/');
    }

    public function testTitle()
    {
        $this->open('/admin');
        $this->assertTitle('Панель Управления - Image CMS');
    }

    public function testFailLogin()
    {
        $this->open('/admin');
        $this->type('login', 'adminko');
        $this->type('password', 'admin');
        $this->isTextPresent('Пользователя с таким логином и паролем не найден');
    }

    public function testLogin()
    {
        $this->open('/admin/login');
        $this->type('login', 'admin');
        $this->type('password', 'admin');
        $this->click("//input[@type='submit' and @value='Отправить']");
        sleep(1);
        $this->assertTrue($this->isTextPresent("Добро пожаловать"));
    }
}
