<?php

namespace App\Classes;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ApiFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {

        $response = new JsonResponse(
            [
                'title' => '¡Whoops! Algo salió mal',
                'data' => $validator->errors(),
            ],
            400
        );

        throw new HttpResponseException($response);
    }
}
