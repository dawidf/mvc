<?php

class UserController extends mainController
{
    public function loginAction()
    {
        if($this->userStorage->isAuthenticate())
        {
            $helper = new Helper();
            $helper->redirectAfterFormSuccess('cars', 'list');
        }

        if($_POST)
        {
            $User = new User();
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $success = $User->auth($username, $password);

            if(!$success)
            {
                $helper = new Helper();
                $helper->redirectAfterFormSuccess('user', 'login', 'error', 'Zły login lub hasło');
            }
            else
            {
                $helper = new Helper();
                $helper->redirectAfterFormSuccess('cars', 'list', 'success', 'Poprawnie zalogowano');
            }
        }
        $this->view->display('login');
    }

    public function logoutAction()
    {
        return $this->userStorage->logout();
    }

    public function editAction()
    {
        $User = new User();
        $id = $this->request->getParam('id');
        if($_POST)
        {
            $success = $User->updateUser($this->request->getPost());


            if($success)
            {
                $helper = new Helper();
                $helper->redirectAfterFormSuccess('user', 'edit', 'success', 'Poprawnie Zedytowano', $id);
            }
        }
        $this->view->user = $User->getUser($id);
        $this->view->display('user-edit');


    }
}