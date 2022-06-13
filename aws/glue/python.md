# sample code for glue with python using boto3
Create table
```
params = {
    DatabaseName=database_name,
    TableInput={
        'Name': glue_table_name,
        'StorageDescriptor': {
            "Columns": [
                {
                    "Name": "column_name",
                    "Type": "string",
                    "Comment": ""
                }
            ],
            "Location": "s3:bucket_name/path_to_input_file",
            "InputFormat": "org.apache.hadoop.mapred.TextInputFormat",
            "OutputFormat": "org.apache.hadoop.hive.ql.io.HiveIgnoreKeyTextOutputFormat",
            "NumberOfBuckets": 0,
            "SerdeInfo": {
                "Name": "column_name",
                "SerializationLibrary": "org.openx.data.jsonserde.JsonSerDe",
            },
            "BucketColumns": [],
            "SortColumns": [],
            "StoredAsSubDirectories": False
        },
        'Parameters': {
            "classification": "json"
        },
    },
}
client.create_table(**params)
```
Delete table
```
client.delete_table(DatabaseName=databaseName, Name=tableName)
```
Get list of table in database
```
next_token = ""
retry = True
tables = []
while retry:
    response = client.get_tables(
        DatabaseName=database,
        NextToken=next_token
    )
    tables.extend(response.get('TableList'))
    next_token = response.get('NextToken')
    retry = next_token is not None
return tables
```
