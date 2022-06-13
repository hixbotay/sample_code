# sample code for glue with python using boto3
Create table
```
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
