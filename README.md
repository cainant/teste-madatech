# Teste Tecnico Madatech

Para rodar a aplicação basta executar no terminal
``` bash
docker compose up
```
Após o container estar rodando, execute o comandos abaixos para configurar os pacotes e rodar as migrations (necessário para execução do programa)
``` bash
docker exec -it teste_cainan_app composer update
docker exec -it teste_cainan_app php spark migrate
```
Substitua "teste_cainan_app" por outro nome do container caso não tenha sido criado com esse.

Para acessar a aplicação navegue para [localhost:8080/tasks](http://localhost:8080/tasks).
Uma instância do phpMyAdmin está disponível em [phpMyAdmin](http://localhost:8081) para visualizar o MySQL, acesse com login *admin* e senha *123*.

Também foi fornecido com um arquivo de documentação para a API em formato de Postman chamado ***REST_API_Teste_Madatech.postman_collection.json***.
Os endpoints da API são
- [GET]     /api/tasks
- [POST]    /api/tasks/create
- [PUT]     /api/tasks/edit/{id}
- [DELETE]  /api/tasks/delete/{id}