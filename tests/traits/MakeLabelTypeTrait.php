<?php

use Faker\Factory as Faker;
use App\Models\Superadmin\LabelType;
use App\Repositories\Superadmin\LabelTypeRepository;

trait MakeLabelTypeTrait
{
    /**
     * Create fake instance of LabelType and save it in database
     *
     * @param array $labelTypeFields
     * @return LabelType
     */
    public function makeLabelType($labelTypeFields = [])
    {
        /** @var LabelTypeRepository $labelTypeRepo */
        $labelTypeRepo = App::make(LabelTypeRepository::class);
        $theme = $this->fakeLabelTypeData($labelTypeFields);
        return $labelTypeRepo->create($theme);
    }

    /**
     * Get fake instance of LabelType
     *
     * @param array $labelTypeFields
     * @return LabelType
     */
    public function fakeLabelType($labelTypeFields = [])
    {
        return new LabelType($this->fakeLabelTypeData($labelTypeFields));
    }

    /**
     * Get fake data of LabelType
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLabelTypeData($labelTypeFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'description' => $fake->text,
            'type' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $labelTypeFields);
    }
}
