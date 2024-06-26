#!/bin/bash

yum install snapd
systemctl enable --now snapd.socket
ln -s /var/lib/snapd/snap /snap
snap install core;snap refresh core
yum remove certbot
snap install --classic certbot
ln -s /snap/bin/certbot /usr/bin/certbot
certbot --nginx
mkdir /etc/nginx/ssl/
openssl dhparam 2048 -out /etc/nginx/ssl/dhparam.pem
cron_job='30 2 * * * certbot renew --pre-hook "service nginx stop" --post-hook "service nginx start" >> /var/log/le-renew.log'
(crontab -l | grep -F "$cron_job") && echo "Cron job already exists" && exit 0
(crontab -l; echo "$cron_job") | crontab -
echo "Finish"
