<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileUserApiTest extends TestCase
{
    use MakeFileUserTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateFileUser()
    {
        $fileUser = $this->fakeFileUserData();
        $this->json('POST', '/api/v1/fileUsers', $fileUser);

        $this->assertApiResponse($fileUser);
    }

    /**
     * @test
     */
    public function testReadFileUser()
    {
        $fileUser = $this->makeFileUser();
        $this->json('GET', '/api/v1/fileUsers/'.$fileUser->id);

        $this->assertApiResponse($fileUser->toArray());
    }

    /**
     * @test
     */
    public function testUpdateFileUser()
    {
        $fileUser = $this->makeFileUser();
        $editedFileUser = $this->fakeFileUserData();

        $this->json('PUT', '/api/v1/fileUsers/'.$fileUser->id, $editedFileUser);

        $this->assertApiResponse($editedFileUser);
    }

    /**
     * @test
     */
    public function testDeleteFileUser()
    {
        $fileUser = $this->makeFileUser();
        $this->json('DELETE', '/api/v1/fileUsers/'.$fileUser->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/fileUsers/'.$fileUser->id);

        $this->assertResponseStatus(404);
    }
}
