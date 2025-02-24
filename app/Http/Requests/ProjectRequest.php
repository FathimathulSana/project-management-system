<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'project_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $firstErrorMessage = collect($validator->errors()->all())->first();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'err_msg' => $firstErrorMessage
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
