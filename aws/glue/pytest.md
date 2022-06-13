# sameple code for glue to test with python using pytest
Import
```
from moto import (
    mock_glue
)
```
Create mock database
```
@pytest.fixture(scope='function')
def glueClient(aws_credentials):
    with mock_glue():
        glue = boto3.client('glue')
        glue.create_database(
            DatabaseInput={
                'Name': 'Database_name',
                'LocationUri': 'string',
            }
        )
        yield glue
```
