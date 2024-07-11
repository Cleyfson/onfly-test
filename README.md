# onfly test

## Configuração do Ambiente de Desenvolvimento Local

## Pré-requisitos

Certifique-se de ter as seguintes ferramentas instaladas:

- [PHP](https://www.php.net/downloads.php) (v8.1 ou superior)
- [Composer](https://getcomposer.org/download/) (v2.0 ou superior)
- [MySQL](https://www.mysql.com/)

1. **Clone o Repositório:**
   ```bash
   git clone https://github.com/Cleyfson/onfly-test
   cd onfly-test
   ```

2. **Configuração do Banco de Dados:**
 
    Antes de iniciar a aplicação, é necessário configurar o banco de dados.
    
    Primeiro, copie o arquivo `env.example` para `.env`:
    ```bash
    cp env.example .env
    ```
    Em seguida, crie um banco de dados MySQL e adicione as credenciais no arquivo `.env`.

3. **Instale as Dependências back-end:**
    ```bash
    dentro de onfly-test
    composer install
    php artisan migrate
    php artisan serve
    A aplicação estará disponível em [http://localhost:8000](http://localhost:8000).

## Postman

Voce pode ter acesso aos endpoints da aplicação no postman pelo botão a seguir:

Defina o environment como test para reutilizar o token de autenticação após o login.

[<img src="https://run.pstmn.io/button.svg" alt="Run In Postman" style="width: 128px; height: 32px;">](https://god.gw.postman.com/run-collection/26530639-11cabeee-aca0-4d69-b839-abdee24ced69?action=collection%2Ffork&source=rip_markdown&collection-url=entityId%3D26530639-11cabeee-aca0-4d69-b839-abdee24ced69%26entityType%3Dcollection%26workspaceId%3Dd7914fe0-6a0e-4c18-a48b-86acca162e67)

