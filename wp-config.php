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
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

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

/**
 * Amazon S3 and Cloudfront plugin configs
 */
define('AS3CF_SETTINGS', serialize(array(
  // Storage Provider ('aws', 'do')
  'provider' => 'aws',
  // Access Key ID for Storage Provider (replace '*')
  'access-key-id' => getenv('AS3CF_S3_ACCESS_KEY_ID'),
  // Secret Access Key for Storage Provider (replace '*')
  'secret-access-key' => getenv('AS3CF_S3_SECRET_ACCESS_KEY'),
  // Bucket to upload files to
  'bucket' => getenv('AS3CF_S3_BUCKET'),
  // Bucket region (e.g. 'us-west-1' - leave blank for default region)
  'region' => '',
  // Automatically copy files to bucket on upload
  'copy-to-s3' => true,
  // Rewrite file URLs to bucket
  'serve-from-s3' => true,
  // Bucket URL format to use ('path', 'cloudfront')
  'domain' => 'cloudfront',
  // Custom domain if 'domain' set to 'cloudfront'
  'cloudfront' => getenv('AS3CF_CLOUDFRONT_DOMAIN'),
  // Enable object prefix, useful if you use your bucket for other files
  'enable-object-prefix' => true,
  // Object prefix to use if 'enable-object-prefix' is 'true'
  'object-prefix' => 'wp-content/uploads/',
  // Organize bucket files into YYYY/MM directories
  'use-yearmonth-folders' => true,
  // Serve files over HTTPS
  'force-https' => true,
  // Remove the local file version once offloaded to bucket
  'remove-local-file' => false,
  // Append a timestamped folder to path of files offloaded to bucket
  'object-versioning' => true,
)));

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

// Only redirect requests if it's not already HTTPS. Note that this has to
// come before `require_once(ABSPATH . 'wp-settings.php');`
// https://stackoverflow.com/questions/27193575/wordpress-cloudfront-flexible-ssl-ends-up-in-redirect-loop-https/27193576#27193576
if ($_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') $_SERVER['HTTPS'] = 'on';

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/** Disable all updates.  */
define('AUTOMATIC_UPDATER_DISABLED', true);
