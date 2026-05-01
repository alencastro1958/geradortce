# Gerador de TCEs

Sistema web (SaaS) para administração e geração automatizada de documentos de estágio, incluindo Termo de Compromisso de Estágio (TCE), Relatórios Semestrais, Certificados de Conclusão e Termos de Convênio.

## Funcionalidades

- **Geração Automatizada de Documentos**: TCE, Relatórios Semestrais, Certificados de Conclusão, Termos de Convênio
- **Cadastro Centralizado**: Estagiários, Empresas Concedentes, Instituições de Ensino (IES), Seguradoras, Supervisores
- **Consulta Automática de CNPJ**: Integração com API pública (BrasilAPI/ReceitaWS) com exceção para CNPJ específico
- **Assinatura Digital**: Integração com API da Autentique para assinatura eletrônica
- **Sistema de Vagas**: Portal de oportunidades de estágio com candidatura online
- **Gestão de Permissões**: ACL com múltiplos perfis (Administrador Master, Assistentes, Empresa, IES, Estagiário)

## Stack Tecnológico

- **Backend**: Laravel 13 (PHP 8.3+)
- **Frontend**: Blade Templates + Tailwind CSS + Alpine.js
- **Geração de Documentos**: PHPWord e barryvdh/laravel-dompdf
- **Permissões**: Spatie Laravel Permission
- **Banco de Dados**: MySQL

## Instalação

```bash
# Instalar dependências
composer install

# Criar arquivo .env
cp .env.example .env

# Gerar chave da aplicação
php artisan key:generate

# Executar migrações
php artisan migrate

# Instalar dependências frontend
npm install
npm run build
```

## Executar o Projeto

```bash
# Modo desenvolvimento (com servidor, filas e Vite)
composer run dev

# Ou manualmente
php artisan serve
npm run dev
```

## Estrutura de Entidades

- **Users**: Autenticação e papéis
- **InstituicaoEnsino**: Dados da IES, Responsável Legal
- **EmpresaConcedente**: Dados da empresa, Supervisores
- **Estagiario**: Dados pessoais, acadêmicos
- **Seguradora**: Dados das apólices de seguro
- **Estagio**: O TCE conectando todas as entidades
- **Documento**: Rastreamento de documentos gerados
- **Vaga**: Oportunidades de estágio
- **Candidatura**: Candidatos às vagas

## Rotas Principais

- `/` - Página inicial
- `/dashboard` - Dashboard autenticado
- `/instituicoes` - CRUD Instituições de Ensino
- `/empresas` - CRUD Empresas Concedentes
- `/estagiarios` - CRUD Estagiários
- `/seguradoras` - CRUD Seguradoras
- `/estagios` - CRUD TCEs
- `/estagios/{id}/gerar-documento` - Geração de documento
- `/vagas` - Gestão de vagas
- `/api/consultar-cnpj` - API de consulta CNPJ

## Licença

MIT