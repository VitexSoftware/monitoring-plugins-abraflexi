<?php
/**
 * Zaváděcí soubor pro provádění PHPUnit testů na EaseFrameworkem.
 *
 * @author     Vitex <vitex@hippy.cz>
 * @copyright  2018 Vitex@hippy.cz (G)
 */
if ((php_sapi_name() != 'cli') && (session_status() == 'PHP_SESSION_NONE')) {
    session_start();
} else {
    $_SESSION = [];
}

require __DIR__.'/../vendor/autoload.php';

define('EASE_APPNAME', 'MPF');
define('EASE_LOGGER', 'syslog');
define('ABRAFLEXI_URL', 'https://demo.abraflexi.eu');
define('ABRAFLEXI_USER', 'winstrom');
define('ABRAFLEXI_PASSWORD', 'winstrom');
define('ABRAFLEXI_COMPANY', 'demo');

global $argv;
$argv = ['s' => constant('ABRAFLEXI_URL')];

