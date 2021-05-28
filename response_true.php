<?php
// example
// http://localhost:8080/response_true.php?url=https%3A%2F%2Fsoftreck.com/
require("load_func.php");

header('Content-Type: application/json');


try {
//    $url = $_GET['url'];
    $url = "https://softreck.com";
    $url = urldecode($url);

    load_func([
        'https://php.defjson.com/def_json.php',
    ], function () {

        global $url;
        echo def_json("", [
            "status" => is_404($url),
            "url" => $url
        ]);

    });
} catch (Exception $e) {
    // Set HTTP response status code to: 500 - Internal Server Error
    echo def_json("", [
            "message" => $e->getMessage(),
            "url" => $url
        ]
    );
}

//echo def_json("", ["no code"]);

//http_response_code();


function is_404($url)
{
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);

    /* Get the HTML or whatever is linked in $url. */
    $response = curl_exec($handle);

    /* Check for 404 (file not found). */
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);

    /* If the document has loaded successfully without any redirection or error */
    if ($httpCode >= 200 && $httpCode < 300) {
        return false;
    } else {
        return true;
    }
}