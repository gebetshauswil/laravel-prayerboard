<?php


namespace App\Http\Requests\Api;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait BasicApiRequest
{
    /**
     * Failed validation disable redirect
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
