# [WebTest.pl](https://webtest.pl/)

+ [www.webtest.pl](https://webtest.pl/)

Test domains, websites & webservices
+ whois data
+ screenshot
+ dns nameserver
+ latency, ping


## github [github.com/webtest-pl](https://github.com/webtest-pl)

https://github.com/webtest-pl/www

## GIT clone

https://github.com/webtest-pl/www.git

    git clone https://github.com/webtest-pl/www.git


# First Steps

## on linux

### install
    sh .apicra/install

### start
    sh .apicra/start

### open in browser
    sh .apicra/browser

## on windows

### install
    .apicra\install.bat

### start
    .apicra\start.bat


### open in browser
    .apicra\browser.bat


# TODO:

### SSL
+ check if SSL exists?
+ till when is valid?
+ company?

### find services, redirections

+ http / https
+ * / www.*
+ port:
    + 3000
    + 5000
    + 8080
    + 80
    + email ports
    + sftp, ftp, ssh
    
### check type of application

+ static
+ dynamic
    + CMS:
        + wordpress
        + drupal
    + ecommerce
        + magento
        + ...
    + dedicated
        
### check technologies

frontend libs/frameworks
+ vue
+ jquery


backend
+ php
+ nodejs
+ 



### frontend third part
+ google
+ amazon



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





# project URL-s

## for index with own json files

+ [webtest.pl/index.php](https://webtest.pl/index.php)

+ [localhost:8080](http://localhost:8080/)


    curl http://localhost:8080/index.php


## GET Request

localhost

[http://localhost:8080/get.php?domain=apiprogram.com](http://localhost:8080/get.php?domain=apiprogram.com)

    curl http://localhost:8080/get.php?domain=apiprogram.com

## GET REMOVE

http://webscreen.pl:3000/remove/png


http://webscreen.pl:3000/remove/txt


---
+ [edit](https://github.com/webtest-pl/www/edit/main/README.md)
