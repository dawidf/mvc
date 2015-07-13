<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 07.07.15
 * Time: 16:35
 */

class indexController extends mainController{
    public function indexAction()
    {

        $this->view->test = 123;
        $this->view->display( 'index' );
    }

    public function listAction()
    {
        echo 'listAction';
    }
}