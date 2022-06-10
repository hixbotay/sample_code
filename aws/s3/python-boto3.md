# sample python boto3 with s3
```
client = boto3('s3')
```
List file
```
client.list_objects(Bucket=bucketName,Prefix=folder_path).get('Contents')
```
Get file object
```
client.get_object(Bucket=bucketName, Key=file_path)
```
get file content
```
client.get_object(Bucket=bucketName, Key=file_path).get('Body').read()
```
