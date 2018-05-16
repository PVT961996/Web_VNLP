<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LabelTypeApiTest extends TestCase
{
    use MakeLabelTypeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLabelType()
    {
        $labelType = $this->fakeLabelTypeData();
        $this->json('POST', '/api/v1/labelTypes', $labelType);

        $this->assertApiResponse($labelType);
    }

    /**
     * @test
     */
    public function testReadLabelType()
    {
        $labelType = $this->makeLabelType();
        $this->json('GET', '/api/v1/labelTypes/'.$labelType->id);

        $this->assertApiResponse($labelType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLabelType()
    {
        $labelType = $this->makeLabelType();
        $editedLabelType = $this->fakeLabelTypeData();

        $this->json('PUT', '/api/v1/labelTypes/'.$labelType->id, $editedLabelType);

        $this->assertApiResponse($editedLabelType);
    }

    /**
     * @test
     */
    public function testDeleteLabelType()
    {
        $labelType = $this->makeLabelType();
        $this->json('DELETE', '/api/v1/labelTypes/'.$labelType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/labelTypes/'.$labelType->id);

        $this->assertResponseStatus(404);
    }
}
