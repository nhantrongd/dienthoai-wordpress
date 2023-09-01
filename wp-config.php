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
define( 'DB_NAME', 'w_iphone' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'j^Cm7?QEGB3KbeS}9tY?y@ok/v)rNJC9IE:au_Q3`F2ZV|I/4Qm1ZHE`83#jjv~,' );
define( 'SECURE_AUTH_KEY',  '}#uuF]l8?AilIC!3s,VWmZG/aO@~f(H1Jc?oV@(0,*SUf:DtY|xFO`imdESa]Z{M' );
define( 'LOGGED_IN_KEY',    'P:VfW:`dW5Is[?]hj0YZ??5eR~/9;d Jq0:0HR #(5?i;)6B(-%Gn%Hv(}2O6 TE' );
define( 'NONCE_KEY',        'cb]!t_LX@w1>[BR8f7CCB0J{)794y0:ghZ W>Ovi+bE8017SX^Hg2o5H<:ht7MT5' );
define( 'AUTH_SALT',        '_9SZJE{y=!|>FT`i-+G6CeUY7f2y`[)~bUiV@:$Rt6xb^A[?+uc@~V*H*MjeEDB-' );
define( 'SECURE_AUTH_SALT', 'Ob56)ClU*TPz^O>@fi/)Fm<~|C2.0|3Opf9 {($&]&~8lqBk)|zkZ$K2F2;=JIkr' );
define( 'LOGGED_IN_SALT',   'k>p!LdQz>*w8*Ja?atY2[ZFC-45Fo*.#HwR4m4]t0ymIx.m^nihlP$ 016KTf,,g' );
define( 'NONCE_SALT',       'nv=s+4JL98bCsr)ggzb(W?p;%WG{}CQZ^Q9Q]buwIs.NJy0I?;]MG1G U`HO|3CD' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'p_iphone';

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
