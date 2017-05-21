# Pickee WordPress

## Meta

* __State:__ development
* __Production:__
* __Staging:__ [http://pickee-wp-staging.herokuapp.com/](http://pickee-wp-staging.herokuapp.com/) | [Heroku](https://dashboard.heroku.com/apps/pickee-wp-staging/resources)
* __Github:__ [https://github.com/takoman/pickee-wp](https://github.com/takoman/pickee-wp)
* __CI/Deploys:__

## Set-Up

1. Install MySQL, PHP, nginx.
1. Fork and clone this repo.
1. Configure.
1. Install Wordpress.

### Install MySQL

* Install MySQL via Homebrew:
  ```
  brew install mysql
  brew services list
  mysql -V
  mysqladmin -u root password # Set your root password
  ```

* Create a user and database for our Wordpress site:
  ```
  mysql> CREATE DATABASE pickee_wp_development;
  Query OK, 1 row affected (0.03 sec)

  mysql> CREATE USER pickee_wp_admin@localhost IDENTIFIED BY 'password';
  Query OK, 0 rows affected (0.01 sec)

  mysql> GRANT ALL PRIVILEGES ON pickee_wp_development.* TO pickee_wp_admin@localhost;
  Query OK, 0 rows affected (0.01 sec)

  mysql> FLUSH PRIVILEGES;
  Query OK, 0 rows affected (0.01 sec)

  mysql> exit
  Bye
  ```

### Install PHP

* Install PHP via Homebrew:
  ```
  brew install php70 --with-debug
  php -v
  php-fpm -v
  brew services restart php70
  ```

  If `php-fpm` not showing php 7, make sure `/usr/local/sbin` is before `/usr/sbin`.

### Install nginx

* Install nginx via Homebrew:
  ```
  brew install nginx
  mkdir -p /usr/local/etc/nginx/sites-available /usr/local/etc/nginx/sites-enabled
  ```

* Edit `/usr/local/etc/nginx/nginx.conf` and `include sites-enabled/*` at the end.
* Create `/usr/local/etc/nginx/sites-available/pickee-wp` with config like:
  ```
  server {
      listen       7070;
      server_name  localhost;

      root /Users/starsirius/Code/pickee-wp;
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
  ```
* `ln -s /usr/local/etc/nginx/sites-available/pickee-wp /usr/local/etc/nginx/sites-enabled/pickee-wp`

#### Notes

* Log files
  ```
  /usr/local/var/log/php-fpm.log
  /usr/local/var/log/nginx/access.log
  /usr/local/var/log/nginx/error.log
  ```

* Config files
  ```
  /usr/local/etc/nginx/fastcgi.conf
  /usr/local/etc/php/7.0/php.ini
  /usr/local/etc/php/7.0/php-fpm.conf
  /usr/local/etc/php/7.0/php-fpm.d/www.conf
  ```

#### Caveat
I have to run php-fpm as root `sudo brew services restart php70` to avoid a 502 Bad Gateway error.

### Fork and clone this repo
TODO

### Configure
TODO

Now you can run the following to run nginx in non-daemon mode:
```
nginx -g 'daemon off; error_log /dev/stderr debug;'
```

### Install Wordpress.
