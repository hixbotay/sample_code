Run docker compose
```
docker compose up
```
Remove docker compose
```
docker compose down
```
Clear all container
```
docker rm $(docker stop $(docker ps -a -q))
```
Stop all container
```
docker stop $(docker ps -a -q)
```
Clear all image
```
docker rmi -f $(docker images -a -q)
```
