# Sistema de agendamento de provas

O projeto visa substituir o atual sistema de agendamento de provas usado pelo IFF Bom Jesus do Itabapoana.

## Índice

- [Sobre](#sobre)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instalação](#instalação)
- [Execução](#execução)
- [Módulos](#módulos)
- [Licença](#licença)

## Sobre

O sistema deve ser capaz de permitir a criação e manutenção de professores, salas, disciplinas, turmas e cursos, bem como a criação e listagem de agendamentos de provas.
A criação de salas, disciplinas, professores, turmas e cursos deve ser feitas por um usuário com permissões para administrador, enquando os agendamentos de prova só podem ser cadastrados por um usuário do tipo 'professor'. Os usuários do tipo 'aluno' só tem acesso à vizualização das provas agendadas.

## Tecnologias Utilizadas

Liste as tecnologias, linguagens de programação e ferramentas que você usou para desenvolver o projeto. Por exemplo:

- Linguagem: PHP e Javasscript.
- Frameworks: Laravel.
- Banco de dados: MySQL.

## Instalação

Instruções sobre como instalar e configurar o projeto localmente. Por exemplo:

Instale o Larvel 11 em seu pc:

https://dev.to/jsandaruwan/-installing-laravel-11-a-step-by-step-guide-2mkj

Importe o projeto pelo VSCode com o link:

https://github.com/Yan-Balbi/Sistema-de-Agendamento-de-Provas.git


```bash

# Clone o repositório
git clone https://github.com/usuario/nome-do-repositorio.git

# Navegue até o diretório do projeto
cd Agendamento

# Instale as dependências
composer install
```

## Execução

```bash

#Execute o migate para criar o BD:
php artisan migrate

#Inicialize o servidor de desenvolvimento:
php artisan serve

#Acesse a aplicção pela URL:
http://127.0.0.1:8000/

#Cadastre um usuário como register:
#Acesse sua conta pelo login
```

## Módulos

* Módulo de agendamentos - Yan Balbi
  - Salas
  - Horários de provas
  - Datas de provas
