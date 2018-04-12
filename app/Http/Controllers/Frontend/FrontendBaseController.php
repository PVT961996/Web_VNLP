<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Superadmin\DocumentRepository;

class FrontendBaseController extends Controller
{
    protected $SEPARATOR_SPACE = '&nbsp;&nbsp;&nbsp;&nbsp;';

    protected $documentRepository;

    public function __construct(DocumentRepository $documentRepo)
    {
        $this->documentRepository = $documentRepo;

    }

    public function getDocuments(){
        $documents = $this->documentRepository->orderBy('updated_at', 'DESC')->paginate(10);
        return $documents;
    }

    // TODO: Thực thi nghiệp vụ xử lý trả về kết quả của các phần chung.

}
