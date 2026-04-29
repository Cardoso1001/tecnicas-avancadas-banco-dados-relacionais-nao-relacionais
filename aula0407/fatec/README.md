# FATEC — Sistema Acadêmico CRUD

Sistema web em PHP puro para gerenciar o banco de dados acadêmico da FATEC.

## 📁 Arquivos

```
fatec/
├── index.php     → Interface principal (SPA com sidebar + modais)
├── api.php       → Backend REST (list / create / update / delete)
├── config.php    → Configurações de conexão com o banco
└── setup.sql     → Script SQL para criar e popular o banco
```

## 🚀 Como usar

### 1. Configure o banco de dados
Execute o `setup.sql` no seu MySQL/MariaDB:
```bash
mysql -u root -p < setup.sql
```
Ou importe pelo phpMyAdmin.

### 2. Ajuste as credenciais em `config.php`
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');      // seu usuário MySQL
define('DB_PASS', '');          // sua senha MySQL
define('DB_NAME', 'fatec');
```

### 3. Coloque os arquivos no servidor
- **XAMPP/WAMP**: pasta `htdocs/fatec/`
- **LAMP**: pasta `/var/www/html/fatec/`

### 4. Acesse no navegador
```
http://localhost/fatec/
```

## ✅ Funcionalidades

| Módulo            | Listar | Criar | Editar | Excluir |
|-------------------|--------|-------|--------|---------|
| Alunos            | ✅     | ✅    | ✅     | ✅      |
| Professores       | ✅     | ✅    | ✅     | ✅      |
| Cursos            | ✅     | ✅    | ✅     | ✅      |
| Disciplinas       | ✅     | ✅    | ✅     | ✅      |
| Turmas            | ✅     | ✅    | ✅     | ✅      |
| Disc. ↔ Curso     | ✅     | ✅    | ✅     | ✅      |

## 🔒 Segurança
- Todas as queries usam **prepared statements** (sem SQL injection)
- Tabelas e ações são validadas por whitelist no backend
- Campos FK nulos são tratados corretamente
