<?php

namespace App\Http\Requests\Room;

use App\Organisation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class StoreRequest extends FormRequest
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
        return [
            'name' => ['required'],
            'capacity' => ['required', 'integer'],
            'organisation_id' => ['required', Rule::exists(Organisation::class, 'id')]
        ];
    }
}
