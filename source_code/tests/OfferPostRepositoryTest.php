<?php

use App\Models\OfferPost;
use App\Repositories\OfferPostRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OfferPostRepositoryTest extends TestCase
{
    use MakeOfferPostTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OfferPostRepository
     */
    protected $offerPostRepo;

    public function setUp()
    {
        parent::setUp();
        $this->offerPostRepo = App::make(OfferPostRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOfferPost()
    {
        $offerPost = $this->fakeOfferPostData();
        $createdOfferPost = $this->offerPostRepo->create($offerPost);
        $createdOfferPost = $createdOfferPost->toArray();
        $this->assertArrayHasKey('id', $createdOfferPost);
        $this->assertNotNull($createdOfferPost['id'], 'Created OfferPost must have id specified');
        $this->assertNotNull(OfferPost::find($createdOfferPost['id']), 'OfferPost with given id must be in DB');
        $this->assertModelData($offerPost, $createdOfferPost);
    }

    /**
     * @test read
     */
    public function testReadOfferPost()
    {
        $offerPost = $this->makeOfferPost();
        $dbOfferPost = $this->offerPostRepo->find($offerPost->id);
        $dbOfferPost = $dbOfferPost->toArray();
        $this->assertModelData($offerPost->toArray(), $dbOfferPost);
    }

    /**
     * @test update
     */
    public function testUpdateOfferPost()
    {
        $offerPost = $this->makeOfferPost();
        $fakeOfferPost = $this->fakeOfferPostData();
        $updatedOfferPost = $this->offerPostRepo->update($fakeOfferPost, $offerPost->id);
        $this->assertModelData($fakeOfferPost, $updatedOfferPost->toArray());
        $dbOfferPost = $this->offerPostRepo->find($offerPost->id);
        $this->assertModelData($fakeOfferPost, $dbOfferPost->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOfferPost()
    {
        $offerPost = $this->makeOfferPost();
        $resp = $this->offerPostRepo->delete($offerPost->id);
        $this->assertTrue($resp);
        $this->assertNull(OfferPost::find($offerPost->id), 'OfferPost should not exist in DB');
    }
}
