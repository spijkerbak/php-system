<?php

require_once 'Get.php';
require_once 'Post.php';
require_once 'Session.php';

class Parameters {

    private $got = 0;
    private $posted = 0;

    function get($key, $default = null) {
        if (GET::has($key)) {
            $value = GET::get($key);
            $this->got++;
            Session::set($key, $value);
        } else if (Post::has($key)) {
            $value = Post::get($key);
            $this->posted++;
            Session::set($key, $value);
        } else if (Session::has($key)) {
            $value = Session::get($key);
        } else {
            $value = $default;
        }
        return $value;
    }

    function eat() {
        if ($this->got > 0 || $this->posted > 0) {
            header('location: .');
            exit;
        }
    }

}