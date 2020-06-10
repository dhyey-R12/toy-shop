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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'toy_shop' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ')}Q[mb%8S{ 8<i]e]4|3}WD-:296y=o=QX4O{b(^4)8.r;E*m7/!EOzIvB*7,G0g' );
define( 'SECURE_AUTH_KEY',  'b)?[Ia{{rBE]&M0|CMR5,`iEGgi[6}HQ:d2kuFE$b<^9xT-9eY(UJEjgT{=YUQ&w' );
define( 'LOGGED_IN_KEY',    'k+@pT$2WBx]t#+fO-yB72%+W)e {N_{  N9E%YFh1*]}O)S8G+.~;:n13}EdJ}LK' );
define( 'NONCE_KEY',        ',GQ~5CtQ{+0D X?|uN*1ftwL]dSNe<bO}bd2(B~CkJ9B]Ao:+K%$jIEA^7Cg*8Z;' );
define( 'AUTH_SALT',        '7eo#bWFO+zIIO/gxF^so41;>KXUw#^k;cd{4Dt2WDs7+Y5`BI&IkFR1H>bsF]Xxs' );
define( 'SECURE_AUTH_SALT', 'Z!g{@;~<CYvc6xp)t9i]PbRHmoLmX9#!@P$,;{T3T*5Grs?H++&.Yl3|_=Fngk{I' );
define( 'LOGGED_IN_SALT',   ':ic:praVpo;|MvOSr}E}2HF=R[m=kuOL.6x6*O%3`iz4rT@|WELPDTh7{a$L%3KV' );
define( 'NONCE_SALT',       'q*ZRtHb}N:W_EMALN0h,;IiOh~zAY[)~miNb0r}S@vW5z7#F,f#UDJV<Gc]I(Sd6' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
