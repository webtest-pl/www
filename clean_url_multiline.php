<?php


/**
 * @param string $domains
 *
 * @return string
 */
function clean_url_multiline($domains)
{
    $domains = str_replace('"', "", $domains);
    $domains = str_replace("'", "", $domains);
    $domains = str_replace(" ", "", $domains);
    $domains = str_replace(",", "", $domains);
    $domains = trim($domains);

    return $domains;
}