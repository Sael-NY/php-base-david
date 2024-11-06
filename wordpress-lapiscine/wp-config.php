<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_piscine' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'i2Z3,1IHLnJac}`TV>.kX5A1KHmI!&jVv#*q7kmRjNV$V^3&HFU_.RI4xd`EZ6.~' );
define( 'SECURE_AUTH_KEY',  'b:n?EI8fr`BT}0;`ut(%JH,NdQSurr%t/tRAbM%&6z#){_yu;m=09*UsHDF/_y&)' );
define( 'LOGGED_IN_KEY',    'OPog0T%YFg@1Q3oJQcPLo66x$R-Kk{e35/`j|0s:$Of^9%y-P3wmKnr>8riX;/_]' );
define( 'NONCE_KEY',        '~}4B8k8juNB-bx}+ {!5fF/@r]$I-?)QDTPqD>XUT]{}$p-`:-:r_=CFY%!<u>^l' );
define( 'AUTH_SALT',        'gr$$6Nw;7y2(&hr4jMl~~?NJ<Z/hjLKXsc/2cmN@FC%KLJ#zBz})&|Q=pwa^Zu^[' );
define( 'SECURE_AUTH_SALT', '+rbjcFIqi9h ($.4>k@@zs^Gm&e%?w(D+q+&-$clT!{7)fp%Yauc19QyVU[G)LI5' );
define( 'LOGGED_IN_SALT',   '<=QWE8O0ymxq2 9vb9 rWM1|OVxJwa,@XOq0lWS/??{5S{rdUC3?}]d?UpYBl3 g' );
define( 'NONCE_SALT',       'fs2xV+n$tlK5lQfWV[z$3wEAHP_VvnVhRp1APte=Xp<3z-H( oyI3YvWwUDB,:gY' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
