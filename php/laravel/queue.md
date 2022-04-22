# sample code for laravel queue

# Setup queue run in linux
```
sudo yum install supervisor
```
write /etc/supervisord.conf
```
[program:laravel-worker]
command=php php /path_to_artisan/artisan queue:work
process_name=%(program_name)s_%(process_num)02d
numprocs=8
priority=999
autostart=true
autorestart=true
startsecs=1
startretries=3
user=nginx
redirect_stderr=true
stdout_logfile=/path_to_root_file/storage/logs/queue.log
```
close file then run
```
sudo systemctl enable supervisord
sudo systemctl restart supervisord
```
