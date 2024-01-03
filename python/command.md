# sample code in python
# array
filter array from array of object
```
items = [{'id':'1'},{'id':'2','test':1},{'id':'2','test':0}]
items = [d for d in items if d['id'] == '2']
```

get first element with condition from array of object with default if no record found
```
items = [{'id':'1'},{'id':'2','test':1},{'id':'2','test':0}]
item = next((d for d in items if d['id'] == '2'),{})
```
# string
Print x string before number
```
x = '{:x>8}'.format(number)
```
# get console ouput from function
```
import sys
import io

backup = sys.stdout
sys.stdout = io.StringIO()     # capture output
to_do_function()
out = sys.stdout.getvalue() # release output

sys.stdout.close()  # close the stream 
sys.stdout = backup # restore original stdout
```
