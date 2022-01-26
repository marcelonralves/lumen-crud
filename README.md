
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


## Documentação da API

#### Cadastrar um usuário

```http
  POST /user
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `name` | `string` | **Obrigatório**. O nome do usuário |
| `document` | `string` | **Obrigatório**. O CPF do usuário |
| `email` | `string` | **Obrigatório**. O email do usuário |
| `password` | `string` | **Obrigatório**. A senha do usuário |
| `number` | `int` | **Obrigatório**. O número de telefone do usuário |

#### Retorna um usuário

```http
  GET /user/{id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `string` | **Obrigatório**. ID do usuário |

#### Retorna um usuário

```http
  GET /users/
```

#### Atualizar usuário

```http
  PUT /user
```
| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `id` | `int` | **Obrigatório**. o ID do usuário que deseja atualizar |
| `name` | `string` | **Opcional**. O nome do usuário |
| `document` | `string` | **Opcional**. O CPF do usuário |
| `email` | `string` | **Opcional**. O email do usuário |
| `password` | `string` | **Opcional**. A senha do usuário |
| `number` | `int` | **Opcional**. O número de telefone do usuário |

#### Deletar usuário

```http
  DELETE /user/{id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `int` | **Obrigatório**. ID do usuário que deseja apagar |


## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
 vendor/bin/phpunit --testdox
```


## Melhorias

- Autenticação com passport
- Repository pattern
