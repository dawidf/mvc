<?php

class CarsController extends mainController
{

    public function listAction()
    {

        $config = Config::getInstance();
        $config = $config->getConfig();

        $Cars = new Cars();

        $page = $this->request->getParam( 'page', 1 );
        $limit = 10;
        $from = ( $page - 1 ) * $limit;

        $this->view->pagerConfig = array
        (
            'url' => Url::getUrl( 'cars', 'list', array
            (
                'page' => 'key_page'
            )),
            'count' => $Cars->countCars(),
            'pack' => $limit,
            'page' => $page
        );




        $this->view->data = $Cars->getCars($from, $limit);

        $this->view->dirImgMin = $config['PUBLIC_IMG_MIN'];
        $this->view->display( 'index' );

    }

    public function addCarAction()
    {

        $Marki = new Marki();

        if($_POST)
        {

            $file = $this->request->getFiles('pliczek');

            $fileUpload = new FileUpload();
            $fileUpload->upload($file);

            $this->view->fileName = $fileUpload->fileName;

            $Cars = new Cars();


            $Cars->addCar($this->request->getPost(), $fileUpload->fileName);

            $helper = new Helper();
//            $helper->redirectAfterFormSuccess('cars', 'addCar', 'success', 'Poprawnie Dodano');
        }

        $this->view->marki = $Marki->getmarki();
        $this->view->display( 'add-car' );
    }

    public function editCarAction()
    {

        $Marki = new Marki();
        $Car = new Cars();

        $config = Config::getInstance();
        $config = $config->getConfig();

        if($_POST) {
            $file = $this->request->getFiles('pliczek');
            $fileName = $file['name'];
            var_dump($fileName);

            //uploadFile
            if (!empty($fileName)) {
                $fileTempPath = $file['tmp_name'];



                $uploadPath = $config['IMG_DIR'];

                $fileNewName = time() . $fileName;
                $fileUploadPath = $uploadPath . basename($fileNewName);
                $fileName = $fileNewName;
                $isImage = getimagesize($fileTempPath);

                if ($isImage !== false) {

                    $oldName = $this->request->getPost('imageName');
                    $oldImgDir = $config['IMG_DIR'].$oldName;
                    var_dump($oldImgDir);
                    $oldImgMinDir = $config['IMG_DIR'].'min/'.$oldName;
                    if(file_exists($oldImgDir))
                    {
                        unlink($oldImgDir);
                        unlink($oldImgMinDir);
                    }

                    $img = WideImage::load($fileTempPath);

                    $img->resize(800, 600, 'inside')->saveToFile($uploadPath . basename($fileNewName));
                    $img->resize(200, 100, 'inside')->saveToFile($uploadPath . 'min/' . basename($fileNewName));

                    $this->view->fileName = $fileNewName;
                    //                if(move_uploaded_file($fileTempPath, $fileUploadPath)) {
                    //                    echo 'Plik '.  basename( $fileName). ' został dodany';
                    //                    WideImage::load($fileUploadPath)->resize(300, 200, 'inside')->saveToFile($fileUploadPath);
                    //                } else{
                    //                    echo "Plik nie został dodany";
                    //                }
                } else {
                    echo 'plik nie jest zdjęciem';
                    die();
                }
            }
            else
            {
                $fileNewName = $this->request->getPost('imageName');
            }

            echo '<pre>';
            var_dump($this->request->getPost());
            $params = $this->request->getPost();

            $Car->updateCar($params, $fileNewName);

            $id = $this->request->getParam('id');
            var_dump($id);
            $helper = new Helper();
            $helper->redirectAfterFormSuccess('cars', 'editCar', 'success', 'Poprawnie zedytowano', $id);

        }

        $this->view->marki = $Marki->getmarki();

        $this->view->car = $Car->editCar($this->request->getParam('id'));

        $this->view->dirImgMin = $config['PUBLIC_IMG_MIN'];
        $this->view->display( 'edit-car' );
    }

    public function deleteCarAction()
    {
        $Marki = new Cars();
        $id = $this->request->getParam('id');

        $succes = $Marki->deleteCar($id);

        if($succes)
        {
            $helper = new Helper();
            $helper->redirectAfterFormSuccess('cars', 'list', 'success', 'Poprawnie usunieto');
        }
        else
        {
            $helper = new Helper();
            $helper->redirectAfterFormSuccess('cars', 'list', 'error', 'Something went wrong!');
        }


    }



}
