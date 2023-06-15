<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|regex:/^[\w.-]+@[a-zA-Z_-]+?(?:.[a-zA-Z]{2,6})+$/',
            'phoneNumber' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'U heeft geen geldige naam ingevuld!',
            'email.required' => 'U heeft geen geldig E-mailadres ingevuld!',
            'email.regex' => 'U E-mailadres is niet geldig, voorbeeld: example@example.com',
            'phoneNumber.required' => 'U heeft geen geldig Telefoonnummer ingevuld!',
            'phoneNumber.regex' => 'U Telefoonnummer is niet geldig, voorbeeld: +31612345678',
        ];
    }
}
