server {
    listen       7070;
    server_name  localhost;

    root <?= getcwd() ?>;
    index index.php;

    # show access in console; useful for development
    access_log /dev/stdout;

    location / {
        # This is cool because no php is touched for static content.
        # include the "?$args" part so non-default permalinks doesn't break when using query string
        try_files $uri $uri/ /index.php?$args;
    }

    location = /favicon.ico {
        log_not_found off;
        access_log off;
    }

    location = /robots.txt {
        allow all;
        log_not_found off;
        access_log off;
    }

    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        include        fastcgi.conf;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico)$ {
        expires max;
        log_not_found off;
    }
}
