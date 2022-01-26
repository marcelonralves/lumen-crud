
# Lumen CRUD

API Restful feita usando o Lumen, um CRUD de usuário

# Como usar?
- Primeiro passo: Clonar o repositório
```bash
git clone https://github.com/marcelonralves/lumen-crud.git
```
- Segundo passo: Instalar as dependências
```bash
composer install
```
- Terceiro passo: Configure a sua conexão com o banco de dados no seu env e execute o comando abaixo
```bash
php artisan migrate
```
- Quarto passo: Rodar um servidor interno fornecido pelo próprio php
```bash
php -S localhost:8080 -t public
```

## Uso

```html
POST: /user -> salvar usuário 
```
Parametros: string name, string document, string email, password, int number

```html
GET: /users -> listar todos os usuários
```

```html
GET: /user/{id} -> listar usuário por id 
```
Parametro: int id

```html
PUT: /user -> atualizar algum dado do usuário
```
Parametro obrigatório: int id

Parametros aceitos: string name, string document, string email, password, int number

```html
DELETE: /user/{id} -> deletar um usuário em específico
```
Parametro: int id


## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
 vendor/bin/phpunit --testdox
```


## Melhorias

- Autenticação com passport
- Repository pattern
