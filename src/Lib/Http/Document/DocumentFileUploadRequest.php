<?php

namespace Jetimob\Juno\Lib\Http\Document;

use Jetimob\Juno\Lib\Http\BodyType;
use Jetimob\Juno\Lib\Http\Method;
use Jetimob\Juno\Lib\Http\Request;

/**
 * Class DocumentUploadRequest
 * - Uploads a file related to a document;
 * - Document is a kind of slot where files are attached to;
 * - The first step is to get the available documents to be able to upload the files to the correct "slot".
 * @package Jetimob\Juno\Lib\Http\Document
 * @see https://dev.juno.com.br/api/v2#operation/uploadDocument
 */
class DocumentFileUploadRequest extends Request
{
    /** @var string $bodyType set to 'multipart' instructs Guzzle to use multipart/form-data */
    protected string $bodyType = BodyType::MULTIPART;

    public string $id;

    /** @var array $files array of binary contents! Accepted file types: pdf, doc, docx, jpg, jpeg, png, bpm, tiff. */
    public array $files = [];

    protected array $bodySchema = ['files'];

    /**
     * @inheritDoc
     */
    protected function method(): string
    {
        return Method::POST;
    }

    /**
     * @inheritDoc
     */
    protected function urn(): string
    {
        return 'documents/{id}/files';
    }

    /**
     * multipart override
     * @return array
     */
    public function build(): array
    {
        $data = [];

        foreach ($this->files as $file) {
            $data[] = [
                'name' => 'files',
                'contents' => $file,
            ];
        }

        return $data;
    }
}
