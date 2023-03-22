<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'delivery.name' => 'sometimes|required',
            'delivery.street' => 'sometimes|required',
            'delivery.phone' => 'sometimes|required',
            'delivery.city' => 'sometimes|required',
        ];
    }

    /**
     * Translate validation messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'delivery.name.required' => 'Ovo polje je obavezno',
            'delivery.street.required' => 'Ovo polje je obavezno',
            'delivery.phone.required' => 'Ovo polje je obavezno',
            'delivery.city.required' => 'Ovo polje je obavezno',
        ];
    }
}
