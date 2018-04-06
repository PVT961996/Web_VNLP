<?php

namespace App\Http\Controllers\API\Superadmin;

use App\Http\Requests\API\Superadmin\CreateFileAPIRequest;
use App\Http\Requests\API\Superadmin\UpdateFileAPIRequest;
use App\Models\Superadmin\File;
use App\Repositories\Superadmin\FileRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class FileController
 * @package App\Http\Controllers\API\Superadmin
 */

class FileAPIController extends AppBaseController
{
    /** @var  FileRepository */
    private $fileRepository;

    public function __construct(FileRepository $fileRepo)
    {
        $this->fileRepository = $fileRepo;
    }

    /**
     * Display a listing of the File.
     * GET|HEAD /files
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->fileRepository->pushCriteria(new RequestCriteria($request));
        $this->fileRepository->pushCriteria(new LimitOffsetCriteria($request));
        $files = $this->fileRepository->all();

        return $this->sendResponse($files->toArray(), 'Files retrieved successfully');
    }

    /**
     * Store a newly created File in storage.
     * POST /files
     *
     * @param CreateFileAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateFileAPIRequest $request)
    {
        $input = $request->all();

        $files = $this->fileRepository->create($input);

        return $this->sendResponse($files->toArray(), 'File saved successfully');
    }

    /**
     * Display the specified File.
     * GET|HEAD /files/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var File $file */
        $file = $this->fileRepository->findWithoutFail($id);

        if (empty($file)) {
            return $this->sendError('File not found');
        }

        return $this->sendResponse($file->toArray(), 'File retrieved successfully');
    }

    /**
     * Update the specified File in storage.
     * PUT/PATCH /files/{id}
     *
     * @param  int $id
     * @param UpdateFileAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFileAPIRequest $request)
    {
        $input = $request->all();

        /** @var File $file */
        $file = $this->fileRepository->findWithoutFail($id);

        if (empty($file)) {
            return $this->sendError('File not found');
        }

        $file = $this->fileRepository->update($input, $id);

        return $this->sendResponse($file->toArray(), 'File updated successfully');
    }

    /**
     * Remove the specified File from storage.
     * DELETE /files/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var File $file */
        $file = $this->fileRepository->findWithoutFail($id);

        if (empty($file)) {
            return $this->sendError('File not found');
        }

        $file->delete();

        return $this->sendResponse($id, 'File deleted successfully');
    }
}
