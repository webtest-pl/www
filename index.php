<?php
// http://localhost:8080/index.php

require("load_func.php");
$screen_shot_image = '';


if (empty($_POST["domains"])) {
    $_POST["domains"] = "softreck.com";
}

if (isset($_POST["multi"])) {

    load_func([
        'https://php.letjson.com/let_json.php',
        'https://php.defjson.com/def_json.php',
        'https://php.eachfunc.com/each_func.php',
        'get_domain_by_url.php',

    ], function () {

        $domains = $_POST["domains"];
        // Clean URL
        $domains = str_replace('"', "", $domains);
        $domains = str_replace("'", "", $domains);
        $domains = str_replace(" ", "", $domains);
        $domains = str_replace(",", "", $domains);
        $domains = trim($domains);

        if (empty($domains)) {
            throw new Exception("domains is empty");
        }

        $domain_list = array_values(array_filter(explode(PHP_EOL, $domains)));

//        var_dump($domain_list);
//        die;
        if (empty($domain_list)) {
            throw new Exception("domain list is empty");
        }

        $domain_nameserver_list = each_func($domain_list, function ($url) {

            if (empty($url)) return null;

            //$url = str_replace(PHP_EOL, '', $url);
                
            $url = trim($url);
            //$url = rtrim($url, ' ');
            $url = rtrim($url, '"');
            $url = rtrim($url, ';');
            $url = rtrim($url, ',');
            $url = rtrim($url, '/');

            
            if (empty($url)) return null;
            
            
            if (!(strpos($url, "http://") === 0) && !(strpos($url, "https://") === 0)) {
                $url = "https://" . $url;
            }

//            if(!(strpos( $url, "https://" ) === 0)){
//                $url = "https://" . $url
//            }

            $urle = urlencode($url);
            $url_screen = "http://webscreen.pl:3000/url/{$urle}";
//            var_dump($url_screen);
            $domain = get_domain_by_url($url);

            return "
 <br><div>
    SCREEN: <a href='$url_screen' target='_blank'> $url</a>
    WEB: <a href='$url' target='_blank'> $url</a>
    <br>
    DNS: <a class='domain' href='https://domain-dns.parkingomat.pl/get.php?domain=$domain' target='_blank'> $domain </a>
    <br>
    REG: 
    <a class='registrar' href='https://ap.www.namecheap.com/domains/domaincontrolpanel/$domain/domain' target='_blank'> NAMECHEAP </a>
    <a class='registrar' href='https://premium.pl/ustawienia/$domain' target='_blank'> PREMIUM </a>
    
    REG-DNS:
    <a class='registrar' href='https://premium.pl/domain/changens.html?name=$domain&type=domain' target='_blank'> PREMIUM </a>
    <a class='registrar' href='https://www.aftermarket.pl/Domain/NS/?domain=$domain' target='_blank'> AFTERMARKET </a>
    
    <br>
    <img src='$url_screen' class='img-responsive img-thumbnail' />
    <br>
    <iframe src='$url' title='$domain'></iframe> 
</div>
            ";
        });

        global $screen_shot_image;

        $screen_shot_image = implode("<br>", $domain_nameserver_list);
//        var_dump($domain_nameserver_list);
//        var_dump($screen_shot_image);

    });
}

?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>How to capture website screen shot from url in php</title>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        .box {
            width: 100%;
            max-width: 720px;
            margin: 0 auto;
        }
    </style>

</head>
<body>
<div class="container box">
    <a href="http://webscreen.pl:3000/remove/png" target='_blank'> remove png </a>
     <a href="http://webscreen.pl:3000/remove/txt" target='_blank'> remove txt </a>
    <br/>
    <h2 align="center">capture website screen shot</h2><br/>
    <form method="post">

        <div class="form-group">
            <label>Enter Domain name</label>
            <br>
            <textarea name="domains" cols="55" rows="20"><?php echo $_POST["domains"] ?></textarea>
        </div>
        <br/>
        <input type="submit" name="multi" value="Take a Screenshot" class="btn btn-info btn-lg"/>
    </form>
    <br/>
    <?php

    echo $screen_shot_image;

    ?>
</div>
<div style="clear:both"></div>
<br/>

<br/>
<br/>
<br/>

<script>
    $('a.domain').each(function () {
        // var value = $(this).attr('href');
        // $(this).attr('href', value.replace('#/',''));
        var atext = $(this);
        var url = atext.attr('href');
        // console.log(domain);
        // var url = "https://domain-dns.parkingomat.pl/get.php?domain=" + domain;
        var jqxhr = $.ajax(url)
            .done(function (result) {
                console.log(result);
                console.log(atext);
                // var nameservers = JSON.stringify(result.nameserver);
                var nameservers = result.nameserver.join(", ");
                console.log(nameservers);
                // alert( "success" );
                atext.html( nameservers );
                atext.addClass("active");
            });
    });
</script>

<style>
    a.domain {
        color: gray;
        text-decoration: none;
    }

    a.domain.active {
        color: #222333;
        text-decoration: none;
    }
    img.img-thumbnail {
        height:300px;
    }
    iframe {
        height:300px;
        width:600px;
    }
</style>
</body>
</html>
