<?php
/**
 * monitoring plugins for FlexiBee - Shared clas
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
class Connector extends \FlexiPeeHP\FlexiBeeRW
{

    /**
     * Parse Commandline
     *
     * @return array
     */
    public static function parseCmdline()
    {
        $optionsParsed = [];
        $shortopts     = "";
        $shortopts     .= "s:";  // Server
        $shortopts     .= "u:";  // Username
        $shortopts     .= "p:";  // Password
        $shortopts     .= "c:";  // Company
        $shortopts     .= "d";  // Debug

        $longopts = array(
            "server:", // Server
            "username:", // Username
            "password:", // Password
            "company:", // Company
            "debug", // Debug
        );
        $options  = getopt($shortopts, $longopts);

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

        if (array_key_exists('d', $options)) {
            $optionsParsed['debug'] = true;
        }
        if (array_key_exists('debug', $options)) {
            $optionsParsed['debug'] = true;
        }

        if (count($optionsParsed) < 4) {
            echo("Usage: ".basename($_SERVER['SCRIPT_NAME'])." -s  https://SERVER[:PORT] -u USERNAME -p PASSWORD -c COMPANY [-d debug]\n");
        }

        return $optionsParsed;
    }

    /**
     * Exit with return code
     *
     * @param string $status  OK|WARNING|CRITICAL|UNKNOWN
     * @param string $message Additional message
     */
    public static function returnExitCode($status, $message = '')
    {
        $exitcode = 3;
        echo $status.' - '.$message;
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
