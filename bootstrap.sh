#!/usr/bin/env bash
wget -O - http://v.s.cz/info@vitexsoftware.cz.gpg.key|sudo apt-key add -
echo deb http://v.s.cz/ stable main > /etc/apt/sources.list.d/vitexsoftware.list

export DEBIAN_FRONTEND="noninteractive"
apt-get update
apt-get install -y make build-essential fakeroot devscripts gdebi-core
apt-get install -y monitoring-plugins-abraflexi
cd /vagrant
make deb
gdebi -y ../monitoring-plugins-abraflexi_*_all.deb

/usr/lib/nagios/plugins/check_abraflexi -s https://demo.abraflexi.eu -u winstrom -p winstrom -c demo
/usr/lib/nagios/plugins/check_abraflexi_webhooks -s https://demo.abraflexi.eu -u winstrom -p winstrom -c demo
tail -f /var/log/messages 
