<?php

/**
 * Created by PhpStorm.
 * User: xubuntu
 * Date: 10.07.15
 * Time: 09:52
 */
class FileUpload
{
    public $fileName;

    public function upload($file)
    {

        $fileName = $file['name'];
        var_dump($fileName);

        //uploadFile
        if(!empty($fileName))
        {
            $fileTempPath = $file['tmp_name'];

            $config = Config::getInstance();
            $config = $config->getConfig();

            $uploadPath = $config['IMG_DIR'];

            $fileNewName = time() . $fileName;
            $fileUploadPath = $uploadPath . basename($fileNewName);
            $fileName = $fileNewName;
            $isImage = getimagesize($fileTempPath);

            if ($isImage !== false) {

                $img = WideImage::load($fileTempPath);

                $img->resize(800, 600, 'inside')->saveToFile($uploadPath.basename($fileNewName));
                $img->resize(200, 100, 'inside')->saveToFile($uploadPath.'min/'.basename($fileNewName));

               $this->fileName = $fileNewName;
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
    }
}