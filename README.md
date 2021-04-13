![Package Logo](social-preview.svg?raw=true "Project Logo")
# monitoring-plugins-abraflexi

Nagios/Icinga plugins for monitoring Czech Economic system AbraFlexi



There is two plugins:

  * check_abraflexi - check if AbraFlexi server is up and operational with valid License
  * check_abraflexi_webhooks - check for zero webhooks penalty


Usage
-----

    /usr/lib/nagios/plugins/check_abraflexi  -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company

Example:

    /usr/lib/nagios/plugins/check_abraflexi_webhooks -s https://demo.flexibee.eu -u winstrom -p winstrom -c demo

![Debian Configure](monitoring-plugins-abraflexi.png?raw=true "run")

Configuration
-------------


```
define command{
        command_name    check_abraflexi
        command_line    $USER1$/check_abraflexi -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company
        }
define command{
        command_name    check_abraflexi_webhooks
        command_line    $USER1$/check_abraflexi_webhooks -s https://$HOSTADDRESS$ -u USERNAME -p PASSWORD -c company
        }
```

You can also use only -f or --file switch to specify use of config file. 
Default config file location is /etc/abraflexi/client.json ( also provided by [php-abraflexi-config](https://github.com/VitexSoftware/php-abraflexi-config) debian package )

Example of [/etc/nagions/nrpe.d/abraflexi.cfg](debian/conf/abraflexi.cfg) :

```
    command[check_flexibe]=/usr/lib/nagios/plugins/check_abraflexi -f
    command[check_abraflexi_webhooks]=/usr/lib/nagios/plugins/check_abraflexi_webhooks
    command[check_abraflexi_webhook1]=/usr/lib/nagios/plugins/check_abraflexi_webhooks -w https://site.tld/webhook.php
    command[check_abraflexi_webhook2]=/usr/lib/nagios/plugins/check_abraflexi_webhooks -w https://hook.integromat.com/xxxxxxxx
```

Without -f swith the undergoing library php-abraflexi try to use Environment variables: 

**ABRAFLEXI_URL**, **ABRAFLEXI_LOGIN**, **ABRAFLEXI_PASSWORD**, **ABRAFLEXI_COMPANY**

![License Expiry](license-expiry-check.png?raw=true "License")

Debian/Ubuntu
-------------

Pro Linux jsou k dispozici .deb balíčky. Prosím použijte repo:


```shell
sudo apt install lsb-release wget
echo "deb http://repo.vitexsoftware.cz $(lsb_release -sc) main" | sudo tee /etc/apt/sources.list.d/vitexsoftware.list
sudo wget -O /etc/apt/trusted.gpg.d/vitexsoftware.gpg http://repo.vitexsoftware.cz/keyring.gpg
sudo apt update
sudo apt install monitoring-plugins-abraflexi
```

Dependencies
------------

 * https://github.com/VitexSoftware/php-ease-core
 * https://github.com/Spoje-NET/php-abraflexi

