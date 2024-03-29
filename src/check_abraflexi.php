<?php

/**
 * monitoring plugins for AbraFlexi - Basic Check - accessibility & license
 *
 * @author     Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2017-2018 Vitex Software
 */
include_once '../vendor/autoload.php';

define('EASE_APPNAME', 'check_abraflexi');
define('EASE_LOGGER', 'syslog');

$result = 'UNKNOWN';
$message = 'wtf?';

$checker = new \MPF\Connector('/status.json', \MPF\Connector::parseCmdline());
$infodata = $checker->getDataValue('status');

if (is_null($infodata)) {
    $result = 'CRITICAL';
    $message = $checker->lastResponseCode . ' ' . $checker->lastCurlError;
} else {
    $licensedataRaw = $checker->getFlexiData('/default-license');
    $licensedata = $licensedataRaw['license'];
    $licenseExpire = new DateTime(array_key_exists('validTo',$licensedata) ? $licensedata['validTo'] : 'next year');
    $diff = intval($licenseExpire->diff(new DateTime())->format("%a"));
    if ($diff < 7) {
        if ($diff < 0) {
            $result = 'ERROR';
            $message = 'AbraFlexi ' . $infodata['version'] . ' License Expired';
        } else {
            $result = 'WARNING';
            $message = 'AbraFlexi ' . $infodata['version'] . ' License Expire in ' . $diff . ' days';
        }
    } else {
        $result = 'OK';
        $message = 'AbraFlexi ' . $infodata['version'];
    }
}

exit(\MPF\Connector::returnExitCode($result, $message . ' (' . $checker->url . ')'));
