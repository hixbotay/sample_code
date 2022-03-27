# Common command in linux

set default folder when login
copy below command to last line of /home/centos/.bashrc
```
cd /home/pay.sellonboard.com/public_html
```
Crontab
```
crontab -e
0 1 * * * /usr/bin/php /home/license.sellonboard.com/public_html/billing/cli/sendmail.php
```
disable SELinux to folder
```
chcon -Rt httpd_sys_content_t /path/to/www
```
#File
Check largest files in hard disk
```
DU -HSX * | SORT -RH | HEAD -NX
```
Find 10 largest folder in folder /var
```
du -a /var | sort -n -r | head -n 10
```
Delete file content
```
> file_name.txt
```
Find text in a folder
```
grep -rnw '/path/to/dir' -e 'text_to_search'
```
Copy file overide if exist
```
\cp -r /path/copy/file /path/target
```
or
```
yes | cp -r /path/copy/file /path/target
```
Delete log File
```
for i in /var/log/*; do cat /dev/null > $i; done
find /var/log/nginx -type f -regex ".*\.gz$" -delete
```
Delete nginx log
```
function delnginxlogs() {
  echo "--------------- ⏲  Clearing logs... ---------------"

  # Clear logs.
  for i in /var/log/nginx/*; do cat /dev/null > $i; done

  echo "--------------- ⏲  Deleting .gz log files... ---------------"

  # Delete .gz files.
  find /var/log/nginx -type f -regex ".*\.gz$" -delete

  echo "--------------- DONE: NGINX logs cleared ... ---------------"
}
```
Extend disk
```
df -hT #to check
lsblk #show disk volumn
sudo growpart /free_disk_path 1
sudo xfs_growfs -d /
```
