# gz
Compress
```
tar -czvf name-of-archive.tar.gz /path/to/directory-or-file
```
Compress multiple dir
```
tar -czvf archive.tar.gz /home/ubuntu/Downloads /usr/local/stuff /home/ubuntu/Documents/notes.txt
```
Compress exclude file
```
tar -czvf archive.tar.gz /home/ubuntu --exclude=/home/ubuntu/Downloads --exclude=/home/ubuntu/.cache --exclude=*.mp4
```
Extract file to current dir
```
tar -xzvf archive.tar.gz
```
Extract file to directory
```
tar -xf file_name.tar.gz -C /target/directory
```
# zip
zip file
```
zip myfile.zip /dir/name
zip -x myfile.zip /dir/name -x /dir/name/ignoreDir1/**\* /dir/name/ignoreDir2/**\* #zip with exclude files
```
unzip file
```
unzip filename.zip
unzip -P PasswOrd filename.zip
unzip -o filename.zip #force override
```
unzip to different dir
```
unzip filename.zip -d /path/to/directory
```
unzip with exclude
```
unzip filename.zip -x "*.git/*"
```
