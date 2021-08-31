# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [2.0.0-beta.4](https://github.com/jetimob/juno-sdk-php-laravel/compare/v1.1.2...v2.0.0-beta.4) (2021-08-31)


### ⚠ BREAKING CHANGES

* diminui nível de acesso (de *public* para *protected) das propriedades DTO (`AccountDTO.php` e `AccountUpdateDTO.php`)
* `toDateString renomeado para dateToString`
* toda a api de acesso ao SDK foi redesenhada, incluindo o arquivo de configuração

### Features

* adiciona ChargeData para receber notificações do tipo CHARGE_STATUS_CHANGED ([36769d9](https://github.com/jetimob/juno-sdk-php-laravel/commit/36769d913eb46eae864f86dd8dc618033f186acd))
* adiciona mapping do objeto enviado pelo webhook gerado por CHARGE_STATUS_CHANGED ([0a8dd6c](https://github.com/jetimob/juno-sdk-php-laravel/commit/0a8dd6c6301651b45d6af6c556820abd0e2a39fc))
* move lógica do AbstractApi para o pacote `jetimob/http-php-laravel` ([c27ba45](https://github.com/jetimob/juno-sdk-php-laravel/commit/c27ba456c1a1c16c6acfa2a704d7b4a82942a3cb))
* muda endpoint de acordo com a variável ambiente ([68da080](https://github.com/jetimob/juno-sdk-php-laravel/commit/68da0807f9b73c36091b226bb4796105ea8c4575))


### Bug Fixes

* adiciona `bankNumber` ao construtor estático de `BankAccount` ([8393199](https://github.com/jetimob/juno-sdk-php-laravel/commit/83931996e98faf3a1e7d9dbe51d5f48a9f1dcec1))
* adiciona interface `JsonSerializable` em objetos de requisição ([bc5dc65](https://github.com/jetimob/juno-sdk-php-laravel/commit/bc5dc6527311bbb36b3e646cd627f5d83e886421))
* baixa versão do pacote `http-php-laravel` ([5025929](https://github.com/jetimob/juno-sdk-php-laravel/commit/50259293ac3cdaebe567c28b83da3c209f6be00b))
* corrige comando de instalação do pacote ([fc90cdd](https://github.com/jetimob/juno-sdk-php-laravel/commit/fc90cddc39f1eac4eef25938126c1fd5c9ddc43a))
* corrige retorno de vetores vazios ([25adc5d](https://github.com/jetimob/juno-sdk-php-laravel/commit/25adc5d34d307d14ca03efac536aed24ddb69548))
* refatora `setBankNumber` para aceitar nullable ([6d9ac92](https://github.com/jetimob/juno-sdk-php-laravel/commit/6d9ac921cb055d435bd15cf7905c9f76850928e5))


* implementa nova forma de interação com o SDK ([e0c67ad](https://github.com/jetimob/juno-sdk-php-laravel/commit/e0c67ad15207df939c3e9cd466ba61cd6cabdebc))
