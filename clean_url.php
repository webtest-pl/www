<?php


/**
 * @param string $url
 *
 * @return string
 */
function clean_url($url)
{
    //$url = str_replace(PHP_EOL, '', $url);

    $url = trim($url);
    //$url = rtrim($url, ' ');
    $url = rtrim($url, '"');
    $url = rtrim($url, ';');
    $url = rtrim($url, ',');
    $url = rtrim($url, '/');

    return $url;
}

