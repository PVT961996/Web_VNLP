<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DocumentFileApiTest extends TestCase
{
    use MakeDocumentFileTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDocumentFile()
    {
        $documentFile = $this->fakeDocumentFileData();
        $this->json('POST', '/api/v1/documentFiles', $documentFile);

        $this->assertApiResponse($documentFile);
    }

    /**
     * @test
     */
    public function testReadDocumentFile()
    {
        $documentFile = $this->makeDocumentFile();
        $this->json('GET', '/api/v1/documentFiles/'.$documentFile->id);

        $this->assertApiResponse($documentFile->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDocumentFile()
    {
        $documentFile = $this->makeDocumentFile();
        $editedDocumentFile = $this->fakeDocumentFileData();

        $this->json('PUT', '/api/v1/documentFiles/'.$documentFile->id, $editedDocumentFile);

        $this->assertApiResponse($editedDocumentFile);
    }

    /**
     * @test
     */
    public function testDeleteDocumentFile()
    {
        $documentFile = $this->makeDocumentFile();
        $this->json('DELETE', '/api/v1/documentFiles/'.$documentFile->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/documentFiles/'.$documentFile->id);

        $this->assertResponseStatus(404);
    }
}
