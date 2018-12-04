<?php

function startsWith($haystack, $needle)
{
     $length = strlen($needle);
     return substr($haystack, 0, $length) === $needle;
}

function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    return $length === 0 || substr($haystack, -$length) === $needle;
}

function startsWithCI($haystack, $needle) {
    return startsWith(strtolower($haystack), strtolower($needle));
}

function endsWithCI($haystack, $needle) {
    return endsWith(strtolower($haystack), strtolower($needle));
}
