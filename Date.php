<?php

// UTF-8 Nó BOM

function stdDate($t, $invalid = null, $empty = null) {
    if (empty($t)) {
        return $empty;
    }
    $p = preg_split('/[^0-9]+/', $t);
    if (count($p) != 3) {
        return $invalid;
    }
    if ($p[0] > 31) { // yyyy-m-d -> yyyy-mm-dd
        return sprintf("%04d-%02d-%02d", $p[0], $p[1], $p[2]);
    } else { // d-m-y -> yyyy-mm-dd
        return sprintf("%04d-%02d-%02d", $p[2], $p[1], $p[0]);
    }
}

function datetext($t = null) {
    if ($t == null) {
        $t = date('Y-m-d');
    }
    $h = getdate(strtotime($t));
    return sprintf("%02d-%02d-%04d", $h['mday'], $h['mon'], $h['year']);
}

function today() {
    return date('Y-m-d');
}

function daytext($t = '') {
    if ($t == '') {
        $t = date('Y-m-d');
    }
    $h = getdate(strtotime($t));
    $wd = array('zon', 'maan', 'dins', 'woens', 'donder', 'vrij', 'zater');
    return sprintf("%sdag %02d-%02d-%04d", $wd[$h['wday']], $h['mday'], $h['mon'], $h['year']);
}

function timetext($t = '', $d = ':') {
    if ($t == '') {
        $t = date('H:i:s');
    }
    $h = getdate(strtotime($t));
    return sprintf('%02d' . $d . '%02d', $h['hours'], $h['minutes']);
}
