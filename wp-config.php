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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'wj:YQ#G1>H:*!KwOVZ#*=t$:BVi2TCgR>ZyJ`{DqoiM+jPq9j|wc*9iaIRj iQ /' );
define( 'SECURE_AUTH_KEY',   'ZqikL9sTT#9}_*N[;)n>!bGh/7),w*2Sjmm:t)3=:C4sW=r9`9,`Lr<c8dZV:gug' );
define( 'LOGGED_IN_KEY',     ':08Z?k/D9fp0fMtiE%FO^.4 whUx1:27>TLz4PbIt)1JlDnK~Y61U@tSsv.d =YY' );
define( 'NONCE_KEY',         ')ed~An=2U$3?CuMcCR3}0m%L0pRDdR5gRb[._:A5,}[]Rcb&T~G}cNAHz{gb.~Z~' );
define( 'AUTH_SALT',         'b9oe(mv42I{=u$b!_&J>)H@Y6pC}#k/2a0=K!/RB{VUd_gt-$_OaDjg^`V}42ZCx' );
define( 'SECURE_AUTH_SALT',  '+o#vA-N_kE!cg~-z_DE*!WS?c8 /.ID.FGSZ/P^!1Ku:PQTrH/>w:@3XtX|ZBaHu' );
define( 'LOGGED_IN_SALT',    'q5{wclmP}s<Bx3kB,O/Vb2hS`7=Yvev+GI(]#rr;1jbwpa7LFNt`?2IjZ-9XLBrT' );
define( 'NONCE_SALT',        'JZCi$D^lQYHO3MS6wr*un+KcXc3lCG48Ct3iISQF452kQWIEm@uXj]vu=13GZuY%' );
define( 'WP_CACHE_KEY_SALT', '[mXYmH7Z_;B~R1#E 6h&#`|H*@= EoN/;aUaPCRmLdQGj)*E{1msXIk~)yCTkS{)' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
