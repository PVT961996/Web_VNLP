<?php

use Faker\Factory as Faker;
use App\Models\Superadmin\File;
use App\Repositories\Superadmin\FileRepository;

trait MakeFileTrait
{
    /**
     * Create fake instance of File and save it in database
     *
     * @param array $fileFields
     * @return File
     */
    public function makeFile($fileFields = [])
    {
        /** @var FileRepository $fileRepo */
        $fileRepo = App::make(FileRepository::class);
        $theme = $this->fakeFileData($fileFields);
        return $fileRepo->create($theme);
    }

    /**
     * Get fake instance of File
     *
     * @param array $fileFields
     * @return File
     */
    public function fakeFile($fileFields = [])
    {
        return new File($this->fakeFileData($fileFields));
    }

    /**
     * Get fake data of File
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFileData($fileFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'summary' => $fake->word,
            'content' => $fake->text,
            'description' => $fake->text,
            'document_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $fileFields);
    }
}
