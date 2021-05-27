# www
Check domains , test connection, screen, 

[github.com/webtest-pl](https://github.com/webtest-pl)

[www.webtest.pl](https://webtest.pl/#/)



## build, deploy
on vps or based on docker image

## environment
Based on apicra:
+ php
+ nginx

## subdomains
Included Projects:

+ logs.*, show logs
+ admin.*, script manager
+ edit.*, file manager

[edit](https://github.com/webtest-pl/www/edit/main/README.md)

+ based on parkingomat

https://domain-screen.parkingomat.pl/


php read

+ [Check screen for domain list - info about project](https://domain-screen.parkingomat.pl/)

+ [Check screen for domain list - GET request](https://domain-screen.parkingomat.pl/index.php)


## github

https://github.com/webtest-pl/www

GIT

https://github.com/webtest-pl/www.git

    git clone https://github.com/webtest-pl/www.git


# project URL-s

## for index with own json files

+ [webtest.pl/index.php](https://webtest.pl/index.php)

+ [localhost:8080](http://localhost:8080/)


    curl http://localhost:8080/index.php


## GET Request

localhost

[http://localhost:8080/get.php?domain=apiprogram.com](http://localhost:8080/get.php?domain=apiprogram.com)

    curl http://localhost:8080/get.php?domain=apiprogram.com

domain parkingomat.pl

[https://domain-screen.parkingomat.pl/get.php?domain=apiprogram.com](https://domain-screen.parkingomat.pl/get.php?domain=apiprogram.com)



## GET REMOVE

http://webscreen.pl:3000/remove/png


http://webscreen.pl:3000/remove/txt
