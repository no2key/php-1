1: git clone git://github.com/zendframework/ZendSkeletonApplication.git
2: cd ZendSkeletonApplication
3: php composer.phar self-update
4: php composer.phar install

5: /etc/hosts add this line
127.0.0.1   zf2_dev.com
127.0.0.1   www.zf2_dev.com

6: apache2 

<VirtualHost *:80>
    ServerAdmin yuchih@facebook.com
    DocumentRoot "/usr/local/zend/apache2/htdocs/zendframework2-tutorial/public"
    SetEnv APPLICATION_ENV "development"
    ServerName zf2.com
    #ServerAlias example.com
    <Directory "/usr/local/zend/apache2/htdocs/zendframework2-tutorial/public">
        DirectoryIndex index.php
        Options All
        AllowOverride FileInfo
        Order allow,deny
        Allow from all
    </Directory>
    ErrorLog "logs/zf2.com-error_log"
    CustomLog "logs/zf2.com-access_log" common
</VirtualHost>

7: 
server {

root /var/www/zf2_dev/public;
index index.html index.htm index.php;

server_name www.zf2_dev.com;

location / {
try_files $uri $uri/ /index.php$is_args$args;
}

location ~ .*\.(php|phtml)?$ {
include fastcgi_params;
fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
fastcgi_param APPLICATION_ENV development;
fastcgi_pass unix:/var/run/php5-fpm.sock;
fastcgi_index index.php;
}

location ~ .*\.(git|jpg|jpeg|png|bmp|swf|ico)?$ {
expires 30d;
}

location ~ .*\.(js|css)?$ {
expires 1h;
}

location ~ /\.ht {
deny all;
}
}

 

