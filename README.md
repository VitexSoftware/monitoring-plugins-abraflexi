# monitoring-plugins-flexibee

Nagios/Icinga plugins for monitoring Czech Economic system FlexiBee

![Screenshot](https://raw.githubusercontent.com/VitexSoftware/monitoring-plugins-flexibee/master/icinga-flexibee-check.png "run")


There is two plugins:

  * check_flexibee - check if FlexiBee server is up and operational
  * check_flexibee_webhooks - check for zero webhooks penalty

Usage
-----

    /usr/lib/nagios/plugins/check_flexibee  -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company

Example:

    /usr/lib/nagios/plugins/check_flexibee_webhooks -s https://demo.flexibee.eu -u winstrom -p winstrom -c demo

![Debian Configure](https://raw.githubusercontent.com/VitexSoftware/monitoring-plugins-flexibee/master/monitoring-plugins-flexibee.png "run")

You can also use only -f or --file switch to specify use of config file. 
Default config file location is /etc/flexibee/client.json ( also provided by [php-flexibee-config](https://github.com/VitexSoftware/php-flexibee-config) debian package )

Example of [/etc/nagions/nrpe.d/nagios.cfg](debian/config/nagios.cfg) :

    command[check_flexibe]=/usr/lib/nagios/plugins/check_flexibee -f
    command[check_flexibee_webhooks]=/usr/lib/nagios/plugins/check_flexibee_webhooks -f



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

