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
define('DB_NAME', 'wordpress_training');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         ',Vwy`,b5DW-N/G|BhDN{mwag,SOCk9zI-]XSM8U_ZAAK)(u`PWa/MAW?W!g)fb+*');
define('SECURE_AUTH_KEY',  '}qhThQYyz0zJq3u*Nd:~H~&DU;rXtH85pYN8miBzIj}u5}s.}aqFTV]2@[=5aeY ');
define('LOGGED_IN_KEY',    '&P>_*uODqo<oQaJ2P4FGH0-P>~#zq7Y>~Lfw;;JC)E5j+6X&xXdGi!&ImXImXPbP');
define('NONCE_KEY',        'QsYI,?2N&0hfeV1seu[3F@][MJ%I$VN0:<_%Qn~QTa#adaQtoV0,rtP[7x-)$CW$');
define('AUTH_SALT',        'n|1iX:fuv$yB!YlT_~3%7k=aFmpD[u>JhWBKNst1xP2&@!A[R8pliAA#I#+fCTC`');
define('SECURE_AUTH_SALT', 'q;,*M/($TvA{(U3iXn.B*MSMq;~~9Blt9vq|7`lY%xmq!#:w:u`Kq-qacW{IZ}+c');
define('LOGGED_IN_SALT',   '2O:>b/T)^2y!0S3rr<@h-]j7Ld1M-wM?eJ)F;<o]m0mD/0/ ,#Rr{wZ?e4b=M?um');
define('NONCE_SALT',       'cP8HB}f:=L$. E{ Y^.M_[1R,p,]/?EJ}u*bd^KV_&Kxn#|W]^c,?wF=j,D?(M(J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp4_';

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
