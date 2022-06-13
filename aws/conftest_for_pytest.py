# sample code for pytest
import sys
import os
# import require path
pathHandler = os.path.abspath(os.path.dirname(os.path.abspath(__file__)) + '/../')
sys.path.append(pathHandler)

import pytest
import boto3
import json
from collections import namedtuple
from moto import (
    mock_dynamodb2,
    mock_s3,
    mock_lambda,
    mock_sqs,
    mock_glue,
    mock_athena
)
import requests_mock

@pytest.fixture(scope='function')
def setEnv(monkeypatch):
    monkeypatch.setenv('BASE_PATH', os.path.dirname(os.path.abspath(__file__)) + '/../src/schema/')
    monkeypatch.setenv('GSI_USER_CODE', 'userCode-index')
    monkeypatch.setenv('GSI_COMPANY_CODE', 'companyCodeScene-index')
    monkeypatch.setenv('TEMPLATE_BUCKET', 'tests-tamplate-bucket'),
    monkeypatch.setenv('PDF_FUNCTION_NAME', 'tests-pdf-lambda'),
    monkeypatch.setenv('MAILER_FUNCTION_NAME', 'tests-mail-lambda'),
    monkeypatch.setenv('SES_SENDER', 'no-reply@aaa.com'),
    monkeypatch.setenv('PUSH_TO_SF_FUNCTION_NAME', 'tests-sf-push-lambda'),
    # monkeypatch.setenv('AWS_DEFAULT_REGION', 'us-east-1')

@pytest.fixture(scope='function')
def context():
    lambda_context = {
        'aws_request_id': None,
        'invoked_function_arn': None,
        'function_name': None,
        'memory_limit_in_mb': None
    }
    return namedtuple('LambdaContext', lambda_context.keys())(*lambda_context.values())

@pytest.fixture(scope='function')
def aws_credentials():
    os.environ['AWS_ACCESS_KEY_ID'] = 'testing'
    os.environ['AWS_SECRET_ACCESS_KEY'] = 'testing'
    os.environ['AWS_SECURITY_TOKEN'] = 'testing'
    os.environ['AWS_SESSION_TOKEN'] = 'testing'
    return

@pytest.fixture()
def dynamodbClient(aws_credentials):
    with mock_dynamodb2():
        dynamodb = boto3.resource('dynamodb')
        dynamodb.create_table(
            TableName='table_name',
            BillingMode='PAY_PER_REQUEST',
            AttributeDefinitions=[
                {'AttributeName': 'id', 'AttributeType': 'S'},
                {'AttributeName': 'column1', 'AttributeType': 'S'},
            ],
            KeySchema=[
                {'AttributeName': 'id', 'KeyType': 'HASH'},
            ],
            GlobalSecondaryIndexes=[
                {
                    'IndexName': 'index_name',
                    'KeySchema': [
                        {
                            'AttributeName': 'id',
                            'KeyType': 'RANGE'
                        },
                        {
                            'AttributeName': 'column1',
                            'KeyType': 'HASH'
                        },
                    ],
                    'Projection': {
                        'ProjectionType': 'ALL',
                    },
                },
            ],
        )
        yield dynamodb

@pytest.fixture()
def s3Client(aws_credentials):
    with mock_s3():
        s3 = boto3.client('s3',region_name='us-east-1')
        s3.create_bucket(
            Bucket= 's3_bucket_name'
        )
        yield s3

@pytest.fixture()
def requestsMock():
    with requests_mock.Mocker() as m:
        m.get('https://mock_url.com', text='mock_response_text')
        m.get('https://mock_url.com/not_found.txt', text='')
        yield m

@pytest.fixture(scope='function')
def lambdaClient(aws_credentials):
    with mock_lambda():
        yield boto3.client('lambda')

@pytest.fixture(scope='function')
def sqsClient(aws_credentials):
    with mock_sqs():
        sqs = boto3.client('sqs')
        sqs.create_queue(
            QueueName='queue_name'
        )
        yield sqs

@pytest.fixture(scope='function')
def glueClient(aws_credentials):
    with mock_glue():
        glue = boto3.client('glue')
        glue.create_database(
            DatabaseInput={
                'Name': 'glue_database_name',
                'LocationUri': 'string',
            }
        )
        yield glue

@pytest.fixture(scope='function')
def athenaClient(aws_credentials):
    with mock_athena():
        athena = boto3.client('athena')
        athena.create_data_catalog(
            Name='data_catalog_name',
            Type='LAMBDA',
        )
        yield athena
