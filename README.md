# Introdução
Esta é uma aplicação esqueleto utilizando o framework Hyperf. 
Esta aplicação é uma Prova de Conceito (POC) destinada a ser usada como 
ponto de partida para aqueles que desejam se familiarizar com o Framework Hyperf.

# Iniciar o projeto
Para iniciar o projeto, siga estes passos:

1. Certifique-se de ter o `docker` e o `docker compose` instalado em sua máquina.
2. Clone este repositório para a sua máquina local e navegue até o diretório do projeto.
3. Execute o seguinte comando para criar o .env ```cp .env.example .env```
4. Execute o seguinte comando para iniciar o projeto:
```bash
docker compose up
```
5. Entre no container do Hyperf e rode as migrations para criar as tabelas do banco de dados:
```bash
php bin/hyperf.php migrate
```
Após o início do projeto, ele estará em execução em: http://localhost:9501.

## Estrutura do Projeto
Aqui está uma visão geral da estrutura do projeto:

- app/: Contém o código da aplicação.
- config/: Arquivos de configuração da aplicação.
- runtime/: Arquivos gerados e caches.
- bin/: Arquivos executáveis.
- docker-compose.yml: Arquivo de configuração do Docker Compose.
- Dockerfile: Dockerfile para a imagem Docker personalizada.
- composer.json: Arquivo de configuração do Composer para gerenciar dependências.

## Rotas
| Método | Rota     | Descrição                 |
|--------|-----------|-----------------------------|
| POST   | /payment  | Criar um novo pagamento.|
| GET    | /payments | Listar todos os pagamentos registrados. |
| GET    | /         | Testar funções do Hyperf.       |