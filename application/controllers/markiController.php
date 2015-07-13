<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 08.07.15
 * Time: 11:17
 */

class MarkiController extends mainController
{

    public function listAction()
    {

        $Marki = new Marki();
        $this->view->marki = $Marki->getmarki();
        $this->view->display('marki-index');
    }

    public function addmarkeAction()
    {
        if($_POST)
        {
            $Marki = new Marki();
            $markName = $this->request->getPost('markName');

            $Marki->addMarke($markName);

            $helper = new Helper();
            $helper->redirectAfterFormSuccess('marki', 'addMarke', 'success', 'Poprawnie Dodano');
        }

        $this->view->display('add-marke');

    }
    public function deleteMarkeAction()
    {
        $Marki = new Marki();
        $id = $this->request->getParam('id');

        $Marki->deleteMarke($id);

        $helper = new Helper();
        $helper->redirectAfterFormSuccess('marki', 'list', 'success', 'Poprawnie Usunięto');
    }

    public function editMarkeAction()
    {
        echo '<pre>';
        var_dump($this->request->getPost());
        var_dump($this->request->getParam());
        $Marki = new Marki();
        if($_POST)
        {
            $params = $this->request->getPost();
            $Marki->updateMarkeAction($params);

            $helper = new Helper();
            $id = $this->request->getParam('id');
            $helper->redirectAfterFormSuccess('marki', 'editMarke', 'success', 'Poprawnie Zedytowano', $id);
        }


        $this->view->marka = $Marki->editMarkeAction($this->request->getParam('id'));
        $this->view->display('edit-marke');



    }
}