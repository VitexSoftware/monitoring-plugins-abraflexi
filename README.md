# monitoring-plugins-flexibee

Nagios/Icinga plugins for monitoring Czech Economic system FlexiBee

Usage
-----

    /usr/lib/nagios/plugins/check_flexibee  -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company

Example:

    /usr/lib/nagios/plugins/check_flexibee_webhooks -s https://demo.flexibee.eu -u winstrom -p winstrom -c demo


Configuration
-------------

```
define command{
        command_name    check_flexibee
        command_line    $USER1$/check_flexibee -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company
        }
define command{
        command_name    check_flexibee_webhooks
        command_line    $USER1$/check_flexibee_webhooks -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company
        }
```

Debian/Ubuntu
-------------

Pro Linux jsou k dispozici .deb balíčky. Prosím použijte repo:

    wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key|sudo apt-key add -
    echo deb http://v.s.cz/ stable main > /etc/apt/sources.list.d/ease.list
    aptitude update
    aptitude install monitoring-plugins-flexibee


Dependencies
------------

https://github.com/Spoje-NET/FlexiPeeHP

