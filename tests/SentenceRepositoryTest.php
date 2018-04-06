<?php

use App\Models\Superadmin\Sentence;
use App\Repositories\Superadmin\SentenceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SentenceRepositoryTest extends TestCase
{
    use MakeSentenceTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var SentenceRepository
     */
    protected $sentenceRepo;

    public function setUp()
    {
        parent::setUp();
        $this->sentenceRepo = App::make(SentenceRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateSentence()
    {
        $sentence = $this->fakeSentenceData();
        $createdSentence = $this->sentenceRepo->create($sentence);
        $createdSentence = $createdSentence->toArray();
        $this->assertArrayHasKey('id', $createdSentence);
        $this->assertNotNull($createdSentence['id'], 'Created Sentence must have id specified');
        $this->assertNotNull(Sentence::find($createdSentence['id']), 'Sentence with given id must be in DB');
        $this->assertModelData($sentence, $createdSentence);
    }

    /**
     * @test read
     */
    public function testReadSentence()
    {
        $sentence = $this->makeSentence();
        $dbSentence = $this->sentenceRepo->find($sentence->id);
        $dbSentence = $dbSentence->toArray();
        $this->assertModelData($sentence->toArray(), $dbSentence);
    }

    /**
     * @test update
     */
    public function testUpdateSentence()
    {
        $sentence = $this->makeSentence();
        $fakeSentence = $this->fakeSentenceData();
        $updatedSentence = $this->sentenceRepo->update($fakeSentence, $sentence->id);
        $this->assertModelData($fakeSentence, $updatedSentence->toArray());
        $dbSentence = $this->sentenceRepo->find($sentence->id);
        $this->assertModelData($fakeSentence, $dbSentence->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteSentence()
    {
        $sentence = $this->makeSentence();
        $resp = $this->sentenceRepo->delete($sentence->id);
        $this->assertTrue($resp);
        $this->assertNull(Sentence::find($sentence->id), 'Sentence should not exist in DB');
    }
}
