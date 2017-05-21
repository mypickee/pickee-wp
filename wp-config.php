<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

$db_env_var = getenv('DATABASE_PROVIDER_VAR') ?: 'DATABASE_URL';
$db = parse_url(getenv($db_env_var));

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', trim($db['path'], '/'));

/** MySQL database username */
define('DB_USER', trim($db['user']));

/** MySQL database password */
define('DB_PASSWORD', trim($db['pass']));

/** MySQL hostname */
define('DB_HOST', trim($db['host']));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
//define('AUTH_KEY',         getenv('AUTH_KEY'));
//define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
//define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
//define('NONCE_KEY',        getenv('NONCE_KEY'));
//define('AUTH_SALT',        getenv('AUTH_SALT'));
//define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
//define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
//define('NONCE_SALT',       getenv('NONCE_SALT'));

define('AUTH_KEY',         '[D1dy*L(+JHKhCekcP|At2!34+:ur4(_egU7,lA}FfD||Dk8v!Wh{2X^U5l/*UO-');
define('SECURE_AUTH_KEY',  'B|6Hh][u:ZE,Z;6T7P)-P]pK53v:78xJsN6)guWU@d^rXu1+ADCyD|#.qH -wN<x');
define('LOGGED_IN_KEY',    '`7KvP>/m!.7Xo^fwNz9<.i+mhiU?(<^hu~m_9!mm+s@Zvje|,fD|tK;3Hu{whJdt');
define('NONCE_KEY',        '`!oWiLH*yno0tXviZ68BLl[fd+eCYH>~n5yW? BT+d}>+QK2Z.9hDQPyzq^Zd3-W');
define('AUTH_SALT',        ' BL^=ZASM&}o:E~ZT|}Q-B8o@xcV(5crs_it$|Q,8zR Z^c-/2tMyF}2]ny8IByi');
define('SECURE_AUTH_SALT', '{ptp%Q#{[zNFc^s=|ulZB<4y+8NlTlGfC3q2yi:Cwj|. iF1^[GzEkKgiV;5k6ay');
define('LOGGED_IN_SALT',   ':8Xo*7/eaf[@P#jGw9f5BD+9L4oe)| dQXW{l5m__n:^v*9({[;e[*RA{[-3?nUk');
define('NONCE_SALT',       '@H-1qNBvc;VWM^|}E?qcg9qBdL n%d7f<s(];^Y_W;uS.}oBl9JO/1D|VxR~T?P?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/** Disable all updates.  */
define('AUTOMATIC_UPDATER_DISABLED', true);
