#!/bin/bash

# Exit immediately if a pipeline returns a non-zero status.
set -e

PHP_FPM_CONF_PATH="config/php-fpm/php-fpm.conf"

php "$PHP_FPM_CONF_PATH.php" > $PHP_FPM_CONF_PATH
php-fpm --nodaemonize -y "$PWD/$PHP_FPM_CONF_PATH"
