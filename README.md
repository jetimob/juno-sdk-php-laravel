juno-sdk-php-laravel
====================

juno-sdk-php-laravel foi criado e é mantido pela equipe [Jetimob](https://github.com/jetimob). É um SDK utilizado para
interagir com a API da [Juno](https://juno.com.br) de forma simples e direta. A complexidade de autenticação
[OAuth2](https://oauth.net/2/) é abstraída pelo pacote [http-php-laravel](https://github.com/jetimob/http-php-laravel/),
também desenvolvido dentro da Jetimob.

<a href="https://www.conventionalcommits.org/en/v1.0.0-beta.4"><img src="https://img.shields.io/badge/conventional%20commits-1.0.0beta.4-brightgreen.svg?style=flat-square&logo=git" alt="Regras de commit"></a>
<a href="https://packagist.org/packages/jetimob/juno-sdk-php-laravel"><img src="https://img.shields.io/packagist/dt/jetimob/juno-sdk-php-laravel?logo=packagist&logoColor=white&style=flat-square" alt="Downloads no Packagist"></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen?style=flat-square" alt="Licença"></a>
<a href="https://github.com/jetimob/juno-sdk-php-laravel/releases"><img src="https://img.shields.io/github/release/jetimob/juno-sdk-php-laravel?style=flat-square&color=brightgreen" alt="Última versão do pacote"></a>

> Os comandos abaixo devem ser executados dentro da pasta raíz do projeto onde o pacote deve ser instalado.

## Instalação

Utilizando o composer:

```shell
composer require jetimob/juno-sdk-php-laravel@v2
```

## Configuração

Para começar, as configurações do pacote devem ser publicadas através do comando:

````shell
php artisan juno:install
````

Este comando irá criar o arquivo de configuração `config/juno.php` para que você possa modificar conforme a necessidade
do seu projeto.

Algumas configurações são obrigatórias e únicas:

- resource_token
- oauth_client_id
- oauth_client_secret

## Uso

```php

```

## Licença

juno-sdk-php-laravel está licenciado sob [The MIT License (MIT)](LICENSE).

--- 
Mais informações sobre a API da Juno podem ser encontradas [aqui](https://dev.juno.com.br/api/v2) e [aqui (PDF detalhado)](https://dev.juno.com.br/junoAPI20Integration.pdf).
