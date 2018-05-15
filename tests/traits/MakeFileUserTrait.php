<?php

use Faker\Factory as Faker;
use App\Models\Superadmin\FileUser;
use App\Repositories\Superadmin\FileUserRepository;

trait MakeFileUserTrait
{
    /**
     * Create fake instance of FileUser and save it in database
     *
     * @param array $fileUserFields
     * @return FileUser
     */
    public function makeFileUser($fileUserFields = [])
    {
        /** @var FileUserRepository $fileUserRepo */
        $fileUserRepo = App::make(FileUserRepository::class);
        $theme = $this->fakeFileUserData($fileUserFields);
        return $fileUserRepo->create($theme);
    }

    /**
     * Get fake instance of FileUser
     *
     * @param array $fileUserFields
     * @return FileUser
     */
    public function fakeFileUser($fileUserFields = [])
    {
        return new FileUser($this->fakeFileUserData($fileUserFields));
    }

    /**
     * Get fake data of FileUser
     *
     * @param array $postFields
     * @return array
     */
    public function fakeFileUserData($fileUserFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'user_id' => $fake->randomDigitNotNull,
            'file_id' => $fake->randomDigitNotNull,
            'phone' => $fake->text,
            'email' => $fake->text,
            'description' => $fake->text,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $fileUserFields);
    }
}
