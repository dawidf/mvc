<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 08.07.15
 * Time: 09:49
 */

class mainController
{
    public $request;
    public $view;
    public $layout;

    public $status;
    public $message;
    public $userStorage;

    public function __construct()
    {
        $this->request = new Request();
        $this->layout = new Layout();
        $this->view = new View();
        $this->userStorage = new UserStorage();

        $this->status = $this->request->getParam( 'status' );
        $this->message = $this->request->getParam('message');
        $this->getStatus($this->status, $this->message);

        var_dump($_SESSION);
        //if is logged

        if(!($this->request->getParam('action') == 'login') && !$this->userStorage->isAuthenticate())
        {
            $url = Url::getUrl('user', 'login');
            header("Location: {$url}");
        }

        $this->layout->flashMessage = FlashMessage::render();
        $this->layout->menu = '<a href="'.Url::getUrl( 'cars', 'list').'">Car List</a>';
        $this->layout->menu .= '<a href="'.Url::getUrl( 'marki', 'list').'">Marki List</a>';


    }

    public function getStatus($status, $message = '')
    {
        $this->layout->message = '';

        if(isset($status))
        {
            $message = $this->request->getParam('message');
            if($status == 'success')
            {
                $this->layout->message = '<div class="success">'.$message.'</div>';
            }
            elseif($status == 'error')
            {
                $this->layout->message = '<div class="error">'.$message.'</div>';
            }
        }
        else
        {
            $this->layout->status = '';
        }
    }
}

