<?php

/**
 * monitoring plugins for AbraFlexi - Shared clas
 *
 * @author     Vítězslav Dvořák <info@vitexsoftware.cz>
 * @copyright  2017 Vitex Software
 */

namespace MPF;

/**
 * Description of Connector
 *
 * @author vitex
 */
class Connector extends \AbraFlexi\RW {


    /**
     * Check only this webhook
     * @var string
     */
    public $webhook = null;


    /**
     * SetUp Object to be ready for work
     *
     * @param array $options Object Options ( user,password,authSessionId
     *                                        company,url,evidence,
     *                                        prefix,defaultUrlParams,debug,
     *                                        detail,offline,filter,ignore404,nativeTypes
     *                                        timeout,companyUrl,ver,throwException
     *                                        webhook
     */
    public function setUp(/*array*/ $options = []) {
        parent::setUp($options);
        $this->setupProperty($options, 'webhook', 'ABRAFLEXI_WEBHOOK');
    }

    /**
     * Parse Commandline
     *
     * @return array
     */
    public static function parseCmdline() {
        $optionsParsed = [];
        $shortopts = "";
        $shortopts .= "s:";  // Server
        $shortopts .= "u:";  // Username
        $shortopts .= "p:";  // Password
        $shortopts .= "c:";  // Company
        $shortopts .= "f:";  // Config
        $shortopts .= "d";   // Debug
        $shortopts .= "h";   // Help
        $shortopts .= "w";   // WebHook

        $longopts = array(
            "server:", // Server
            "username:", // Username
            "password:", // Password
            "company:", // Company
            "file:", // Config file
            "debug", // Debug
            "webhook", // WebHook
            "help"
        );
        $options = getopt($shortopts, $longopts);

        if (array_key_exists('s', $options)) {
            $optionsParsed['url'] = $options['s'];
        }
        if (array_key_exists('server', $options)) {
            $optionsParsed['url'] = $options['server'];
        }
        if (array_key_exists('c', $options)) {
            $optionsParsed['company'] = $options['c'];
        }
        if (array_key_exists('company', $options)) {
            $optionsParsed['company'] = $options['company'];
        }
        if (array_key_exists('u', $options)) {
            $optionsParsed['user'] = $options['u'];
        }
        if (array_key_exists('user', $options)) {
            $optionsParsed['user'] = $options['user'];
        }

        if (array_key_exists('p', $options)) {
            $optionsParsed['password'] = $options['p'];
        }
        if (array_key_exists('password', $options)) {
            $optionsParsed['password'] = $options['password'];
        }

        if (array_key_exists('w', $options)) {
            $optionsParsed['webhook'] = $options['w'];
        }
        if (array_key_exists('webhook', $options)) {
            $optionsParsed['webhook'] = $options['webhook'];
        }

        if (array_key_exists('f', $options)) {
            $optionsParsed['config'] = $options['f'] ? $options['f'] : '/etc/abraflexi/client.json';
        }

        if (array_key_exists('file', $options)) {
            $optionsParsed['config'] = $options['file'] ? $options['file'] : '/etc/abraflexi/client.json';
        }

        if (array_key_exists('config', $optionsParsed)) {
            \Ease\Shared::instanced()->loadConfig($optionsParsed['config'], true);
        }

        if (array_key_exists('d', $options)) {
            $optionsParsed['debug'] = true;
        }
        if (array_key_exists('debug', $options)) {
            $optionsParsed['debug'] = true;
        }

        if (array_key_exists('help', $options) || array_key_exists('h', $options)) {
            echo("Usage: " . basename($_SERVER['SCRIPT_NAME']) . " -s  https://SERVER[:PORT] -u USERNAME -p PASSWORD -c COMPANY [-w WebHookURL] [-d debug]\n");
            exit;
        }

        return $optionsParsed;
    }

    /**
     * Exit with return code
     *
     * @param string $status  OK|WARNING|CRITICAL|UNKNOWN
     * @param string $message Additional message
     */
    public static function returnExitCode($status, $message = '') {
        $exitcode = 3;
        echo $status . ' - ' . $message;
        switch ($status) {
            case 'OK':
                $exitcode = 0;
                break;
            case 'WARNING':
                $exitcode = 1;
                break;
            case 'CRITICAL':
                $exitcode = 2;
                break;
            case 'UNKNOWN':
            default :
                break;
        }
        return $exitcode;
    }

}
