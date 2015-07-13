<?php

class Url
{
    public static function getUrl($controller, $action, $params = array())
    {
        $config = Config::getInstance();
        $config = $config->getConfig();

        $paramString = '';

        if (count($params)) {
            foreach ($params as $key => $val) {
                $paramString .= '&' . $key . '=' . $val;
            }
        }
        return $config['BASE_URL'] . '?controller=' . $controller . '&action=' . $action . $paramString;
    }

}