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
define( 'AUTH_KEY',          'v~&`-dT2,0pr~4h1%epdw1IiI}]aJnnf*[opEdpcaZu_kafi8 3aav@R]EI <e<P' );
define( 'SECURE_AUTH_KEY',   '5><@:-;By~<T/4ZbK|+S@{7),v=(*Lw6pV2oY.];PX8`:2PE]xw@/Yx!_S+sLqrI' );
define( 'LOGGED_IN_KEY',     'nX4IFN|b$<Vgk`Z{ey<?`Gw9g|0]vfbgp(n<$o!;W7O,x{x4=@s}4%lobim*[uRy' );
define( 'NONCE_KEY',         '?+hHk4_j{A2+UpGQETd3&ho[DlnQwv<o_tSKM,r_kdK{M?w>!%dm1W4$mj77&YzL' );
define( 'AUTH_SALT',         'BTvM<Z4C6WmRNLEDSQ7NhcX)@[}.Q>q8e|(k0}6?+j<@O1W*|cl-:/o=#|JmGH3!' );
define( 'SECURE_AUTH_SALT',  'Yl<97hfq6_1$!.FvUu-/j{;Fd2R8x{[(MpUlI+Z?*#RHy)0u.nvegrG;3v~!F~F0' );
define( 'LOGGED_IN_SALT',    'TJ;=oN)15*;L#c(z8I^IS`z%IZ6BDLMKom-OGSSSd`xIiWmKZ6r*sq5|XSuG$`^X' );
define( 'NONCE_SALT',        '1i:RTL{mMUyUzVkx{(QCQZY^_!hqYCJ=,}eq,(R~Yzc{rb&UHqC)7>DJvGb_e1?=' );
define( 'WP_CACHE_KEY_SALT', 'D=<Xuu229+u[<_8v}%dORw%!^_qIf4g|R9xz_p|;[WF:u>3o.BoiS>j7Z%K}NTpN' );


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
