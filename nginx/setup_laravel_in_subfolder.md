# Config nginx for laravel in sub folder in a domain 
For example: example.com/api
```
location /api {
	alias /home/example.com/public_html/api/public;
	try_files $uri $uri/ @api;

	location ~ \.php$ {
		fastcgi_split_path_info ^(.+\.php)(/.+)$;
		include /etc/nginx/fastcgi_params;
		fastcgi_param REQUEST_URI $request_uri;
		fastcgi_param SCRIPT_FILENAME $request_filename;      
		fastcgi_pass 127.0.0.1:9000; #It is config by php-fpm in your VPS
	}
}

location @api {
	rewrite /api/(.*)$ /api/index.php?/$1 last;
}
```
