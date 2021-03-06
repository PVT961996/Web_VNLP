<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Requests\Superadmin\CreateCategoryDocRequest;
use App\Http\Requests\Superadmin\UpdateCategoryDocRequest;
use App\Repositories\Superadmin\CategoryDocRepository;
use App\Repositories\Superadmin\DocumentCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CategoryDocController extends AppBaseController
{
    /** @var  CategoryDocRepository */
    private $categoryDocRepository;
    private $documentCategoryRepository;

    public function __construct(CategoryDocRepository $categoryDocRepo, DocumentCategoryRepository $documentCategoryRepo)
    {
        $this->categoryDocRepository = $categoryDocRepo;
        $this->documentCategoryRepository = $documentCategoryRepo;
    }

    /**
     * Display a listing of the CategoryDoc.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoryDocRepository->pushCriteria(new RequestCriteria($request));
        $categoryDocs = $this->categoryDocRepository->all();

        return view('superadmin.category_docs.index')
            ->with('categoryDocs', $categoryDocs);
    }

    /**
     * Show the form for creating a new CategoryDoc.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categoryDocRepository->buildTreeForSelectBox(['id', 'name'], $this->SEPARATOR_SPACE, null, __('messages.select_category_document'));
        return view('superadmin.category_docs.create', compact('categories'));
    }

    /**
     * Store a newly created CategoryDoc in storage.
     *
     * @param CreateCategoryDocRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryDocRequest $request)
    {
        $input = $request->all();

        $this->categoryDocRepository->create($input);

        Flash::success(__('messages.created'));

        return redirect(route('superadmin.categoryDocs.index'));

    }

    /**
     * Display the specified CategoryDoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);

        if (empty($categoryDoc)) {
            Flash::error('Category Doc not found');

            return redirect(route('superadmin.categoryDocs.index'));
        }

        return view('superadmin.category_docs.show')->with('categoryDoc', $categoryDoc);
    }

    /**
     * Show the form for editing the specified CategoryDoc.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {

        $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);
        $categories = $this->categoryDocRepository->buildTreeForSelectBox(['id', 'name'], $this->SEPARATOR_SPACE, $id, __('messages.select_category_document'));
        if (empty($categoryDoc)) {
            Flash::error(__('messages.not-found'));

            return redirect(route('admin.categoryDocs.index'));
        }
        return view('superadmin.category_docs.edit', compact('categoryDoc', 'categories'));
    }

    /**
     * Update the specified CategoryDoc in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryDocRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryDocRequest $request)
    {
        $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);
        if (empty($categoryDoc)) {
            Flash::error(__('messages.not-found'));

            return redirect(route('superadmin.categoryDocs.index'));
        }

        $this->categoryDocRepository->update($request->all(), $id);

        Flash::success(__('messages.updated'));

        return redirect(route('superadmin.categoryDocs.index'));
    }

    /**
     * Remove the specified CategoryDoc from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        if ($id == 'MULTI') {
            if(empty($request->ids)){
                Flash::warning(__('messages.category_doc_multi_delete_no_item'));
                return redirect(route('superadmin.categoryDocs.index'));
            } else{
                $legals=[];
                $illegals=[];
                foreach ($request->ids as $id) {
                    $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);
                    if (empty($categoryDoc)) {
                        Flash::error(__('messages.not-found'));
                        return redirect(route('superadmin.categoryDocs.index'));
                    }
                    $children = $this->categoryDocRepository->findWhere([['parent_id','=',$id]],['*']);
                    $documents = $this->documentCategoryRepository->findWhere([['category_id','=',$id]],['*']);
                    if(count($children) == 0 && count($documents) == 0){
                        $legals[]=$id;
                    }else{
                        $illegals[]=$this->categoryDocRepository->findWithoutFail($id);
                    }
                }
                if(count($illegals)!=0){
                    $rs='';
                    $len = count($illegals);
                    for($i = 0 ; $i < $len ; $i++){
                        if($i != $len - 1){
                            $rs .= ' '.$illegals[$i]->name.',';
                        }else{
                            $rs .= ' '.$illegals[$i]->name;
                        }
                    }
                    $contains = __('messages.contains');
                    $messages = __('messages.undeleted');
                    Flash::error($messages.': '.$rs.' '.$contains);
                    return redirect(route('superadmin.categoryDocs.index'));
                } else {
                    foreach ($legals as $id){
                        $this->categoryDocRepository->delete($id);
                    }
                }
                Flash::success(__('messages.deleted'));
                return redirect(route('superadmin.categoryDocs.index'));
            }

        } else {
            $categoryDoc = $this->categoryDocRepository->findWithoutFail($id);
            if (empty($categoryDoc)) {
                Flash::error(__('messages.not-found'));
                return redirect(route('superadmin.categoryDocs.index'));
            }
            $children = $this->categoryDocRepository->findWhere([['parent_id','=',$id]],['*']);
            $documents = $this->documentCategoryRepository->findWhere([['category_id','=',$id]],['*']);
            if(count($children) == 0 && count($documents) == 0){
                $this->categoryDocRepository->delete($id);

                Flash::success(__('messages.deleted'));

                return redirect(route('superadmin.categoryDocs.index'));
            } else {
                Flash::error(__('messages.undeleted'));

                return redirect(route('superadmin.categoryDocs.index'));
            }
        }
    }
}
