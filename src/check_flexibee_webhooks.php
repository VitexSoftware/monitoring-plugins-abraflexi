#!/usr/bin/env php
<?php
/**
 * monitoring plugins for FlexiBee - Check for WebHooks penalty
 *
 * @author     Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2017 Vitex Software
 */
include_once '../vendor/autoload.php';
$result  = 'UNKNOWN';
$message = 'wtf?';

$checker   = new \MPF\Connector('hooks.json', \MPF\Connector::parseCmdline());
$hooksdata = $checker->getDataValue('hooks');

if (is_null($hooksdata)) {
    $result  = 'CRITICAL';
    $message = $checker->lastResponseCode.' '.$checker->lastCurlError.' ('.$checker->url.')';
} else {
    $result  = 'OK';
    $message = 'FlexiBee '.count($hooksdata).' hooks ('.$checker->apiURL.')';
    foreach ($hooksdata as $hookdata) {
        if (intval($hookdata['penalty'])) {
            $result  = 'WARNING';
            $message .= ' '.$hookdata['url'].' '.$hooksdata['penalty'];
        }
    }
}

\MPF\Connector::returnExitCode($result, $message);
