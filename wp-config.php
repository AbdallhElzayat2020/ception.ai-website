<?php
define( 'WP_CACHE', true ); // Added by WP Rocket


// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

define( 'ITSEC_ENCRYPTION_KEY', 'KHNiNj12diNYM3poO3lgJiBvfDcjNkM5bnAmVERhJmR0aUdiQi1WUXxUSVk7fXgyYWxkeS5fYFo8SGJqUTFWUw==' );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'abdallh' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'lbMI0TgIdtTJ2ZA3BMrh6unpyKa72opwChfCz4DFf9v4ngr8sUdoMEAeuhqdRgun' );
define( 'SECURE_AUTH_KEY',  'DLRxaqP13K062MIKYacIr9CMX0eudoYaRYynC6LpYUG9IENAZla1FYp89hN83fRl' );
define( 'LOGGED_IN_KEY',    'p5ueOATVZw9TH48s058fsOssGnOC0aQcuUASk7OdEWx7oO80waL2XvdkRlgmfG4g' );
define( 'NONCE_KEY',        'kHud4llHaVG7sdsF9Afg5YDz50w5UKo0LMrrCSCwlqskK2XbOoWWTuMWy9dMb1NH' );
define( 'AUTH_SALT',        'otcxhl1vCBch5tX1m998pvKWiB8oVkhI75jATlpp4GZqb4aOMSmeohNlt7g0zWtg' );
define( 'SECURE_AUTH_SALT', 'G4imjRyNqTsC6g6HKxUyL0ZjG2bN8lPmlLBlWoxaMrawwrwhjikQhBCd86D4KVQf' );
define( 'LOGGED_IN_SALT',   'crMF9V2zCLt0tzRMhMxB0UmGfoIetM56tRkIK22KwHZBMb1AqFPMytgAt7mtJZVC' );
define( 'NONCE_SALT',       'VDEtJvnNbdePgqgdYS4dzNQ3YIIJ2CXSultHkdRbhtsHYhCJ6YS4cTJqy9prx7In' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
