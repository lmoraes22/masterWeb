# Projeto Teste Master Web
### Laravel
Dentro da pasta master-api fazer uma copia do arquivo .env.example e remover o "example" do final

Rodar os seguintes comandos dentro da pasta master-api, o projeto laravel vai rodar no endereço http://localhost:8084/
```
cd master-api/

sudo chmod 777 -Rf storage/

composer install

cd docker

docker-compose up

docker exec -it base-app php artisan migrate:refresh --seed
```
### Vue.js
Dentro da pasta master-fron fazer uma copia do arquivo .env.example e remover o "example" do final

Rodar os seguintes comandos dentro da pasta master-front
```
cd master-front/docker

docker-compose up
```
O projeto vue vai rodar no endereço http://localhost:8080/
