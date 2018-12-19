<?php

class Server {

    static function get($key) {
        return filter_input(INPUT_SERVER, $key);
    }

}
