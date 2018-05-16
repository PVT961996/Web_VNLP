<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateOfferPostRequest;
use App\Http\Requests\Superadmin\UpdateOfferPostRequest;
use App\Repositories\SuperAdmin\OfferPostRepository;
use App\Repositories\Superadmin\DocumentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class OfferPostController extends AppBaseController
{
    /** @var  OfferPostRepository */
    private $offerPostRepository;
    private $documentRepository;

    public function __construct(OfferPostRepository $offerPostRepo, DocumentRepository $documentRepo)
    {
        $this->offerPostRepository = $offerPostRepo;
        $this->documentRepository = $documentRepo;
    }

    /**
     * Display a listing of the OfferPost.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $documents = $this->documentRepository->getAllForSelectBox(['*'],null,true);
        $searchCondition = [];
        if (!empty($search)) {
            if (!empty($search['short_description'])) {
                array_push($searchCondition, ['short_description', 'LIKE', '%' . $search['short_description'] . '%']);
            }
            if (!empty($search['source'])) {
                array_push($searchCondition, ['source', 'LIKE', '%' . $search['source'] . '%']);
            }
            $offerPosts = $this->offerPostRepository->search($searchCondition);
        }
        else {
            $offerPosts = $this->offerPostRepository->orderBy('updated_at', 'DESC')->paginate(10);
        }

        return view('superadmin.offer_posts.index',compact('documents','offerPosts'));
    }

    /**
     * Show the form for creating a new OfferPost.
     *
     * @return Response
     */
    public function create()
    {
        $documents = $this->documentRepository->getAllDocument();
        $selectedDocument = null;
        return view('superadmin.offer_posts.create', compact('documents','selectedDocument'));
    }

    /**
     * Store a newly created OfferPost in storage.
     *
     * @param CreateOfferPostRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferPostRequest $request)
    {
        $input = $request->all();
        $input["short_description"] = strip_tags($input["short_description"]);
        $input["description"] = strip_tags($input["description"]);

        $offerPost = $this->offerPostRepository->create($input);
        Flash::success(__('messages.created'));
        return redirect(route('superadmin.offerPosts.index'));
    }
    /**
     * Display the specified OfferPost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $offerPost = $this->offerPostRepository->findWithoutFail($id);

        if (empty($offerPost)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.offerPosts.index'));
        }

        return view('superadmin.offer_posts.show')->with('offerPost', $offerPost);
    }

    /**
     * Show the form for editing the specified OfferPost.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $offerPost = $this->offerPostRepository->findWithoutFail($id);
        $documents = $this->documentRepository->getAllDocument();
        $selectedDocument= $offerPost->post_id;

        if (empty($offerPost)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.offerPosts.index'));
        }

        return view('superadmin.offer_posts.edit',  compact('offerPost','selectedDocument','documents'));
    }

    /**
     * Update the specified OfferPost in storage.
     *
     * @param  int              $id
     * @param UpdateOfferPostRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferPostRequest $request)
    {
        $offerPost = $this->offerPostRepository->findWithoutFail($id);

        if (empty($offerPost)) {
            Flash::error(__('messages.not-found'));
            return redirect(route('superadmin.offerPosts.index'));
        }

        $offerPost = $this->offerPostRepository->update($request->all(), $id);
        if($request["status"] == "1"){
            $document = $this->documentRepository->findByField('id',[$offerPost->document_id],['*'])->first();
            $document->short_description = strip_tags($offerPost->short_description);
            $document->save();
        }

        Flash::success(__('messages.updated'));

        return redirect(route('superadmin.offerPosts.index'));
    }

    /**
     * Remove the specified OfferPost from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == 'MULTI') {
            if (empty($request->ids)) Flash::error(__('messages.not-found'));
            else {
                foreach ($request->ids as $id) {
                    $offerPosts = $this->offerPostRepository->findWithoutFail($id);

                    if (empty($offerPosts)) {
                        Flash::error(__('messages.not-found'));

                        return redirect(route('superadmin.offerPosts.index'));
                    }
                    $this->offerPostRepository->delete($id);
                }

                Flash::success(__('messages.deleted'));
            }
        } else {
            $offerPost = $this->offerPostRepository->findWithoutFail($id);

            if (empty($offerPost)) {
                Flash::error('messages.no-items');

                return redirect(route('superadmin.offerPosts.index'));
            }
            $this->offerPostRepository->delete($id);

            Flash::success(__('messages.deleted'));
        }
        return redirect(route('superadmin.offerPosts.index'));
    }
}
