<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$stopWatching = isset( $stopWatching )  ? $stopWatching : false;
try
{
    //Dodanie sciezek plikow
    set_include_path
    (
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../lib/' . DIRECTORY_SEPARATOR .
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../application/config/'. PATH_SEPARATOR .
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../application/controllers/' . PATH_SEPARATOR .
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../application/views/' . PATH_SEPARATOR .
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../application/models/' . PATH_SEPARATOR .
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../lib/wideimage/' .PATH_SEPARATOR
    );
    //ladowanie powyzszych sciezek
    function MVCAutoload( $className )
    {
        include $className . '.php';
    }

    spl_autoload_register('MVCAutoload', true, true);

    $request = new Request();

    $controller = $request->getParam( 'controller', 'index' );




    //konfiguracja w singletonie
    $config = Config::getInstance();
    $config = $config->getConfig();


    //sprawdza czy kontroller istnieje;
    if( file_exists( $config['APP_DIR'] . 'controllers/' . $controller . 'Controller.php' ) )
    {
        //odbieranie kontrollera
        $requestObject = $controller . 'Controller';
        //pobranie parametru akcji
        $action = $request->getParam( 'action', 'index' );
        if( class_exists( $requestObject ) )
        {

            $actObject = new $requestObject();

            $requestAction = $action .'Action';
            //sprawdza czy metoda w klasie istnieje
            if( method_exists( $requestObject, $requestAction ) )
            {
                ob_start();
                $actObject->$requestAction();

                $layout = $actObject->layout;

                $content = ob_get_contents();
                ob_end_clean();

                if( isSet( $actObject->layoutName ) && $actObject->layoutName != '' )
                {
                    include_once( $actObject->layoutName . '.php' );
                }
                else
                {
                    include_once( $config['LAYOUT'] );
                }


            }
            else
            {
                throw new Exception( 'Method ' . $requestAction . ' not exists in class: ' .$requestObject );
            }
        }
        else
        {
            throw new Exception( 'Class ' . $controller . 'Controller not exists in file: ' .
                $config['APP_DIR'] . 'controllers/' . $requestObject . '.php' );
        }
    }
    else
    {
        throw new Exception( 'File ' . $config['APP_DIR'] . 'controllers/' . $controller . 'Controller.php not exists' );
    }



}
catch ( Exception $e )
{
    echo '<pre style="color:red;"><h1>ERROR</h1><br />';
    echo 'IN LINE: '. $e->getLine().'<br />';
    echo 'MESSAGE: '. $e->getMessage().'<br />';
    echo 'CODE: '. $e->getCode().'<br />';
    echo 'TRACE: ' . $e->getTraceAsString();
    echo '</pre>';
}