<?php

use Faker\Factory as Faker;
use App\Models\Superadmin\DocumentFile;
use App\Repositories\Superadmin\DocumentFileRepository;

trait MakeDocumentFileTrait
{
    /**
     * Create fake instance of DocumentFile and save it in database
     *
     * @param array $documentFileFields
     * @return DocumentFile
     */
    public function makeDocumentFile($documentFileFields = [])
    {
        /** @var DocumentFileRepository $documentFileRepo */
        $documentFileRepo = App::make(DocumentFileRepository::class);
        $theme = $this->fakeDocumentFileData($documentFileFields);
        return $documentFileRepo->create($theme);
    }

    /**
     * Get fake instance of DocumentFile
     *
     * @param array $documentFileFields
     * @return DocumentFile
     */
    public function fakeDocumentFile($documentFileFields = [])
    {
        return new DocumentFile($this->fakeDocumentFileData($documentFileFields));
    }

    /**
     * Get fake data of DocumentFile
     *
     * @param array $postFields
     * @return array
     */
    public function fakeDocumentFileData($documentFileFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'file_id' => $fake->randomDigitNotNull,
            'document_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $documentFileFields);
    }
}
