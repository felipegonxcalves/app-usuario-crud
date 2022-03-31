# app-usuario-crud

Banco de dados utilizado: Mysql
Framework: Laravel 5.5

1 - passo (Clonar o repositorio):
git clone https://github.com/felipegonxcalves/app-usuario-crud


2 - passo(Baixar as dependências):
composer update


3 - passo(Criar Database, dentro do seu Banco Local Crie um novo Database):
CREATE DATABASE app_usuario

4 - passo(Abrir o arquivo .env e setar suas credencias do DB):
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app_usuario
DB_USERNAME=root
DB_PASSWORD=sua_senha


5 - passo(Criar tabelas no Database, atraves das migrations):
php artisan migrate


6 - passo(Gerar chave APP_KEY):
php artisan key:generate


7 - passo(Na raiz do projeto, rodar o servidor de desenvolvimento da aplicação e acessar a url dada após esse comando ):
php artisan serve




