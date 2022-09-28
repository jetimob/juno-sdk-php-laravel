<?php

namespace Jetimob\Juno\Api\Document;

use GuzzleHttp\RequestOptions;
use Jetimob\Juno\Api\AbstractApi;

/**
 * @link https://dev.juno.com.br/api/v2#tag/Documentos
 */
class DocumentApi extends AbstractApi
{
    /**
     * Por padrão, Contas Digitais necessitam encaminhar documentos para validação do cadastro.
     * Para consultar quais são os documentos esperados para a conta identificada por seu X-Resource-Token utilize esse
     * endpoint.
     *
     * @link https://dev.juno.com.br/api/v2#operation/getDocuments
     * @return DocumentListResponse
     */
    public function list(): DocumentListResponse
    {
        return $this->mappedGet('documents', DocumentListResponse::class);
    }

    /**
     * Contas Digitais passam por uma validação do recebimento dos documentos relacionados ao seu tipo de empresa.
     * Através desse endpoint é possível consultar o status atual dos documentos enviados.
     *
     * @param string $documentId
     * @link https://dev.juno.com.br/api/v2#operation/getDocumentsById
     * @return FindDocumentResponse
     */
    public function find(string $documentId): FindDocumentResponse
    {
        return $this->mappedGet("documents/$documentId", FindDocumentResponse::class);
    }


    /**
     * Realiza o upload de arquivos relacionados ao documento identificado por meio de seu ID específico.
     * O upload é realizado através de um 'multipart/form-data'. Um ou mais documentos podem ser enviados nesta
     * operação.
     *
     * Extensões de arquivos aceitas: pdf, doc, docx, jpg, jpeg, png, bpm, tiff.
     *
     * @param string $documentId
     * @param string[] $files <binary>
     * @return UploadDocumentResponse
     * @link https://dev.juno.com.br/api/v2#operation/uploadDocument
     */
    public function upload(string $documentId, array $files): UploadDocumentResponse
    {
        $multipartData = array_map(static fn ($fileContent) => ['name' => 'files', 'contents' => $fileContent], $files);

        return $this->mappedPost("documents/$documentId/files", UploadDocumentResponse::class, [
            RequestOptions::MULTIPART => $multipartData,
        ]);
    }
}
