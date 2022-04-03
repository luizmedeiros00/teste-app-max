

## Teste Controle de Estoque

Este projeto consiste em sistema para controle de estoque

- Listagem de produtos
- Cadastro de produtos
- Edição de produtos
- Adição/Remoção de produtos no estoque
- Relatório de movimentações e produtos com estoque baixo


## Tecnologias Utilizadas

- PHP 7.4 ou superior
- Laravel 8
- Postgres 13

## Começando

Clone o repositório

    git clone https://github.com/luizmedeiros00/teste-app-max.git

Acesse a pasta do projeto

    cd teste-app-max

Instale as dependências com o composer

    composer install

Copie o arquivo .env.example e faça as configurações necessárias

    cp .env.example .env 

Configure as seguintes variáveis
```dotenv
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```


Gere a nova application key

    php artisan key:generate

Gere a nova secret key JWT authentication

    php artisan jwt:generate

Execute as migrations e a seeder

    php artisan migrate --seed

Inicie o servidor de desenvolvimento local

    php artisan serve

Você consegue acessar o projeto em http://localhost:8000

### Autenticação

email: teste@email.com
password: teste123

## Api

Inicie o servidor de desenvolvimento local

    php artisan serve


#### Login
POST http://localhost:8000/api/login
```json
{
  "email": "teste@email.com",
  "password": "teste123"
}
```
#### Adicionar produto
POST http://localhost:8000/api/adicionar-produto
```json
{
  "product_id": "integer",
  "amount": "integer"
}
```

#### Remover produto
POST http://localhost:8000/api/remover-produto
```json
{
  "product_id": "integer",
  "amount": "integer"
}
```

#### Request headers

| **Required** 	| **Key**              	| **Value** |
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes 	    | Authorization    	| Bearer {JWT Token}|


## Testes automatizados

Execute o comando para rodar os testes

    php artisan test

## Docker

Para instalar com [Docker](https://www.docker.com), execute os seguintes comando:

```
git clone https://github.com/luizmedeiros00/teste-app-max.git
cd teste-app-max
cp .env.example.docker .env
docker-compose up -d
docker exec -it app-max bash
composer install
php artisan migrate:fresh --seed
php artisan key:generate
php artisan jwt:token
```
app rodando na porta 8000
bando de dados postgres rodando na porta 5432