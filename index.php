<?php
/*
 * https://www.webtest.pl/index.php?domain=softreck.com
 * http://localhost:8080/index.php?domain=softreck.com
 */
require("post.php");
?>

<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
<!--    <meta http-equiv="Content-Security-Policy" content="default-src 'none'; style-src 'unsafe-inline'; img-src data:; connect-src 'self'">-->

    <title>WebTest.pl - Test Your domains list</title>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>

</head>
<body>
<div class="container box">

    <h1 class="center">WebTest.pl</h1>
    <p class="center">Test your domains and webservices worked on</p>
    <hr>
    <form method="post">
        <div class="form-group">
            <label>Enter domain names, line by line</label>
            <br>
            <textarea name="domains" cols="55" rows="20"><?php echo $_POST["domains"] ?></textarea>
        </div>
        <br/>
        <input type="submit" name="multi" value="All" class="btn btn-info btn-lg"/>
        <!--        <input type="submit" name="screen" value="Screenshot" class="btn btn-info btn-lg"/>-->
        <input type="submit" name="dns" value="DNS" class="btn btn-info btn-lg"/>
        <input type="submit" name="whois" value="WHOIS" class="btn btn-info btn-lg"/>
        <input type="submit" name="registered" value="REGISTERED" class="btn btn-info btn-lg"/>
        <input type="submit" name="latency" value="LATENCY" class="btn btn-info btn-lg"/>
<!--        <input type="submit" name="not_exist" value="NOT EXIST" class="btn btn-info btn-lg"/>-->
    </form>
    <br/>
    <?php
    global $html;
    echo $html;
    ?>
</div>
<div style="clear:both"></div>
<br/>
<hr>
<div class="center">
    <div>
        API webscreen:
        <a href="http://webscreen.pl:3000/remove/png" target='_blank'> remove png </a>
        |
        <a href="http://webscreen.pl:3000/remove/txt" target='_blank'> remove txt </a>

    </div>

    <div>
        DEV:
        <a href="https://github.com/webtest-pl/www" target='_blank'>source code</a>
        |
        <a href="https://www.webtest.pl/" target='_blank'> production </a>
        |
        <a href="http://localhost:8080/" target='_blank'> localhost </a>

    </div>

    <div>
        Supported by:
        <a href="https://softreck.com" target='_blank'>softreck.com</a>
        |
        <a href="https://softreck.pl" target='_blank'>softreck.pl</a>
        |
        <a href="https://www.webstream.dev" target='_blank'>webstream.dev</a>
        |
        <a href="https://www.apifunc.com" target='_blank'>apifunc.com</a>

    </div>
</div>

<script>
    $('a.dns').each(function () {
        var atext = $(this);
        var url = atext.attr('href');
        var jqxhr = $.ajax(url)
            .done(function (result) {
                console.log(result);
                console.log(atext);
                // var nameservers = JSON.stringify(result.nameserver);
                var nameservers = result.nameserver.join(", ");
                console.log(nameservers);
                // alert( "success" );
                atext.html(nameservers);
                atext.addClass("active");
            });
    });
</script>



<script>
    $('a.whois').each(function () {
        var atext = $(this);
        var url = atext.attr('href');
        var jqxhr = $.ajax(url)
            .done(function (result) {
                console.log(result);
                console.log(atext);
                var info = result.whois.domain;
                console.log(info);

                // var whois = Object.keys(info).join(',');
                var whois = '';
                if ("undefined" !== typeof result.whois.domain.name) whois += result.whois.domain.name + '<br>';
                if ("undefined" !== typeof result.whois.domain.expires) whois += result.whois.domain.expires + '<br>';
                if ("undefined" !== typeof result.whois.domain.created) whois += result.whois.domain.created + '<br>';
                if ("undefined" !== typeof result.whois.domain.status) whois += Object.values(result.whois.domain.status).join('<br>');
                if ("undefined" !== typeof result.whois.domain.sponsor)  whois += Object.values(result.whois.domain.sponsor).join('<br>');
                console.log(whois);

                atext.addClass("active");
                atext.html(whois);
            });
    });
</script>


<script>
    $('a.registered').each(function () {
        var atext = $(this);
        var url = atext.attr('href');
        var jqxhr = $.ajax(url)
            .done(function (result) {
                console.log(result);
                console.log(atext);
                console.log(result.registered);
                atext.addClass("active");
                atext.html(result.registered);
            });
    });
</script>


<script>
    $('a.latency').each(function () {
        var atext = $(this);
        var url = atext.attr('href');
        var jqxhr = $.ajax(url)
            .done(function (result) {
                console.log(result);
                console.log(atext);
                console.log(result.ping);
                atext.addClass("active");
                atext.html(result.ping);
            });
    });
</script>

<script>
    // $('a.not_exist').each(function () {
    //     var atext = $(this);
    //     var url = atext.attr('href');
    //     var jqxhr = $.ajax(url)
    //         .done(function (result) {
    //             console.log(result.status);
    //             if(result.status !== "unknown"){
    //                 atext.parent().html("");
    //             }
    //         });
    // });
</script>

</body>
</html>
