<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
try
{
    //Dodanie sciezek plikow
    set_include_path
    (
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../lib/' . DIRECTORY_SEPARATOR .
        get_include_path() . PATH_SEPARATOR . getcwd() . '/../application/config/'. PATH_SEPARATOR
    );
    //ladowanie powyzszych sciezek
    function MVCAutoload( $className )
    {
        include $className . '.php';
    }

    spl_autoload_register('MVCAutoload', true, true);

    $request = new Request();

    $controller = $request->getParam( 'controller', 'index' );


    echo $controller;

    //konfiguracja w singletonie
    $config = Config::getInstance();
    $config = $config->getConfig();
    echo '<pre>';
    print_r($config);

    //sprawdza czy kontroller istnieje;
    if( file_exists( $config['APP_DIR'] . 'controllers/' . $controller . 'Controller.php' ) )
    {
        //cos tam dalej
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