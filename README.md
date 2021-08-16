# REST API

> Guia para aprender e compreender como funcina uma REST API utilizando PHP

## Quick Start

É necessário instalar a aplicação postman (https://www.postman.com/downloads/) para testarmos a aplicação ou usar a web app. Seja como for é necessário criar uma conta para tal.

primeiros passos através do phpmyadmin, criar uma base de dados (nome à vossa escolha) e importar o ficheiro data_base.mysql

Ao mesmo tempo é necessário alterar os dados no ficheiro de configuração /config/DataBase.php
de acordo com os vossos dados:

    #DADOS:
    private $db_name = ' O NOME DA BASE DE DADO QUE CRIARAM ';
    private $username = 'root';
    private $password = ' A VOSSA PASSWORD ';

## App Info
### GOAL

> O objectivo deste mini repo é aprender e praticar como criar uma REST API com PHP sem recorrar a uma  framework
> Modelo de programação a uma MVC
    - Pasta "models" contem os metodos com as query's à base de dados
    - Pasta "api" será semelhante á controller onde vamos ter os metodos resposáveis pelas funções CRUD da aplicação
    Não temos a pasta VIEW presente neste projeto, para isso recomemos à aplicação postman para visualizar a data.

### Author
O codigo oringal é da cortersia de Brad Traversy
[Traversy Media](http://www.traversymedia.com)

### Version
1.0.0

### License
This project is licensed under the MIT License
