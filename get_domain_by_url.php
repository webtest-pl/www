<?php

function get_domain_by_url($url)
{
    $parse = parse_url($url);
    $domain = $parse['host'];
    $domain = rtrim($domain, ' ');
    $domain = rtrim($domain, '"');
    $domain = rtrim($domain, ';');
    $domain = rtrim($domain, ',');
    $domain = rtrim($domain, '_');

    return $domain;
}
