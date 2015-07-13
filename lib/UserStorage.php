<?php

class UserStorage extends mainController{

    public function __construct() {
        
    }
    
    public function setUserData( $userData ) {
        $_SESSION['userData'] = $userData;
        $_SESSION['userData']['logged'] = true;
    }


    public function isAuthenticate() {
        return ( isSet( $_SESSION['userData']['logged'] ) && $_SESSION['userData']['logged'] == true  ) ? true : false;
    }
    
    public function getUserData() {
        return ( isSet( $_SESSION['userData']['logged'] ) && $_SESSION['userData']['logged'] == true  ) ? $_SESSION : false;
    }
    
    public function logout() {
        unset( $_SESSION['userData'] );
    }
}