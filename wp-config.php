<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u0971471_gamemoneyBD');

/** MySQL database username */
define('DB_USER', 'u0971471_gamemUS');

/** MySQL database password */
define('DB_PASSWORD', 'boomaSG31');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'zzo94zzql4iz7tiv2hhbljv2egk5m8nnpfvct3vwnz4sadqx821ncha72wrpib4e');
define('SECURE_AUTH_KEY',  'xttciv4wnaerzopyergkuywmiuighih0dtoetstveu1ql32k8rs6kvmtki574sj4');
define('LOGGED_IN_KEY',    'y4q6xekkyg38jjkgwhlrl9bujtsyihbeczurkwbvstzetldvnbidujjwnfi3a8zx');
define('NONCE_KEY',        'jubkpvuscsbzolrzym8f4obpheaw3q6tuj6e1ojvh2xeculk9atc4jepzcolxgpf');
define('AUTH_SALT',        'cllgfwx2qtefqxe3gjhbh4ldagcw2o8ycel6mkicy0wrexp0bkcqcjcg10ahmdxr');
define('SECURE_AUTH_SALT', 'tm5nleruqmbqjpqdymryvvrc5mdfu1webyuj8bopgwehvo0r3aqsszk4hss5ouvd');
define('LOGGED_IN_SALT',   '8ypwnaz92gu7wyc6gnwtuqq3cgkm0swcr4w9gdbddlxe5rvvnlfcuf8od736bg43');
define('NONCE_SALT',       'hl2l1vpqlalmsjpl1yybcsphphsgre3vn9rtqvbcwfxlaiq4vonx6wjuk4nv9e7a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');