<?php
/**
 * Zaváděcí soubor pro provádění PHPUnit testů na EaseFrameworkem.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2012 Vitex@hippy.cz (G)
 */

if ((php_sapi_name() != 'cli') && (session_status() == 'PHP_SESSION_NONE')) {
    session_start();
} else {
    $_SESSION = [];
}

require __DIR__.'/../vendor/autoload.php';

define('EASE_APPNAME', 'MPF');
define('EASE_LOGGER', 'syslog');
define('FLEXIBEE_SERVER', 'https://demo.flexibee.eu');
define('FLEXIBEE_USER', 'winstrom');
define('FLEXIBEE_PASSWORD', 'winstrom');
define('FLEXIBEE_COMPANY', 'demo');

global $argv;
$argv = ['s' => constant('FLEXIBEE_SERVER')];

