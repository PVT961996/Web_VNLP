<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SentenceApiTest extends TestCase
{
    use MakeSentenceTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateSentence()
    {
        $sentence = $this->fakeSentenceData();
        $this->json('POST', '/api/v1/sentences', $sentence);

        $this->assertApiResponse($sentence);
    }

    /**
     * @test
     */
    public function testReadSentence()
    {
        $sentence = $this->makeSentence();
        $this->json('GET', '/api/v1/sentences/'.$sentence->id);

        $this->assertApiResponse($sentence->toArray());
    }

    /**
     * @test
     */
    public function testUpdateSentence()
    {
        $sentence = $this->makeSentence();
        $editedSentence = $this->fakeSentenceData();

        $this->json('PUT', '/api/v1/sentences/'.$sentence->id, $editedSentence);

        $this->assertApiResponse($editedSentence);
    }

    /**
     * @test
     */
    public function testDeleteSentence()
    {
        $sentence = $this->makeSentence();
        $this->json('DELETE', '/api/v1/sentences/'.$sentence->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/sentences/'.$sentence->id);

        $this->assertResponseStatus(404);
    }
}
