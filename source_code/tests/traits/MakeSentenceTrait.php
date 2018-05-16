<?php

use Faker\Factory as Faker;
use App\Models\Superadmin\Sentence;
use App\Repositories\Superadmin\SentenceRepository;

trait MakeSentenceTrait
{
    /**
     * Create fake instance of Sentence and save it in database
     *
     * @param array $sentenceFields
     * @return Sentence
     */
    public function makeSentence($sentenceFields = [])
    {
        /** @var SentenceRepository $sentenceRepo */
        $sentenceRepo = App::make(SentenceRepository::class);
        $theme = $this->fakeSentenceData($sentenceFields);
        return $sentenceRepo->create($theme);
    }

    /**
     * Get fake instance of Sentence
     *
     * @param array $sentenceFields
     * @return Sentence
     */
    public function fakeSentence($sentenceFields = [])
    {
        return new Sentence($this->fakeSentenceData($sentenceFields));
    }

    /**
     * Get fake data of Sentence
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSentenceData($sentenceFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'content' => $fake->text,
            'file_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $sentenceFields);
    }
}
