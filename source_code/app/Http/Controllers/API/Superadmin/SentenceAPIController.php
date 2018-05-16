<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateSentenceAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateSentenceAPIRequest;
use App\Models\Superadmin\Sentence;
use App\Repositories\Superadmin\SentenceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SentenceController
 * @package App\Http\Controllers\API\Superadmin
 */

class SentenceAPIController extends AppBaseController
{
    /** @var  SentenceRepository */
    private $sentenceRepository;

    public function __construct(SentenceRepository $sentenceRepo)
    {
        $this->sentenceRepository = $sentenceRepo;
    }

    /**
     * Display a listing of the Sentence.
     * GET|HEAD /sentences
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sentenceRepository->pushCriteria(new RequestCriteria($request));
        $this->sentenceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sentences = $this->sentenceRepository->all();

        return $this->sendResponse($sentences->toArray(), 'Sentences retrieved successfully');
    }

    /**
     * Store a newly created Sentence in storage.
     * POST /sentences
     *
     * @param CreateSentenceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSentenceAPIRequest $request)
    {
        $input = $request->all();

        $sentences = $this->sentenceRepository->create($input);

        return $this->sendResponse($sentences->toArray(), 'Sentence saved successfully');
    }

    /**
     * Display the specified Sentence.
     * GET|HEAD /sentences/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Sentence $sentence */
        $sentence = $this->sentenceRepository->findWithoutFail($id);

        if (empty($sentence)) {
            return $this->sendError('Sentence not found');
        }

        return $this->sendResponse($sentence->toArray(), 'Sentence retrieved successfully');
    }

    /**
     * Update the specified Sentence in storage.
     * PUT/PATCH /sentences/{id}
     *
     * @param  int $id
     * @param UpdateSentenceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSentenceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Sentence $sentence */
        $sentence = $this->sentenceRepository->findWithoutFail($id);

        if (empty($sentence)) {
            return $this->sendError('Sentence not found');
        }

        $sentence = $this->sentenceRepository->update($input, $id);

        return $this->sendResponse($sentence->toArray(), 'Sentence updated successfully');
    }

    /**
     * Remove the specified Sentence from storage.
     * DELETE /sentences/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Sentence $sentence */
        $sentence = $this->sentenceRepository->findWithoutFail($id);

        if (empty($sentence)) {
            return $this->sendError('Sentence not found');
        }

        $sentence->delete();

        return $this->sendResponse($id, 'Sentence deleted successfully');
    }
}
