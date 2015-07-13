<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 07.07.15
 * Time: 15:51
 */

class Request {
    private $_post;
    private $_get;
    private $_files;
    private $_server;

    public function __construct() {

        $this->_post = $_POST;
        $this->_get = $_GET;
        $this->_files = $_FILES;
        $this->_server = $_SERVER;

        return $this;

    }

    public function getPost( $param = false, $default = false  ) {
        if( $param ) {
            return isSet( $this->_post[$param] ) ? $this->_post[$param] : $default;
        } else {
            return $this->_post;
        }
    }


    public function getParam( $param = false, $default = false ) {

        if( $param ) {
            return isSet( $this->_get[$param] ) ? $this->_get[$param] : $default;
        } else {
            return $this->_get;
        }
    }


    public function getFiles( $param = false, $default = false  )
    {
        if ($param) {
            return isSet($this->_files[$param]) ? $this->_files[$param] : $default;
        } else {
            return $this->_files;
        }
    }

    public function getServer( $param = false, $default = false  ) {
        if( $param ) {
            return isSet( $this->_server[$param] ) ? $this->_server[$param] : $default;
        } else {
            return $this->_server;
        }
    }


}