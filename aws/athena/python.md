# sample code for athena using python with boto3
Send query request
```
requestParams = {
    "QueryString" : query_string,
    "QueryExecutionContext" : {'Database': database_name},
    "ResultConfiguration": {'OutputLocation': s3_output_path}
}
logger.info(requestParams)
response = client.start_query_execution(**requestParams)
```
Get query result
```
import time
retries = 0
retry = True
while (retry and (retries < maxRetry)):
    try:
        queryExecution = client.get_query_execution(QueryExecutionId=input_query_id)
    except Exception as e:
        logger.error('AthenaGetQueryStatus Error : {}'.format(str(e)))

    status = queryExecution.get('QueryExecution').get('Status').get('State')

    if status in ['QUEUED', 'RUNNING', 'NOT_READY', 'THROTTLED']:
        retry = True
    else:
        retry = False
    time.sleep(15)
logger.info("AthenaGetQueryStatus end " + str(queryExecution))
return queryExecution
```
