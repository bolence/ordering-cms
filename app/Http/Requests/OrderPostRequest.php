<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderPostRequest extends FormRequest
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
    public function rules()
    {
        return [
            'customer.name' => 'required',
            'order_from' => 'required',
            'order_date' => 'required',
            'payment_type' => 'required',
            'delivery_type' => 'required',
            'delivery_date' => 'required',

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
            'customer.name.required' => 'Ime i prezime je obavezno polje',
            'order_from.required' => 'Poručeno sa je obavezno polje',
            'order_date.required' => 'Datum poručivanja je obavezno polje',
            'payment_type.required' => 'Način plaćanja je obavezno polje',
            'delivery_type.required' => 'Način dostave je obavezno polje',
            'delivery_date.required' => 'Datum isporuke je obavezno polje'
        ];
    }
}
