# Sample code to install ssl
List existed ssl
```
certbot certificates
```
Add new domain
```
certbot --nginx -d example.com -d www.example.com
```
update new domain to existed domain "domain.vn"
```
certbot certonly --cert-name domain.vn -d domain.vn,www.domain.vn<<<1
```
Renew ssl
```
certbot renew --pre-hook "service nginx stop" --post-hook "service nginx start" >> /var/log/le-renew.log
```
