<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOfferPostAPIRequest;
use App\Http\Requests\API\UpdateOfferPostAPIRequest;
use App\Models\OfferPost;
use App\Repositories\OfferPostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class OfferPostController
 * @package App\Http\Controllers\API
 */

class OfferPostAPIController extends AppBaseController
{
    /** @var  OfferPostRepository */
    private $offerPostRepository;

    public function __construct(OfferPostRepository $offerPostRepo)
    {
        $this->offerPostRepository = $offerPostRepo;
    }

    /**
     * Display a listing of the OfferPost.
     * GET|HEAD /offerPosts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->offerPostRepository->pushCriteria(new RequestCriteria($request));
        $this->offerPostRepository->pushCriteria(new LimitOffsetCriteria($request));
        $offerPosts = $this->offerPostRepository->all();

        return $this->sendResponse($offerPosts->toArray(), 'Offer Posts retrieved successfully');
    }

    /**
     * Store a newly created OfferPost in storage.
     * POST /offerPosts
     *
     * @param CreateOfferPostAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferPostAPIRequest $request)
    {
        $input = $request->all();

        $offerPosts = $this->offerPostRepository->create($input);

        return $this->sendResponse($offerPosts->toArray(), 'Offer Post saved successfully');
    }

    /**
     * Display the specified OfferPost.
     * GET|HEAD /offerPosts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var OfferPost $offerPost */
        $offerPost = $this->offerPostRepository->findWithoutFail($id);

        if (empty($offerPost)) {
            return $this->sendError('Offer Post not found');
        }

        return $this->sendResponse($offerPost->toArray(), 'Offer Post retrieved successfully');
    }

    /**
     * Update the specified OfferPost in storage.
     * PUT/PATCH /offerPosts/{id}
     *
     * @param  int $id
     * @param UpdateOfferPostAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferPostAPIRequest $request)
    {
        $input = $request->all();

        /** @var OfferPost $offerPost */
        $offerPost = $this->offerPostRepository->findWithoutFail($id);

        if (empty($offerPost)) {
            return $this->sendError('Offer Post not found');
        }

        $offerPost = $this->offerPostRepository->update($input, $id);

        return $this->sendResponse($offerPost->toArray(), 'OfferPost updated successfully');
    }

    /**
     * Remove the specified OfferPost from storage.
     * DELETE /offerPosts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var OfferPost $offerPost */
        $offerPost = $this->offerPostRepository->findWithoutFail($id);

        if (empty($offerPost)) {
            return $this->sendError('Offer Post not found');
        }

        $offerPost->delete();

        return $this->sendResponse($id, 'Offer Post deleted successfully');
    }
}
