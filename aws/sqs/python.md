# sample code for aws sqs in python

create instance
```
import boto3
sqsClient = boto3.client('sqs')
```

send message
```
sqsMessage = {
    "MessageBody": json.dumps(data)
}
sqs = sqsClient.get_queue_by_name(QueueName='Channel_name')
sqs.send_message(**sqsMessage)
```
send list of message
```
sqs = sqsClient.get_queue_by_name(QueueName='Channel_name')
messages=[
  {
    "MessageBody": json.dumps(data1)
  },
  {
    "MessageBody": json.dumps(data2)
  }
]
i = 0
while i < len(messages):
    sqs.send_messages(Entries=messages[i:i+10])
    i += 10
```

list queue
```
sqsClient.list_queues(QueueNamePrefix='Channel_name')
```

get current queued
```
listQueue = sqsClient.receive_message(QueueUrl=sqsClient.list_queues(QueueNamePrefix='Channel_name').get('QueueUrls')[0]).get('Messages')
```
