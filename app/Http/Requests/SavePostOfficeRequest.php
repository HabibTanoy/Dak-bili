<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SavePostOfficeRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name'      =>  'required',
            'code'     =>  'required|unique:post_offices,code',
            'images'    =>  'required|array',
            'images.0.file'  =>  'required|file',
            'images.0.distance'=>   'required',
            'images.1.file'  =>  'required|file',
            'images.1.distance'=>   'required',
            'images.2.file'  =>  'required|file',
            'images.2.distance'=>   'required',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'    => 403,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ],403));
    }
}
