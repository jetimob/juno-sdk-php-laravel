# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [2.0.0-alpha.6](https://github.com/jetimob/juno-sdk-php-laravel/compare/v1.1.2...v2.0.0-alpha.6) (2021-07-14)


### ⚠ BREAKING CHANGES

* diminui nível de acesso (de *public* para *protected) das propriedades DTO (`AccountDTO.php` e `AccountUpdateDTO.php`)
* `toDateString renomeado para dateToString`
* toda a api de acesso ao SDK foi redesenhada, incluindo o arquivo de configuração

### Features

* move lógica do AbstractApi para o pacote `jetimob/http-php-laravel` ([c27ba45](https://github.com/jetimob/juno-sdk-php-laravel/commit/c27ba456c1a1c16c6acfa2a704d7b4a82942a3cb))


### Bug Fixes

* adiciona `bankNumber` ao construtor estático de `BankAccount` ([8393199](https://github.com/jetimob/juno-sdk-php-laravel/commit/83931996e98faf3a1e7d9dbe51d5f48a9f1dcec1))
* adiciona interface `JsonSerializable` em objetos de requisição ([bc5dc65](https://github.com/jetimob/juno-sdk-php-laravel/commit/bc5dc6527311bbb36b3e646cd627f5d83e886421))
* refatora `setBankNumber` para aceitar nullable ([6d9ac92](https://github.com/jetimob/juno-sdk-php-laravel/commit/6d9ac921cb055d435bd15cf7905c9f76850928e5))


* implementa nova forma de interação com o SDK ([e0c67ad](https://github.com/jetimob/juno-sdk-php-laravel/commit/e0c67ad15207df939c3e9cd466ba61cd6cabdebc))
