<?php

require_once 'Base.php';

class Cookie {

    static function get($key, $default = '') {
        $value = filter_input(INPUT_COOKIE, $key);
        if ($value === false || $value === null) {
            $value = '';
        }
        if ($value == '') {
            $value = $default;
        }
        return trim($value);
    }

    static function set($key, $value, $time = 0) {
        setcookie($key, $value, $time, '/' . BASE . '/', '', true, true);
    }

}
