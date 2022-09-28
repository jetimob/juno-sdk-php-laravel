# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [2.0.0-rc.8](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.7...v2.0.0-rc.8) (2022-08-30)


### ⚠ BREAKING CHANGES

* não suporta versões do PHP anteriores ao PHP 8

### Bug Fixes

* altera o tipo de dado passado para as opções do método 'mappedGet', que espera receber um array na posição query ([c5a956a](https://github.com/jetimob/juno-sdk-php-laravel/commit/c5a956a6ba63f728cf38fb1bec835d98da032e9a))
* corrige retorno do método para seguir sua interface ([4af02a2](https://github.com/jetimob/juno-sdk-php-laravel/commit/4af02a20ff431ea6f873bc6a45c4d9bf20e98d6b))


* atualizada dependências do projeto ([3255940](https://github.com/jetimob/juno-sdk-php-laravel/commit/3255940f5931b27f0995d4b02a89db8ba6dac5ea))

## [2.0.0-rc.7](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.6...v2.0.0-rc.7) (2022-04-13)


### Bug Fixes

* adiciona X-Idempotency-Key aos headers da requisição ([867345a](https://github.com/jetimob/juno-sdk-php-laravel/commit/867345ac88da6dd949a818d244c3bbb34d786355))

## [2.0.0-rc.6](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.5...v2.0.0-rc.6) (2022-04-04)

## [2.0.0-rc.5](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.4...v2.0.0-rc.5) (2022-03-29)


### ⚠ BREAKING CHANGES

* corrige entidade billing

### Bug Fixes

* corrige entidade billing ([299a904](https://github.com/jetimob/juno-sdk-php-laravel/commit/299a904fdc85e3106f55003b92e3945d2e92a138))

## [2.0.0-rc.4](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.3...v2.0.0-rc.4) (2022-03-10)


### Features

* adiciona api para pagamentos com cartão de crédito ([e6c4aac](https://github.com/jetimob/juno-sdk-php-laravel/commit/e6c4aac232b350859436e04691dfb543e98dfb1e))

## [2.0.0-rc.3](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.2...v2.0.0-rc.3) (2022-02-03)


### Features

* adiciona constante para o novo evento de pagamento `PRECONFIRMED` ([9482b3e](https://github.com/jetimob/juno-sdk-php-laravel/commit/9482b3eb783e34e2093442edf1361906edc795cc))


### Bug Fixes

* altera as propriedades de `Address` para nullable ([bf88a96](https://github.com/jetimob/juno-sdk-php-laravel/commit/bf88a964304ffb10f70ae7ff39a1dca97cbf9d53))

## [2.0.0-rc.2](https://github.com/jetimob/juno-sdk-php-laravel/compare/v2.0.0-rc.1...v2.0.0-rc.2) (2022-02-01)


### Bug Fixes

* adiciona constantes para utilizar no webhook PAYMENT_NOTIFICATION ([6c3785e](https://github.com/jetimob/juno-sdk-php-laravel/commit/6c3785e1f6a679fd510c47c0abc0ce07ef31e494))
* adiciona entidade Payer e a propriedade status `Notification/Charge` ([754c8ec](https://github.com/jetimob/juno-sdk-php-laravel/commit/754c8ec8c4d946c17e427377368c97f454ad39a5))

## [2.0.0-rc.1](https://github.com/jetimob/juno-sdk-php-laravel/compare/v1.1.2...v2.0.0-rc.1) (2021-12-01)


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
