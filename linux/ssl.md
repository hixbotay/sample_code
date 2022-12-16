# Sample code to install ssl
List existed ssl
```
certbot certificates
```
Add new domain
```
certbot certonly --standalone -d www.example.com
```
Add new domain without stop nginx
> Make sure /etc/nginx/conf.d/*.conf have the block
`location ~ /.well-known {
   root /your/config/path;
   allow all;
 }`
```
sudo certbot certonly -a webroot --webroot-path=/your/config/path -d www.example.com
```
update new domain to existed domain "domain.vn"
```
certbot certonly --cert-name domain.vn -d domain.vn,www.domain.vn<<<1
```
Update new domain to one of existed domain
```
sudo certbot certonly --expand -d example.com,www.example.com
```
Delete certificate
```
certbot delete --cert-name domain.com<<<y
```
Renew ssl
```
certbot renew --pre-hook "service nginx stop" --post-hook "service nginx start" >> /var/log/le-renew.log
```
