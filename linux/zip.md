 # Sample command to work with compress in linux


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
