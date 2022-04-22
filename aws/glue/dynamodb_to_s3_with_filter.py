import sys
import os
from awsglue.transforms import *
from awsglue.utils import getResolvedOptions
from pyspark.context import SparkContext
from awsglue.context import GlueContext
from awsglue.job import Job
from datetime import datetime
import boto3
from boto3.dynamodb.conditions import Attr, Key
import numpy as np
import pandas as pd
from awsglue.dynamicframe import DynamicFrame
from pyspark.sql import SQLContext


args = getResolvedOptions(sys.argv, ["JOB_NAME"])
sc = SparkContext()
glueContext = GlueContext(sc)
spark = glueContext.spark_session
job = Job(glueContext)
job.init(args["JOB_NAME"], args)
date_now = datetime.now().strftime('%Y-%m-%d')
sqlContext = SQLContext(sc)

logger = glueContext.get_logger()
logger.info("system value")
logger.info(str(os.environ))
logger.info(str(sys.argv))
table_name = 'table_name'
# Script generated for node DynamoDB table
dynamodb = boto3.resource('dynamodb')
items = []
done = False
start_key = None
table = dynamodb.Table(table_name)
kwargs = {
    "FilterExpression": Attr('column_name').begins_with(date_now)
}
while not done:
    if start_key is not None:
        kwargs['ExclusiveStartKey'] = start_key
    response = table.scan(**kwargs)
    items.extend(response.get('Items', []))
    start_key = response.get('LastEvaluatedKey', None)
    done = start_key is None
    
dataFrame = pd.DataFrame(items)
sparkFrame = sqlContext.createDataFrame(dataFrame)
DynamoDBtable_node1 = DynamicFrame.fromDF(sparkFrame, glueContext, 'DynamoDBtable_node1')

DynamoDBtable_node1 = DynamoDBtable_node1.repartition(1)
# Script generated for node S3 bucket
S3bucket_node3 = glueContext.write_dynamic_frame.from_options(
    frame=DynamoDBtable_node1,
    connection_type="s3",
    format="json",
    connection_options={
        "path": "s3://dev-hadakarte-export/export/published-content-daily/"+date_now,
        "partitionKeys": [],
    },
    transformation_ctx="S3bucket_node3",
)

job.commit()
