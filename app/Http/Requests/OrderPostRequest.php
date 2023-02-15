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
            'customer.name' => 'required',
            'customer.phone' => 'required',
            'customer.email' => 'required|email',
            'order_from' => 'required',
            'enter_date' => 'required',
            'payment' => 'required',
            'delivery' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer.name.required' => 'Ime i prezime je obavezno polje',
            'customer.phone.required' => 'Telefon je obavezno polje',
            'customer.email.required' => 'Telefon je obavezno polje',
            'order_from.required' => 'Poručeno sa je obavezno polje',
            'enter_date.required' => 'Datum poručivanja je obavezno polje',
            'payment.required' => 'Način placanja je obavezno polje',
            'delivery.required' => 'Način dostave je obavezno polje',
        ];
    }
}
