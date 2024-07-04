# Common command in linux

Check webserver
```
netstat -tnlp | grep 80
```
set default folder when login
copy below command to last line of /home/centos/.bashrc
```
cd /path/to/folder
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
Run scrip in background
```
# All output directed to nohup.out.
nohup /home/my_user/scripts/my_script.sh &

# All output captured by logfile.
nohup /home/my_user/scripts/my_script.sh >> /home/my_user/scripts/logs/my_script.log 2>&1 &
```
Checking Background Jobs
```
jobs
```
# File
Check dir size
```
du -sh directory_name
```
Check largest files in hard disk
```
DU -HSX * | SORT -RH | HEAD -NX
```
Find 10 largest folder in folder /var
```
du -a /var | sort -n -r | head -n 10
```
Find latest php file newer than date
```
find ../public_html -type f -name "*.php" -newermt "2023-05-17"
```
Find latest file have been change within 1 days exclude cache file
```
find ./public_html/ -type f -mtime -1 -name "*.php" | grep -v cache
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
# Process
Show all process
```
ps -ef
```
Show process with filter
```
ps -ef | grep text_to_search
```
kill all nginx process
```
kill $(ps aux | grep '[n]ginx' | awk '{print $2}')
```
Extend disk
```
df -hT #to check
lsblk #show disk volumn
sudo growpart /free_disk_path 1
sudo xfs_growfs -d /
```
curl download file
```
curl https://your-domain/file.pdf --output result.tar.gz
```
# Permission
set all file chmod to 644, all dir to 755
```
chmod -R a=r,u+w,a+X /path/dir
```
Allow file excuteable
```
chmod +x my_script.sh
```
# User
List user
```
less /etc/passwd
```
Check whether a user exists in the Linux system
```
getent passwd | grep jack
```
List group
```
cat /etc/group
```
Create new user with auth by key
```
#create user folder
mkdir /user/user1
#generate rsa key
cd /user/user1
ssh-keygen -t rsa
#create user
sudo adduser -d /user/user1 -m -G [group] [user1]
# Copy the public key to the user's authorized_keys file
cat public_key.pub >> /user/user1/.ssh/authorized_keys
chmod 600 /home/demo/gozen/.ssh/authorized_keys
chown -R user1:user1 /user/user1
```
Delete user
```
userdel user_name
```

# DATABASE
Dump the database to a sql file
```
mysqldump -u root -p root_password database_name > dumpfilename.sql
```
Restore the database
```
mysql -u username -p database_name < backup_name.sql
```
Execute query
```
mysql -u username -p -D database_name -e "CREATE DATABASE database_name;"
```
# repo
Resolve error yum install in centos, update repo
```
sed -i 's/mirrorlist/#mirrorlist/g' /etc/yum.repos.d/CentOS-*
sed -i 's|#baseurl=http://mirror.centos.org|baseurl=http://vault.centos.org|g' /etc/yum.repos.d/CentOS-*
yum update -y
yum clean all
```
