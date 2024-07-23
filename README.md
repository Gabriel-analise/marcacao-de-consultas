# Projeto de Marcação de Consultas

Este é um projeto de marcação de consultas desenvolvido com o framework Laravel. O objetivo deste projeto é fornecer uma plataforma onde os usuários possam agendar, visualizar e gerenciar consultas médicas.

## Funcionalidades

- Cadastro e login de usuários
- Agendamento de consultas
- Visualização de consultas agendadas
- Cancelamento de consultas

## Requisitos

- PHP >= 8.1
- Composer
- MySQL
- Laravel 10.x

## Instalação

**Passo 1: Clonar o Repositório**


`git clone https://github.com/Gabriel-analise/marcacao-de-consultas`

`cd nome-do-repositorio`

**Passo 2: Instalar Dependências**

Execute o comando abaixo para instalar as dependências do projeto:

`composer install`

**Passo 3: Configurar o Arquivo .env**

Copie o arquivo `.env.example` para `.env` e atualize as informações de configuração, como a conexão com o banco de dados e as credenciais de email:

`cp .env.example .env`

**Passo 4: Gerar a Chave da Aplicação**

Gere uma chave única para a aplicação Laravel com o comando:

`php artisan key:generate`

**Passo 5: Migrar o Banco de Dados**

Execute as migrações para configurar o banco de dados:

`php artisan migrate`

**Passo 6: Servir a Aplicação**

Inicie o servidor de desenvolvimento para acessar a aplicação localmente:

`php artisan serve`

## Uso
Após seguir os passos de instalação, você pode acessar a aplicação em http://localhost:8000. Crie uma conta ou faça login para começar a marcar suas consultas.

---
Desenvolvido por [Gabriel de Faria Calisario](https://github.com/gabriel-analise)☕.
