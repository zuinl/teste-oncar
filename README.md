# Teste OnCar - Desenvolvedor Full Stack PHP

Repositório disponibilizado para confirmar participação do teste/desafio técnico da OnCar.

## Instruções
Basta clonar ou baixar o repositório, rodar no servidor Apache de sua preferência e criar a base de dados usando o arquivo .sql também disponível no repositório.

## Backend
O backend foi feito em PHP como uma API que recebe métodos POST, GET, PUT e DELETE para CRUD básico de veículos. Testes foram realizados usando o Postman.

* **POST**: salva um novo veículo
* **GET**: se usado sem o parâmetro "id" retorna todos os veículos. Com o parâmetro "id" retorna o veiculo correspondente. Também aceita o parâmetro "search" que busca os veículos 
correspondentes ao modelo ou marca pesquisada
* **PUT**: atualiza o veículo correspondente
* **DELETE**: deleta o veículo correspondente

## Frontend
Foi feito o uso de Bootstrap 4 para mais agilidade na produção, e um pouco de CSS personalizado para ajustes adicionais. O arquivo index.js é o responsável por realizar as requisições para 
a API.

