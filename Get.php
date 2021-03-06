<?php

require_once 'Session.php';

class Get {

    private static $indirect = null;

    function __construct() {
        // defined to avoid method get() to be seen as constructor
    }
    
    static function setFromSession() {
        $_GET = Session::get('$_GET');
    }

    static function has($key) {
        return isset($_GET[$key]) && !empty($_GET[$key]);
    }

    static function get($key, $default = '') {
        if (self::$indirect !== null) {
            $value = self::$indirect[$key];
        } else {
            // filter_input does not work after setting $_GET
            //$value = Get::get($key);
            if(isset($_GET[$key])) {
                $value = $_GET[$key];
            } else {
                $value = '';
            }
        }
        if ($value === false || $value === null) {
            $value = '';
        }
        if ($value == '') {
            $value = $default;
        }
        return trim($value);
    }

    static function all() {
        return $_GET;
    }

    static function toSession() {
        $_SESSION['GET'] = $_GET;
    }

    static function fromSession() {
        self::$indirect = $_SESSION['GET'];
    }

}
