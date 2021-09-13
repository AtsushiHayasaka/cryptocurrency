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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6kFee9sEnMcMg8cxZzJ2JR+U6bDWfhQEP5mQhj6emUN61I/EPHpj5gi9kFrKmMOV/XiOV1JZ8fHyKeuU7C6RYQ==');
define('SECURE_AUTH_KEY',  'LIidpmlI+QTEtcfKv9tIDG1tIR+r+Ot0hin7mFllY8kXq90HFHZEcMM2UAp3w++4NDZJ+Z+pZjurhsjeTzkY0w==');
define('LOGGED_IN_KEY',    'ZUG9z1bAqoD7+8zAyqZHrzGM8bo13hB5aB6QLHcSMmCEO56DTuOXAcEXyr/d87P7Jk7IChatwy/xTMbVvuO9Hg==');
define('NONCE_KEY',        'YlP8Pd2FrGYEe7dzu4fHnfp25GgQyNNDQpYYJxHIfKyc3SPhOjNojC7oxIR0ZyFQqrOn9njyuN9dk5HM9ht8hQ==');
define('AUTH_SALT',        'vzsui85q8/mruawnBJEW5c+aDS4qf2rCQK6x/yrThXL/HLFE04+1DXGw451IJxz4o6+LPwAhMmXRJkh6GYziKA==');
define('SECURE_AUTH_SALT', 'nXCOwLHX0HW9PupR5w3FgJxC5fFbAI3ouHXGI3zx3qVnPqUrB669sWZ1TrXvPuAD5pi0z9x52HTHzTDX48vh8Q==');
define('LOGGED_IN_SALT',   'Gx1wbYWeGKxfldpVjat6GAOQ/EfGs7JYnUopUFnpYSWZ7mPD7Turx3aj3dnFEZ96QeokkILOvtdgyYoC9CzDyw==');
define('NONCE_SALT',       'sp8hSovKZOUhYGKl+PPxz1ki3qTCXzK0J/IVuTgs08un2zUrAiZwwuy1444z0FKa56hQCHJcK+fYNpmKUT9jUw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
