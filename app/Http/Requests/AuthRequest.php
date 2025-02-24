<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class AuthRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:5'
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
