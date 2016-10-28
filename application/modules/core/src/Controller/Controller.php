<?php
/**
 * Created by PhpStorm.
 * User: cray
 * Date: 31.08.16
 * Time: 17:49
 */

namespace core\src\Controller;

use CI;
use core\src\CoreModel;

class Controller
{

    /**
     * @var CI
     */
    protected $ci;

    /**
     * @var CoreModel
     */
    protected $model;

    /**
     * Controller constructor.
     * @param CI $ci
     * @param CoreModel $frontModel
     */
    public function __construct(CI $ci, CoreModel $frontModel) {
        $this->ci = $ci;
        $this->model = $frontModel;
    }

}