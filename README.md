# Account API

Sistema de gerenciamento de contas bancárias, desenvolvido em PHP.

## 🎯 Visão Geral

Account API é uma aplicação que implementa operações básicas de gerenciamento de contas bancárias, 
como depósitos, saques e transferências. A aplicação é construída utilizando PHP 8.5.

## 📋 Requisitos

- Git
- Docker
- Docker Compose

## 🚀 Instalação e Execução Local

### 1. Clonar o repositório

```bash
git clone git@github.com:MarlonRaphael/account-api.git
cd account-api
```

### 2. Instalar dependências

```bash
docker run --rm -v $(pwd):/app -w /app composer install
```

### 3. Rodar o projeto

```bash
./vendor/bin/sail up -d
```
