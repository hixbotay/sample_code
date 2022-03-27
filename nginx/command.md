# Common command and config for nginx
config sub url
```
location /sub_url_path/ {
  try_files $uri $uri/ /path/to/folder/index.php?$args;
}
```
