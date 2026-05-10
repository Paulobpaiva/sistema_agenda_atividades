# Sistema de Agendamento - Calendário de Atividades

Sistema web desenvolvido em Laravel para gerenciamento de atividades em formato de calendário mensal, com controle de usuários, login, perfis de acesso e área administrativa de segurança.

## 📌 Funcionalidades

- Login e logout de usuários
- Controle de acesso por autenticação
- Perfil de usuário:
  - Administrador
  - Usuário comum
- Gerenciamento completo de usuários
  - Criar usuário
  - Editar usuário
  - Alterar senha
  - Ativar/desativar usuário
  - Excluir usuário
- Proteção para impedir acesso não autorizado à área de segurança
- Calendário mensal de atividades
- Filtro por mês, ano e colaborador
- Cadastro de atividades
- Exclusão de atividades
- Interface simples e responsiva

## 🛠️ Tecnologias utilizadas

- PHP 8.3
- Laravel 13
- Composer
- SQLite
- Blade
- HTML
- CSS
- JavaScript
- WSL / Ubuntu

## 📂 Estrutura principal do projeto

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── CalendarioAtividadesController.php
│   │   └── UsuarioController.php
│   └── Middleware/
│       ├── AdminMiddleware.php
│       └── UsuarioAtivoMiddleware.php
├── Models/
│   ├── Atividade.php
│   ├── Colaborador.php
│   └── User.php

database/
├── migrations/
├── seeders/
│   └── DatabaseSeeder.php
└── database.sqlite

resources/
└── views/
    ├── auth/
    │   └── login.blade.php
    ├── calendario/
    │   └── index.blade.php
    ├── layouts/
    │   └── seguranca.blade.php
    └── seguranca/
        └── usuarios/
            ├── index.blade.php
            ├── create.blade.php
            └── edit.blade.php

routes/
└── web.php
````

## ⚙️ Requisitos

Antes de rodar o projeto, tenha instalado:

* PHP 8.3 ou superior
* Composer
* SQLite
* Extensões PHP necessárias:

  * mbstring
  * xml
  * dom
  * curl
  * zip
  * sqlite3

No Ubuntu/WSL, você pode instalar com:

```bash
sudo apt update
sudo apt install php8.3-cli php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-sqlite3 unzip curl git -y
```

## 🚀 Como instalar o projeto

Clone o repositório:

```bash
git clone https://github.com/seu-usuario/seu-repositorio.git
```

Entre na pasta do projeto:

```bash
cd sistema_agendamento
```

Instale as dependências:

```bash
composer install
```

Copie o arquivo de ambiente:

```bash
cp .env.example .env
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

Crie o banco SQLite:

```bash
touch database/database.sqlite
```

No arquivo `.env`, confira se está assim:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/caminho/completo/para/seu/projeto/database/database.sqlite
```

Exemplo no WSL:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/home/paulo_paiva/sistema_agendamento/database/database.sqlite
```

Rode as migrations e os seeders:

```bash
php artisan migrate:fresh --seed
```

Limpe o cache:

```bash
php artisan optimize:clear
```

Inicie o servidor:

```bash
php artisan serve --port=8001
```

Acesse no navegador:

```text
http://127.0.0.1:8001
```

## 🔐 Usuário administrador inicial

O sistema cria automaticamente um usuário administrador inicial pelo Seeder:

```text
E-mail: admin@sistema.com
Senha: 12345678
```

Após o primeiro acesso, é recomendado alterar a senha na área de segurança.

## 🧭 Rotas principais

| Rota                       | Descrição                 |
| -------------------------- | ------------------------- |
| `/login`                   | Tela de login             |
| `/`                        | Calendário de atividades  |
| `/seguranca/usuarios`      | Gerenciamento de usuários |
| `/seguranca/usuarios/novo` | Cadastro de novo usuário  |

## 👤 Perfis de acesso

### Administrador

Pode acessar:

* Calendário
* Cadastro de atividades
* Área de segurança
* Gerenciamento de usuários
* Ativar/desativar usuários
* Alterar senhas
* Excluir usuários

### Usuário comum

Pode acessar:

* Calendário
* Cadastro e visualização de atividades

Não pode acessar a área de segurança.

## 📅 Calendário de atividades

A tela principal permite:

* Visualizar atividades por mês e ano
* Filtrar por colaborador
* Cadastrar nova atividade
* Selecionar data clicando no dia do calendário
* Excluir atividades cadastradas

## 🧪 Comandos úteis

Rodar servidor:

```bash
php artisan serve --port=8001
```

Limpar cache:

```bash
php artisan optimize:clear
```

Rodar migrations:

```bash
php artisan migrate
```

Recriar banco e popular dados iniciais:

```bash
php artisan migrate:fresh --seed
```

Atualizar autoload do Composer:

```bash
composer dump-autoload
```

## 🧱 Models principais

### User

Responsável pelos usuários do sistema.

Campos principais:

* name
* email
* password
* perfil
* ativo

### Colaborador

Responsável pelos colaboradores que podem receber atividades.

Campos principais:

* nome

### Atividade

Responsável pelas atividades cadastradas no calendário.

Campos principais:

* colaborador_id
* data
* titulo
* descricao

## 🔒 Segurança implementada

O projeto possui:

* Senhas criptografadas com hash
* Proteção de rotas com middleware `auth`
* Middleware para verificar se o usuário está ativo
* Middleware para restringir área administrativa
* Logout com invalidação de sessão
* Proteção contra exclusão ou desativação do próprio usuário
* Proteção contra exclusão/desativação do último administrador ativo

## 🖥️ Abrindo no Visual Studio Code pelo WSL

Dentro da pasta do projeto, rode:

```bash
code .
```

O VS Code deve abrir conectado ao WSL.

## 📌 Status do projeto

Projeto em desenvolvimento.

Funcionalidades já implementadas:

* Login
* Logout
* Calendário
* Atividades
* Colaboradores
* Gerenciamento de usuários
* Controle de perfil
* Controle de usuário ativo/inativo

## 👨‍💻 Autor

Desenvolvido por Paulo Paiva.
