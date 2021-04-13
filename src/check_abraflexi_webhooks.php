<?php

/**
 * monitoring plugins for AbraFlexi - Check for WebHooks penalty
 *
 * @author     Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2017-2021 Vitex Software
 */
include_once '../vendor/autoload.php';

define('EASE_APPNAME', 'check_abraflexi_webhooks');
define('EASE_LOGGER', 'syslog');

$result = 'UNKNOWN';
$message = 'wtf?';

$checker = new \MPF\Connector('hooks.json', \MPF\Connector::parseCmdline());
$hooksdata = $checker->getDataValue('hooks');

if (is_null($hooksdata)) {
    $result = 'CRITICAL';
    $message = $checker->lastResponseCode . ' ' . $checker->lastCurlError . ' (' . $checker->url . ')';
} else {
    $result = 'OK';
    if (count($hooksdata)) {
        $message = count($hooksdata) . ' hook' . ( count($hooksdata) > 1 ? 's' : '' ) . ' found; ';
        foreach ($hooksdata as $hookdata) {
            if (empty($checker->webhook) || ($checker->webhook == $hookdata['url'])) {
                $message .= ' ' . $hookdata['url'] . ' lastVersion: ' . $hookdata['lastVersion'];
                if (intval($hookdata['penalty'])) {
                    $result = 'ERROR';
                    $message .= ' penalty: ' . $hookdata['penalty'] . ' lastPenalty: ' . $hookdata['lastPenalty'];
                }
            }
        }
    } else {
        $result = 'WARNING';
        $message .= ' No Hooks defined! ';
    }
    $message .= ' (' . $checker->getApiURL() . '/hooks)';
}

exit(\MPF\Connector::returnExitCode($result, $message));
