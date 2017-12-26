# Pickee WordPress [![CircleCI](https://circleci.com/gh/takoman/pickee-wp.svg?style=svg&circle-token=062cdeb675f1b4643eb831a22f04e69a61aa1b8b)](https://circleci.com/gh/takoman/pickee-wp)

## Meta

* __State:__ development
* __Production:__
* __Staging:__ [http://pickee-wp-staging.herokuapp.com/](http://pickee-wp-staging.herokuapp.com/) | [Heroku](https://dashboard.heroku.com/apps/pickee-wp-staging/resources)
* __Github:__ [https://github.com/takoman/pickee-wp](https://github.com/takoman/pickee-wp)
* __CI/Deploys:__ [CircleCI](https://circleci.com/gh/takoman/pickee-wp); merged PRs to master branch are automatically deployed to staging

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
  ```

  If `php-fpm` doesn't output php 7, make sure `/usr/local/sbin` is before `/usr/sbin`.

* We will use our own [config files](config/php-fpm) for running php-fpm locally.

* Allow environment variables to reach FPM worker processes by making sure `clear_env` is
  set to `no` in `config/php-fpm/php-fpm.d/www.conf`.
  ```
  clear_env = no
  ```

### Install nginx

* Install nginx via Homebrew:
  ```
  brew install nginx
  ```

* We will use our own [config files](config/nginx) for running nginx locally.

#### Notes

* Log files
  ```
  /usr/local/var/log/php-fpm.log
  /usr/local/var/log/nginx/access.log
  /usr/local/var/log/nginx/error.log
  ```

* Config files
  ```
  /usr/local/etc/php/7.0/php.ini
  ```

### Fork and clone this repo
TODO

### Configure
* Copy over `.env.example` to `.env` and make necessary changes:
  ```
  cp .env.example .env
  # Make necessary changes
  ```

* Start FPM and nginx in non-daemon mode:
  ```
  foreman start -f Procfile.dev
  ```

### Install Wordpress
Visit [http://localhost:7070/wp-admin](http://localhost:7070/wp-admin) and follow the steps to install Wordpress.

### Caveat
* Occasiaonally nginx will raise 502 Bad Gateway error with message like:
  ```
  2017/06/10 18:08:04 [error] 2462#0: *2 upstream prematurely closed connection while reading response header from upstream, client: 127.0.0.1, server: localhost, request: "GET /wp-admin/update-core.php HTTP/1.1", upstream: "fastcgi://127.0.0.1:9000", host: "localhost:7070", referrer: "http://localhost:7070/wp-admin/"
  ```
  Refreshing the page a few times would work again, but not sure what exactly the cause was.

* Using `Ctrl-C` to exit foreman might not kill php-fpm processes gracefully and we need to find the process IDs and kill them manually.
