 #Open new port to linux
```
iptables -I INPUT -p tcp -m tcp --dport 2020 -j ACCEPT
```
