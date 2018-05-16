<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OfferPostApiTest extends TestCase
{
    use MakeOfferPostTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOfferPost()
    {
        $offerPost = $this->fakeOfferPostData();
        $this->json('POST', '/api/v1/offerPosts', $offerPost);

        $this->assertApiResponse($offerPost);
    }

    /**
     * @test
     */
    public function testReadOfferPost()
    {
        $offerPost = $this->makeOfferPost();
        $this->json('GET', '/api/v1/offerPosts/'.$offerPost->id);

        $this->assertApiResponse($offerPost->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOfferPost()
    {
        $offerPost = $this->makeOfferPost();
        $editedOfferPost = $this->fakeOfferPostData();

        $this->json('PUT', '/api/v1/offerPosts/'.$offerPost->id, $editedOfferPost);

        $this->assertApiResponse($editedOfferPost);
    }

    /**
     * @test
     */
    public function testDeleteOfferPost()
    {
        $offerPost = $this->makeOfferPost();
        $this->json('DELETE', '/api/v1/offerPosts/'.$offerPost->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/offerPosts/'.$offerPost->id);

        $this->assertResponseStatus(404);
    }
}
