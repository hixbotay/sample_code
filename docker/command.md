Build image
```
docker build -t image-name .
```
Run image
```
docker 
```
Run docker compose
```
docker compose up
```
Remove docker compose
```
docker compose down
```
Access container
```
docker ps -a
docker exec -it {workspace-container-id} bash
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
