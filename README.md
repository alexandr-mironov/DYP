# DYP
## Dockered Yii2 + Postgres

In project used Yii2 advanced (2.0.38) template

At first, you need copy, rename and edit exists .env.sample to .env

Create docker networks:
``` 
docker network create default-network
```
Build containers (run in project folder): 
```
docker-compose up --build -d
```
