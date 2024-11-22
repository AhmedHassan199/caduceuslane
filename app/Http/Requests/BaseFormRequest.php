<?php

namespace App\Http\Requests;

use App\Helpers\ApiResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        // Get validation errors
        $errors = $validator->errors();

        // Format errors in a more user-friendly way (list of field errors)
        $errorMessages = [];
        foreach ($errors->messages() as $field => $messages) {
            $errorMessages[$field] = $messages;
        }

        // Throw a custom response using ApiResponseHelper for consistency
        throw new HttpResponseException(
            ApiResponseHelper::error($errorMessages, 422)
        );
    }
}
