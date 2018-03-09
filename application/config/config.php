<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */
define('ENVIRONMENT', 'development');

if (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do. This defines the protocol part of the URL, in older
 * versions of MINI it was 'http://' for normal HTTP and 'https://' if you have a HTTPS site for sure. Now the
 * protocol-independent '//' is used, which auto-recognized the protocol.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 * If your project runs with http and https, change to '//'
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'vehicle_request');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

/**
 * Configuration for: Cookies
 * 1209600 seconds = 2 weeks
 * COOKIE_PATH is the path the cookie is valid on, usually "/" to make it valid on the whole domain.
 * @see http://stackoverflow.com/q/9618217/1114320
 * @see php.net/manual/en/function.setcookie.php
 *
 * COOKIE_DOMAIN: The domain where the cookie is valid for. Usually this does not work with "localhost",
 * ".localhost", "127.0.0.1", or ".127.0.0.1". If so, leave it as empty string, false or null.
 * When using real domains make sure you have a dot (!) in front of the domain, like ".mydomain.com". This is
 * strange, but explained here:
 * @see http://stackoverflow.com/questions/2285010/php-setcookie-domain
 * @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
 * @see http://php.net/manual/en/function.setcookie.php#73107
 *
 * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection.
 * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
 * SESSION_RUNTIME: How long should a session cookie be valid by seconds, 604800 = 1 week.
 */
define('COOKIE_RUNTIME', 1209600);
define('COOKIE_PATH', '/');
define('COOKIE_DOMAIN', "");
define('COOKIE_SECURE', false);
define('COOKIE_HTTP', true);
define('SESSION_RUNTIME', 604800);