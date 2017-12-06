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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'iyy[-iu!QuPk?U[:iC6M{cY[P@pHap/bUxZPAoSiC-pyZ0<6U6,17?Sm5?`>uOb&');
define('SECURE_AUTH_KEY',  '}R}z.J+n|O9H@eyU;yL)M,~}Im4i=vS-F)*7]P2tMF:oQ<u&Z8fGf~Z|ST8}+G>s');
define('LOGGED_IN_KEY',    'Q/t%bY;@S+F0ng_QI(*Xt]Tc_68R,_;f33]I#?`&,%i6wNW;bjji9N9<2jhl3Td~');
define('NONCE_KEY',        '(?$`m{P%<HEvfDSN2n:]^guq2[ (l[sKB2XE64fS,Fq_ uULmqjuF!?l@DY+hsG4');
define('AUTH_SALT',        '1/8~6sT?RLkI]]<kVy5]9SjlJ?rI25?m5C@/u@Q[3P |#9wNST<flY#qh^@erSYz');
define('SECURE_AUTH_SALT', 'Mhqs]C20ye-IWFS{UG(cNq*mWtao6Nx*rrYSEf*X%[U2G/|rYpK4V[#k+a<C1$B8');
define('LOGGED_IN_SALT',   '$@0Z +_7?.q$?78UeGg|7Y@8`HwL14vp $Yl%*1xC@/y6Vq3pS&ZmFPXNX&6z/OZ');
define('NONCE_SALT',       'EW^4Wo?0G>nWGPP X!g73Y+;]cwwoYuEmt?3>B@3968XMYM(18+s,%Vs[#uJMet4');

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
