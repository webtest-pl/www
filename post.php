<?php
// http://localhost:8080/index.php
error_reporting(E_ERROR | E_PARSE);

require("apifunc.php");
$html = '';


if (empty($_POST["domains"])) {
    $_POST["domains"] = "softreck.com";
}

try {

    apifunc([
        'https://php.letjson.com/let_json.php',
        'https://php.defjson.com/def_json.php',
        'https://php.eachfunc.com/each_func.php',
        'https://domain.phpfunc.com/get_domain_by_url.php',
        'https://domain.phpfunc.com/clean_url.php',
        'https://domain.phpfunc.com/clean_url_multiline.php',
    ], function () {

        // Clean URL
        $domains = clean_url_multiline($_POST["domains"]);

        if (empty($domains)) {
            throw new Exception("domain list is empty");
        }

        $domain_list = array_values(array_filter(explode(PHP_EOL, $domains)));

//        var_dump($domain_list);
//        die;
        if (empty($domain_list)) {
            throw new Exception("domain list is empty");
        }

        $domain_nameserver_list = each_func($domain_list, function ($url) {

            if (empty($url)) return null;

            $url = clean_url($url);

            if (empty($url)) return null;

            if (!(strpos($url, "http://") === 0) && !(strpos($url, "https://") === 0)) {
                $url = "http://" . $url;
            }

            $domain = get_domain_by_url($url);

            if (isset($_POST["latency"])) {

                return "
 <div>
    <a href='$url' target='_blank'> $domain</a> 
    -
    <a class='latency' href='https://www.latency.pl/latency.php?domain=$domain' target='_blank'> - </a>
</div>
            ";

            } else if (isset($_POST["not_exist"])) {

                return "
 <div>
    <p>   
        <a class='not_exist' href='https://whois.webtest.pl/index.php?domain=$domain' target='_blank'> $domain </a>
    </p>
 </div>
            ";

            } else if (isset($_POST["whois"])) {
                return "
 <div>
    <a href='$url' target='_blank'> $domain</a> 
    -
    <a class='whois' href='https://whois.wolnadomena.pl/whois.php?domain=$domain' target='_blank'> - </a>
</div>
            ";
            } else if (isset($_POST["registered"])) {


                return "
 <div>
    <a href='$url' target='_blank'> $domain</a> 
    -
    <a class='registered' href='https://www.wolnadomena.pl/registered.php?domain=$domain' target='_blank'> - </a>
</div>
            ";

            } else if (isset($_POST["whois"])) {
                return "
 <div>
    <a href='$url' target='_blank'> $domain</a> 
    -
    <a class='whois' href='https://www.wolnadomena.pl/whois.php?domain=$domain' target='_blank'> - </a>
</div>
            ";

            } else if (isset($_POST["dns"])) {

                return "
 <div>
    <a href='$url' target='_blank'> $domain</a> 
    - 
    <a class='dns' href='https://domain-dns.parkingomat.pl/get.php?domain=$domain' target='_blank'> - </a>
</div>
            ";

            } else if (isset($_POST["multi"])) {


                $urle = urlencode($url);
                $url_screen = "http://webscreen.pl:3000/url/{$urle}";

                return "
 <br><div>
    SCREEN: <a href='$url_screen' target='_blank'> $url</a>
    <br>
    WEB: <a href='$url' target='_blank'> $url</a>
    <br>
    DNS: <a class='dns' href='https://domain-dns.parkingomat.pl/get.php?domain=$domain' target='_blank'> $domain </a>
    <br>
    REG: 
    <a class='registrar' href='https://ap.www.namecheap.com/domains/domaincontrolpanel/$domain/domain' target='_blank'> NAMECHEAP </a>
    <a class='registrar' href='https://premium.pl/ustawienia/$domain' target='_blank'> PREMIUM </a>

    <br>

    REG-DNS:
    <a class='registrar' href='https://premium.pl/domain/changens.html?name=$domain&type=domain' target='_blank'> PREMIUM </a>
    <a class='registrar' href='https://www.aftermarket.pl/Domain/NS/?domain=$domain' target='_blank'> AFTERMARKET </a>
    
    <br>
    <img src='$url_screen' class='img-responsive img-thumbnail' />
    <br>
    <iframe src='$url' title='$domain'></iframe> 
</div>
            ";
            }


        });

        global $html;

        $html = implode("<br>", $domain_nameserver_list);

    });


} catch (Exception $e) {
    // Set HTTP response status code to: 500 - Internal Server Error
    $html = $e->getMessage();
}

