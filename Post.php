<?php

class Post {

    static function has($key) {
        return isset($_POST[$key]);
    }

    static function get($key, $default = '') {
        $value = filter_input(INPUT_POST, $key);
        if ($value === false || $value === null) {
            $value = '';
        }
        if ($value == '') {
            $value = $default;
        }
        return trim($value);
    }

    static function getFiles() {
        return $_FILES;
    }
    
    static function all() {
        return $_POST;
    }

    static function getObject() {
        $object = (object) $_POST;
        if (isset($object->Rechten)) {
            $r = 0;
            foreach ($object->Rechten as $value) {
                $r = $r | $value;
            }
            $object->Rechten = $r;
        }
        return $object;
    }

}
