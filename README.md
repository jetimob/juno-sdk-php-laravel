juno-sdk-php-laravel
====================

# AVISO!

A carteira de clientes da Juno [foi comprada pela iugu](https://www.linkedin.com/posts/iugu_iugu-compra-carteira-de-clientes-da-juno-activity-6975170872642842624-8sZO/?utm_source=share&utm_medium=member_desktop),
e, por isso, este pacote se tornará obsoleto.

---

juno-sdk-php-laravel foi criado e é mantido pela equipe [Jetimob](https://github.com/jetimob). É um SDK utilizado para
interagir com a API da [Juno](https://juno.com.br) de forma simples e direta. A complexidade de autenticação
[OAuth2](https://oauth.net/2/) é abstraída pelo pacote [http-php-laravel](https://github.com/jetimob/http-php-laravel/),
também desenvolvido dentro da Jetimob.

<a href="https://www.conventionalcommits.org/en/v1.0.0-beta.4"><img src="https://img.shields.io/badge/conventional%20commits-1.0.0beta.4-brightgreen.svg?style=flat-square&logo=git" alt="Regras de commit"></a>
<a href="https://packagist.org/packages/jetimob/juno-sdk-php-laravel"><img src="https://img.shields.io/packagist/dt/jetimob/juno-sdk-php-laravel?logo=packagist&logoColor=white&style=flat-square" alt="Downloads no Packagist"></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen?style=flat-square" alt="Licença"></a>
<a href="https://github.com/jetimob/juno-sdk-php-laravel/releases"><img src="https://img.shields.io/github/release/jetimob/juno-sdk-php-laravel?style=flat-square&color=brightgreen" alt="Última versão do pacote"></a>

> Os comandos abaixo devem ser executados dentro da pasta raíz do projeto onde o pacote deve ser instalado.

## Versão 2.0

> ATENÇÃO!
>
> A versão `2.x` **não** é compatível com as versões inferiores!

## Instalação

Utilizando o composer:

```shell
composer require jetimob/juno-sdk-php-laravel
```

## Configuração

Para começar, as configurações do pacote devem ser publicadas através do comando:

````shell
php artisan juno:install
````

Este comando irá criar o arquivo de configuração `juno.php` no diretório `config` para que você possa modificar conforme
a necessidade do seu projeto.

As únicas configurações obrigatórias que precisam ser especificadas, são:

- resource_token
- oauth_client_id
- oauth_client_secret


> Mais informações sobre as demais configurações podem ser encontradas no próprio [arquivo](./config/juno.php).

### `resource_token`

Muitos dos recursos também necessitam de um token de recurso, *X-Resource-Token* que identifica a conta digital
que deverá ser utilizada durante a execução de uma operação. Cada conta digital tem o seu próprio token de
recurso.
Contas digitais criadas via API incluem o token de recurso na resposta da requisição. Para obter o token de
recurso de uma conta digital já existente ou para redefinir o token de recurso, o cliente precisa acessar o
painel do cliente Juno e realizar esta operação na aba Integração, opção Token Privado.

O `resource_token` é utilizado como valor padrão para o header 'X-Resource-Token' que identifica uma conta
dentro da API da Juno. Esse valor pode ser sobrescrito programaticamente utilizando o método `using` de cada API.

Ex.:

```php
Juno::balance()->using('[Novo X-Resource-Token]')->get();
```

### `oauth_client_id`

[Instruções para obtenção aqui](https://dev.juno.com.br/api/v2#operation/getAccessToken).

### `oauth_client_secret`

[Instruções para obtenção aqui](https://dev.juno.com.br/api/v2#operation/getAccessToken).

## Uso

Sempre que for chamar qualquer api do pacote **juno-sdk-php-laravel*, utilize o namespace `Jetimob\Juno\Facades\Juno`
ou, simplesmente, `Juno`. O namespace `Juno` é registrado automaticamente pelo **Laravel**, ou seja, a importação pode
ser feita apenas com `use Juno;` no topo de um arquivo.


Qualquer uma das implementações de *API* encontradas na configuração `api_impl` podem ser acessadas diretamente através
da façade `Juno`, invocando um método de mesmo nome da chave de configuração. Em outras palavras, a chave `account`, que
representa a classe `\Jetimob\Juno\Api\Account\AccountApi::class`, dentro do vetor `api_impl` do arquivo de
configurações pode ser invocada com `\Juno::account()`. O retorno desta função é uma instância de
`\Jetimob\Juno\Api\Account\AccountApi::class` (definido pelo arquivo de configuração).

## Licença

juno-sdk-php-laravel está licenciado sob [The MIT License (MIT)](LICENSE).

---
Mais informações sobre a API da Juno podem ser encontradas [aqui](https://dev.juno.com.br/api/v2) e [aqui (PDF detalhado)](https://dev.juno.com.br/junoAPI20Integration.pdf).
