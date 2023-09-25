# Astro System

Um sistema de gerenciamento de restaurantes simples, eficiente e prático.

### Sumário
- [Configuração](https://github.com/i3elj/astro_system/#configuração)
  - [Dependências](https://github.com/i3elj/astro_system/#dependências)
  - [Rodando o projeto](https://github.com/i3elj/astro_system/#rodando-o-projeto)


## Configuração
### Dependências
Tenha certeza de ter o [PHP](https://www.php.net/) instalado junto do driver para o banco de dados. PostgreSQL para desenvolver no backend e SQLite para quem desenvolve no frontend. Para usuários do Windows recomendo instalar o [XAMPP](https://www.apachefriends.org/pt_br/index.html)
### Rodando o projeto
Para rodar o projeto localmente basta seguir os seguintes passos, o mais importante é que nãoo há diferenças entre as plataformas:
* Clonar o repositório, lembrando que vai depender da branch na qual você for trabalhar:
   ```bash
   git clone https://github.com/i3elj/astro_system
   ```
* Dentro da pasta do projeto, clone o arquivo `.env.example`:
   ```bash
   cp .env.example .env
   ```
* Rode as migrations:
   ```bash
   php migrations/postgres/run.php
   # ou
   php migrations/sqlite/run.php
   ```
* Agora basta rodar o servidor:
   ```bash
   ./run
   ```

Se você fez tudo certinho nenhum erro deve ter aparecido, agora basta ir para `localhost:3000/` que você já poderá contribuir para o projeto.
