<?php

namespace App\Http\Requests\API\Superadmin;

use App\Models\Superadmin\DocumentFile;
use InfyOm\Generator\Request\APIRequest;

class UpdateDocumentFileAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return DocumentFile::$rules;
    }
}
