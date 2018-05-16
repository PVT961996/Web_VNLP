<?php

use Faker\Factory as Faker;
use App\Models\OfferPost;
use App\Repositories\OfferPostRepository;

trait MakeOfferPostTrait
{
    /**
     * Create fake instance of OfferPost and save it in database
     *
     * @param array $offerPostFields
     * @return OfferPost
     */
    public function makeOfferPost($offerPostFields = [])
    {
        /** @var OfferPostRepository $offerPostRepo */
        $offerPostRepo = App::make(OfferPostRepository::class);
        $theme = $this->fakeOfferPostData($offerPostFields);
        return $offerPostRepo->create($theme);
    }

    /**
     * Get fake instance of OfferPost
     *
     * @param array $offerPostFields
     * @return OfferPost
     */
    public function fakeOfferPost($offerPostFields = [])
    {
        return new OfferPost($this->fakeOfferPostData($offerPostFields));
    }

    /**
     * Get fake data of OfferPost
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOfferPostData($offerPostFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'short_description' => $fake->text,
            'description' => $fake->text,
            'offer_counts' => $fake->randomDigitNotNull,
            'view_counts' => $fake->randomDigitNotNull,
            'file' => $fake->word,
            'link_download' => $fake->word,
            'source' => $fake->word,
            'post_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $offerPostFields);
    }
}
