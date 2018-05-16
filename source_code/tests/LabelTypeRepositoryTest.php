<?php

use App\Models\Superadmin\LabelType;
use App\Repositories\Superadmin\LabelTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LabelTypeRepositoryTest extends TestCase
{
    use MakeLabelTypeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LabelTypeRepository
     */
    protected $labelTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->labelTypeRepo = App::make(LabelTypeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLabelType()
    {
        $labelType = $this->fakeLabelTypeData();
        $createdLabelType = $this->labelTypeRepo->create($labelType);
        $createdLabelType = $createdLabelType->toArray();
        $this->assertArrayHasKey('id', $createdLabelType);
        $this->assertNotNull($createdLabelType['id'], 'Created LabelType must have id specified');
        $this->assertNotNull(LabelType::find($createdLabelType['id']), 'LabelType with given id must be in DB');
        $this->assertModelData($labelType, $createdLabelType);
    }

    /**
     * @test read
     */
    public function testReadLabelType()
    {
        $labelType = $this->makeLabelType();
        $dbLabelType = $this->labelTypeRepo->find($labelType->id);
        $dbLabelType = $dbLabelType->toArray();
        $this->assertModelData($labelType->toArray(), $dbLabelType);
    }

    /**
     * @test update
     */
    public function testUpdateLabelType()
    {
        $labelType = $this->makeLabelType();
        $fakeLabelType = $this->fakeLabelTypeData();
        $updatedLabelType = $this->labelTypeRepo->update($fakeLabelType, $labelType->id);
        $this->assertModelData($fakeLabelType, $updatedLabelType->toArray());
        $dbLabelType = $this->labelTypeRepo->find($labelType->id);
        $this->assertModelData($fakeLabelType, $dbLabelType->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLabelType()
    {
        $labelType = $this->makeLabelType();
        $resp = $this->labelTypeRepo->delete($labelType->id);
        $this->assertTrue($resp);
        $this->assertNull(LabelType::find($labelType->id), 'LabelType should not exist in DB');
    }
}
