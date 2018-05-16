<?php

use App\Models\Superadmin\File;
use App\Repositories\Superadmin\FileRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FileRepositoryTest extends TestCase
{
    use MakeFileTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var FileRepository
     */
    protected $fileRepo;

    public function setUp()
    {
        parent::setUp();
        $this->fileRepo = App::make(FileRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateFile()
    {
        $file = $this->fakeFileData();
        $createdFile = $this->fileRepo->create($file);
        $createdFile = $createdFile->toArray();
        $this->assertArrayHasKey('id', $createdFile);
        $this->assertNotNull($createdFile['id'], 'Created File must have id specified');
        $this->assertNotNull(File::find($createdFile['id']), 'File with given id must be in DB');
        $this->assertModelData($file, $createdFile);
    }

    /**
     * @test read
     */
    public function testReadFile()
    {
        $file = $this->makeFile();
        $dbFile = $this->fileRepo->find($file->id);
        $dbFile = $dbFile->toArray();
        $this->assertModelData($file->toArray(), $dbFile);
    }

    /**
     * @test update
     */
    public function testUpdateFile()
    {
        $file = $this->makeFile();
        $fakeFile = $this->fakeFileData();
        $updatedFile = $this->fileRepo->update($fakeFile, $file->id);
        $this->assertModelData($fakeFile, $updatedFile->toArray());
        $dbFile = $this->fileRepo->find($file->id);
        $this->assertModelData($fakeFile, $dbFile->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteFile()
    {
        $file = $this->makeFile();
        $resp = $this->fileRepo->delete($file->id);
        $this->assertTrue($resp);
        $this->assertNull(File::find($file->id), 'File should not exist in DB');
    }
}
