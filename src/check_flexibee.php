#!/usr/bin/env php
<?php
/**
 * monitoring plugins for FlexiBee - Basic Check
 *
 * @author     Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2017-2018 Vitex Software
 */
include_once '../vendor/autoload.php';
$result  = 'UNKNOWN';
$message = 'wtf?';

$checker  = new \MPF\Connector('/status.json', \MPF\Connector::parseCmdline());
$infodata = $checker->getDataValue('status');

if (is_null($infodata)) {
    $result  = 'CRITICAL';
    $message = $checker->lastResponseCode.' '.$checker->lastCurlError.' ('.$checker->apiURL.')';
} else {
    $result  = 'OK';
    $message = 'FlexiBee '.$infodata['version'].' ('.$checker->url.')';
}

exit(\MPF\Connector::returnExitCode($result, $message));
