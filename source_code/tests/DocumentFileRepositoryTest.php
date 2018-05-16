<?php

use App\Models\Superadmin\DocumentFile;
use App\Repositories\Superadmin\DocumentFileRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DocumentFileRepositoryTest extends TestCase
{
    use MakeDocumentFileTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var DocumentFileRepository
     */
    protected $documentFileRepo;

    public function setUp()
    {
        parent::setUp();
        $this->documentFileRepo = App::make(DocumentFileRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDocumentFile()
    {
        $documentFile = $this->fakeDocumentFileData();
        $createdDocumentFile = $this->documentFileRepo->create($documentFile);
        $createdDocumentFile = $createdDocumentFile->toArray();
        $this->assertArrayHasKey('id', $createdDocumentFile);
        $this->assertNotNull($createdDocumentFile['id'], 'Created DocumentFile must have id specified');
        $this->assertNotNull(DocumentFile::find($createdDocumentFile['id']), 'DocumentFile with given id must be in DB');
        $this->assertModelData($documentFile, $createdDocumentFile);
    }

    /**
     * @test read
     */
    public function testReadDocumentFile()
    {
        $documentFile = $this->makeDocumentFile();
        $dbDocumentFile = $this->documentFileRepo->find($documentFile->id);
        $dbDocumentFile = $dbDocumentFile->toArray();
        $this->assertModelData($documentFile->toArray(), $dbDocumentFile);
    }

    /**
     * @test update
     */
    public function testUpdateDocumentFile()
    {
        $documentFile = $this->makeDocumentFile();
        $fakeDocumentFile = $this->fakeDocumentFileData();
        $updatedDocumentFile = $this->documentFileRepo->update($fakeDocumentFile, $documentFile->id);
        $this->assertModelData($fakeDocumentFile, $updatedDocumentFile->toArray());
        $dbDocumentFile = $this->documentFileRepo->find($documentFile->id);
        $this->assertModelData($fakeDocumentFile, $dbDocumentFile->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDocumentFile()
    {
        $documentFile = $this->makeDocumentFile();
        $resp = $this->documentFileRepo->delete($documentFile->id);
        $this->assertTrue($resp);
        $this->assertNull(DocumentFile::find($documentFile->id), 'DocumentFile should not exist in DB');
    }
}
