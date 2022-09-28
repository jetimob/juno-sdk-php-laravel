<?php

namespace Jetimob\Juno\Api\AdditionalData;

use Jetimob\Juno\Api\AbstractApi;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Dados-Adicionais
 */
class AdditionalDataApi extends AbstractApi
{
    /**
     * Utilize esse método para retornar a lista de bancos disponíveis para recebimento de transferências na Juno.
     *
     * @link https://dev.juno.com.br/api/v2#operation/getBanks
     * @return BankListResponse
     */
    public function banks(): BankListResponse
    {
        return $this->mappedGet('data/banks', BankListResponse::class);
    }

    /**
     * Utilize esse método para retornar a lista de tipos de empresas disponíveis na plataforma Juno que podem ser
     * utilizadas na criação de uma Conta Digital.
     *
     * @link https://dev.juno.com.br/api/v2#tag/Contas-Digitais
     * @link https://dev.juno.com.br/api/v2#operation/getCompanyTypes
     * @return CompanyTypesListResponse
     */
    public function companyTypes(): CompanyTypesListResponse
    {
        return $this->mappedGet('data/company-types', CompanyTypesListResponse::class);
    }

    /**
     * Traz a lista de áreas de negócios disponíveis na plataforma Juno que podem ser utilizadas na criação de uma Conta
     * Digital.
     *
     * @link https://dev.juno.com.br/api/v2#tag/Contas-Digitais
     * @link https://dev.juno.com.br/api/v2#operation/getBusinessAreas
     * @return BusinessAreasListResponse
     */
    public function businessAreas(): BusinessAreasListResponse
    {
        return $this->mappedGet('data/business-areas', BusinessAreasListResponse::class);
    }
}
