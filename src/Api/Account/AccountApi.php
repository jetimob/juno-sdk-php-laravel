<?php

namespace Jetimob\Juno\Api\Account;

use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Contas-Digitais
 */
class AccountApi extends AbstractApi
{
    /**
     * Retorna dados da conta digital identificada por seu X-Resource-Token.
     * O id retornado é utilizado para identificação da conta no recurso de transferência.
     *
     * @link https://dev.juno.com.br/api/v2#tag/Transferencias
     * @link https://dev.juno.com.br/api/v2#operation/findDigitalAccount
     * @return FindAccountResponse
     */
    public function find(): FindAccountResponse
    {
        return $this->mappedGet('digital-accounts', FindAccountResponse::class);
    }

    /**
     * Para a criação de uma nova conta digital deve ser informado o Token Privado da Conta Digital que fará a
     * integração no parâmetro X-Resource-Token.
     *
     * As contas criadas são do tipo Payment Account e os dados retornados na criação das contas devem ser armazenados
     * para fins de manipulação da conta recém-criada.
     *
     * @param AccountDTO $account
     * @link https://dev.juno.com.br/api/v2#operation/createDigitalAccount
     * @return CreateAccountResponse
     */
    public function create(AccountDTO $account): CreateAccountResponse
    {
        return $this->mappedPost('digital-accounts', CreateAccountResponse::class, [
            RequestOptions::JSON => $account,
        ]);
    }

    /**
     * Realiza a atualização de dados de uma conta digital do tipo pagamento.
     * As seguintes informações serão atualizadas durante a requisição:
     * - Email de contato e Telefone
     * - Informações do Endereço
     * - Dados bancários
     *
     * Alguns dados não podem ser atualizados instantaneamente durante a chamada via API, pois dependem de uma análise
     * pelas áreas internas da Juno, sendo eles:
     * - Nome e data de Nascimento
     * - Dados do representante legal
     * - Razão Social
     * - Área e Linha de Negócio
     * - Tipo de Empresa
     *
     * Nossa equipe será informada sobre as alterações e irá efetivá-las em breve.
     * Os dados informados na requisição são opcionais, e só serão atualizados caso sejam enviados.
     * Caso seja criada uma conta com numeração de documento incorreto (CPF/CNPJ) é necessário criar uma nova conta.
     * Pois não é possível realizar a alteração desses dados.
     * Importante: para atualização de qualquer um dos dados que compõem o objeto dessa request, todos os dados devem
     * ser informados, caso contrário a alteração destes campos será ignorada.
     *
     * @param AccountUpdateDTO $account
     * @link https://dev.juno.com.br/api/v2#operation/updateDigitalAccount
     * @return UpdateAccountResponse
     */
    public function update(AccountUpdateDTO $account): UpdateAccountResponse
    {
        return $this->mappedPatch('digital-accounts', UpdateAccountResponse::class, [
            RequestOptions::JSON => $account,
        ]);
    }
}
