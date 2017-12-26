#!/bin/bash

# Exit immediately if a pipeline returns a non-zero status.
set -e

PICKEE_WP_CONF_PATH="config/nginx/pickee-wp"
NGINX_CONF_PATH="config/nginx/nginx.conf"

php "$PICKEE_WP_CONF_PATH.php" > $PICKEE_WP_CONF_PATH
nginx -c "$PWD/$NGINX_CONF_PATH" -g 'daemon off; error_log /dev/stderr debug;'
