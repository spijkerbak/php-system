<?php

require_once 'Session.php';

class Get {

    private static $indirect = null;

    function __construct() {
        // defined to avoid method get() to be seen as constructor
    }

    static function has($key) {
        return isset($_GET[$key]); // && !empty($_GET[$key]);
    }

    static function get($key, $default = '') {
        if (self::$indirect !== null) {
            $value = self::$indirect[$key];
        } else {
            $value = filter_input(INPUT_GET, $key);
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

    static function eat($keys) {
        if (!is_array($keys)) {
            $keys = [$keys];
        }
        $count = 0;
        foreach ($keys as $key) {
            if (Get::has($key)) {
                $value = Get::get($key);
                Session::set($key, $value);
                $count++;
            }
        }
        if ($count > 0) {
            header('Location: .');
            exit;
        }
    }

}
