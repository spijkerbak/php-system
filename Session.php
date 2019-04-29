<?php

require_once 'Base.php';

class Session {

    static function init() {
        session_name(BASE);
        session_start();
    }

    static function has($key) {
        return isset($_SESSION[$key]);
    }

    static function get($key, $default = '') {
        if (isset($_SESSION[$key])) {
            $value = $_SESSION[$key];
        } else {
            $value = $default;
        }
        if (is_array($value)) {
            return $value;
        } else {
            return trim($value);
        }
    }

    static function eat($key, $default = '') {
        $value = Session::get($key, $default);
        Session::clear($key);
        return $value;
    }

    static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    static function clear($key = null) {
        if ($key == null) {
            session_unset();
        } else if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    static function fromPost($key) {
        $value = filter_input(INPUT_POST, $key);
        if ($value !== false && $value !== null) {
            if ($value == '') {
                unset($_SESSION[$key]);
            } else {
                $_SESSION[$key] = $value;
            }
        }
        return $value;
    }

    static function setFromFormIfSet($key) {
        $value = filter_input(INPUT_POST, $key);
        if ($value === false || $value === null) {
            $value = Get::get($key);
        }
        if ($value !== false && $value !== null) {
            if ($value == '') {
                unset($_SESSION[$key]);
            } else {
                $_SESSION[$key] = $value;
            }
        }
    }

    static function setFromForm($key) {
        $value = filter_input(INPUT_POST, $key);
        if ($value === false || $value === null) {
            $value = Get::get($key);
        }
        if ($value !== false && $value !== null) {
            if ($value == '') {
                unset($_SESSION[$key]);
            } else {
                $_SESSION[$key] = $value;
            }
        } else {
            unset($_SESSION[$key]);
        }
    }

}

Session::init();
