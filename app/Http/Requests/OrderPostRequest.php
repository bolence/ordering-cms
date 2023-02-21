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
            'order_date' => 'required',
            'payment' => 'required',
            'delivery_type' => 'required',
            'price' => 'required',
            'order_number' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer.name.required' => 'Ime i prezime je obavezno polje',
            'customer.phone.required' => 'Telefon je obavezno polje',
            'customer.email.required' => 'Telefon je obavezno polje',
            'order_from.required' => 'Poručeno sa je obavezno polje',
            'order_date.required' => 'Datum poručivanja je obavezno polje',
            'payment.required' => 'Način placanja je obavezno polje',
            'delivery_type.required' => 'Način dostave je obavezno polje',
            'price.required' => 'Suma je obavezno polje',
            'order_number.required' => 'Broj porudžbine je obavezan',
        ];
    }
}
