<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileApiTest extends TestCase
{
    use MakeFileTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFile()
    {
        $file = $this->fakeFileData();
        $this->json('POST', '/api/v1/files', $file);

        $this->assertApiResponse($file);
    }

    /**
     * @test
     */
    public function testReadFile()
    {
        $file = $this->makeFile();
        $this->json('GET', '/api/v1/files/'.$file->id);

        $this->assertApiResponse($file->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFile()
    {
        $file = $this->makeFile();
        $editedFile = $this->fakeFileData();

        $this->json('PUT', '/api/v1/files/'.$file->id, $editedFile);

        $this->assertApiResponse($editedFile);
    }

    /**
     * @test
     */
    public function testDeleteFile()
    {
        $file = $this->makeFile();
        $this->json('DELETE', '/api/v1/files/'.$file->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/files/'.$file->id);

        $this->assertResponseStatus(404);
    }
}
