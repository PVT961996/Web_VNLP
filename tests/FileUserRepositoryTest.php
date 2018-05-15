<?php

use App\Models\Superadmin\FileUser;
use App\Repositories\Superadmin\FileUserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileUserRepositoryTest extends TestCase
{
    use MakeFileUserTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FileUserRepository
     */
    protected $fileUserRepo;

    public function setUp()
    {
        parent::setUp();
        $this->fileUserRepo = App::make(FileUserRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFileUser()
    {
        $fileUser = $this->fakeFileUserData();
        $createdFileUser = $this->fileUserRepo->create($fileUser);
        $createdFileUser = $createdFileUser->toArray();
        $this->assertArrayHasKey('id', $createdFileUser);
        $this->assertNotNull($createdFileUser['id'], 'Created FileUser must have id specified');
        $this->assertNotNull(FileUser::find($createdFileUser['id']), 'FileUser with given id must be in DB');
        $this->assertModelData($fileUser, $createdFileUser);
    }

    /**
     * @test read
     */
    public function testReadFileUser()
    {
        $fileUser = $this->makeFileUser();
        $dbFileUser = $this->fileUserRepo->find($fileUser->id);
        $dbFileUser = $dbFileUser->toArray();
        $this->assertModelData($fileUser->toArray(), $dbFileUser);
    }

    /**
     * @test update
     */
    public function testUpdateFileUser()
    {
        $fileUser = $this->makeFileUser();
        $fakeFileUser = $this->fakeFileUserData();
        $updatedFileUser = $this->fileUserRepo->update($fakeFileUser, $fileUser->id);
        $this->assertModelData($fakeFileUser, $updatedFileUser->toArray());
        $dbFileUser = $this->fileUserRepo->find($fileUser->id);
        $this->assertModelData($fakeFileUser, $dbFileUser->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFileUser()
    {
        $fileUser = $this->makeFileUser();
        $resp = $this->fileUserRepo->delete($fileUser->id);
        $this->assertTrue($resp);
        $this->assertNull(FileUser::find($fileUser->id), 'FileUser should not exist in DB');
    }
}
